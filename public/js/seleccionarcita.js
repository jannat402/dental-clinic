const doctorSelect = document.getElementById("doctor");
const calendario = document.getElementById("calendario-dias");
const horasDiv = document.getElementById("horas");
const inputFecha = document.getElementById("fecha");
const inputHora = document.getElementById("hora");

doctorSelect.addEventListener("change", cargarDias);

cargarDias(); // cargar al entrar

function cargarDias() {
    const idDoctor = doctorSelect.value;

    fetch(`/horarios/dias/${idDoctor}`)
        .then(res => res.json())
        .then(dias => {
            calendario.innerHTML = "";

            dias.forEach(d => {
                const fecha = d.fecha;
                const dia = new Date(fecha).getDate();

                const div = document.createElement("div");
                div.classList.add("dia");
                div.textContent = dia;

                div.addEventListener("click", () => {
                    inputFecha.value = fecha;
                    cargarHoras(idDoctor, fecha);
                });

                calendario.appendChild(div);
            });
        });
}

function cargarHoras(idDoctor, fecha) {
    horasDiv.innerHTML = "";

    fetch(`/horarios/horas/${idDoctor}/${fecha}`)
        .then(res => res.json())
        .then(data => {
            data.horarios.forEach(h => {
                const div = document.createElement("div");
                div.classList.add("hora");
                div.textContent = h.hora_inicio;

                if (h.disponible == 0) {
                    div.classList.add("no-disponible");
                }

                if (data.ocupadas.includes(h.hora_inicio)) {
                    div.classList.add("no-disponible");
                }

                div.addEventListener("click", () => {
                    if (!div.classList.contains("no-disponible")) {
                        inputHora.value = h.hora_inicio;
                    }
                });

                horasDiv.appendChild(div);
            });
        });
}
