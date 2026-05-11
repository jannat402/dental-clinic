const doctorSelect = document.getElementById("doctor");
const tratamientoSelect = document.getElementById("tratamiento");
const calendario = document.getElementById("calendario-dias");
const horasSection = document.getElementById("horas");
const horasDiv = document.getElementById("listadohoras");
const inputFecha = document.getElementById("fecha");
const inputHora = document.getElementById("hora");
const botonReservar = document.getElementById("botonReservar");

// Guardar opcions originals de tractaments
const opcionsOriginals = Array.from(tratamientoSelect.options);

// Quan canvia el doctor, filtrar tractaments i recarregar dies
doctorSelect.addEventListener("change", function () {
    const doctorId = this.value;
    if (doctorId) {
        filtrarTratamientos(doctorId);
        cargarDias(doctorId);
    } else {
        restaurarTratamientos();
        calendario.innerHTML = '<div class="dia-placeholder">Selecciona un doctor primer</div>';
        horasSection.style.display = "none";
        botonReservar.style.display = "none";
    }
});

function filtrarTratamientos(idDoctor) {
    tratamientoSelect.disabled = true;
    tratamientoSelect.innerHTML = '<option value="">Carregant tractaments...</option>';

    fetch(`/horarios/tratamientos/${idDoctor}`)
        .then(res => {
            if (!res.ok) throw new Error("Error al carregar tractaments");
            return res.json();
        })
        .then(tractaments => {
            tratamientoSelect.innerHTML = '<option value="">Trieu un tractament</option>';
            tractaments.forEach(t => {
                const opt = document.createElement("option");
                opt.value = t.id_tratamiento;
                opt.textContent = `${t.nombre_tratamiento} (${t.duracion_minutos}min - ${t.precio}€)`;
                tratamientoSelect.appendChild(opt);
            });
            tratamientoSelect.disabled = false;
        })
        .catch(err => {
            restaurarTratamientos();
            console.error(err);
        });
}

function restaurarTratamientos() {
    tratamientoSelect.innerHTML = "";
    opcionsOriginals.forEach(opt => tratamientoSelect.appendChild(opt));
    tratamientoSelect.disabled = false;
}

function cargarDias(idDoctor) {
    calendario.innerHTML = '<div class="dia-placeholder">Carregant dies...</div>';

    fetch(`/horarios/dias/${idDoctor}`)
        .then(res => {
            if (!res.ok) throw new Error("Error al carregar dies");
            return res.json();
        })
        .then(dias => {
            calendario.innerHTML = "";
            if (dias.length === 0) {
                calendario.innerHTML = '<div class="dia-placeholder">No hi ha dies disponibles per a aquest doctor</div>';
                horasSection.style.display = "none";
                return;
            }

            dias.forEach(d => {
                const fecha = d.fecha;
                const fechaObj = new Date(fecha + "T12:00:00");
                const diaNum = fechaObj.getDate();
                const nomDia = ["Dg", "Dl", "Dt", "Dc", "Dj", "Dv", "Ds"][fechaObj.getDay()];

                const div = document.createElement("div");
                div.classList.add("dia");
                div.innerHTML = `<span class="dia-nom">${nomDia}</span>${diaNum}`;
                div.dataset.fecha = fecha;

                div.addEventListener("click", function () {
                    document.querySelectorAll(".dia.actiu").forEach(el => el.classList.remove("actiu"));
                    this.classList.add("actiu");
                    inputFecha.value = this.dataset.fecha;
                    cargarHoras(idDoctor, this.dataset.fecha);
                });

                calendario.appendChild(div);
            });
        })
        .catch(err => {
            calendario.innerHTML = '<div class="dia-placeholder">Error en carregar dies</div>';
            console.error(err);
        });
}

function cargarHoras(idDoctor, fecha) {
    horasSection.style.display = "block";
    horasDiv.innerHTML = '<div class="dia-placeholder" style="grid-column:1/-1;">Carregant hores...</div>';
    botonReservar.style.display = "none";

    fetch(`/horarios/horas/${idDoctor}/${fecha}`)
        .then(res => {
            if (!res.ok) throw new Error("Error al carregar hores");
            return res.json();
        })
        .then(data => {
            horasDiv.innerHTML = "";

            if (!data.horarios || data.horarios.length === 0) {
                horasDiv.innerHTML = '<div class="dia-placeholder" style="grid-column:1/-1;">No hi ha horari disponible per a aquest dia</div>';
                return;
            }

            data.horarios.forEach(h => {
                const div = document.createElement("div");
                div.classList.add("hora");
                div.textContent = h.hora_inicio.substring(0, 5);

                if (h.disponible == 0) {
                    div.classList.add("no-disponible");
                }

                div.addEventListener("click", function () {
                    if (this.classList.contains("no-disponible")) return;
                    document.querySelectorAll(".hora.seleccionada").forEach(el => el.classList.remove("seleccionada"));
                    this.classList.add("seleccionada");
                    inputHora.value = h.hora_inicio;
                    botonReservar.style.display = "flex";
                });

                horasDiv.appendChild(div);
            });
        })
        .catch(err => {
            horasDiv.innerHTML = '<div class="dia-placeholder" style="grid-column:1/-1;">Error en carregar hores</div>';
            console.error(err);
        });
}
