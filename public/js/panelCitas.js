async function cargarHorarios(diaSeleccionado,doctorSeleccionado) {
    try {
        var tratamientoSeleccionado = $("#tratamiento").val();
        const response = await fetch('/horarios-disponibles?doctorSeleccionado='+doctorSeleccionado+'&dia='+diaSeleccionado+'&tratamiento='+tratamientoSeleccionado);
        const data = await response.json();
        
        if (!data.ok) {
            mostrarSinHorarios();
            return;
        }
        
        cargarDuracionTratamiento(data.duracion);
        cargarPrecioTratamiento(data.precio);
        relleno(data);
    } catch (error) {
        mostrarSinHorarios()
    }
}

function cargarDuracionTratamiento(duracion) {
    $("#duracion_tratamiento").val(duracion);
}

function cargarPrecioTratamiento(precio) {
    $("#precio_tratamiento").val(precio);
}

$(document).ready(function() {

    $.ajax({
        url: '/doctores-listado',
        method: 'GET',
        success: function(doctores) {
            var $select = $('#nombredoctor');
            doctores.forEach(function(doctor) {
                $select.append($('<option>').val(doctor.id_doctor).text(doctor.nombre + ' ' + doctor.apellidos));
            });
        }
    });

    $.ajax({
        url: '/tratamientos-listado',
        method: 'GET',
        success: function(tratamientos) {
            var $select = $('#tratamiento');
            $select.empty();
            tratamientos.forEach(function(tratamiento) {
                $select.append($('<option>').val(tratamiento.id_tratamiento).text(tratamiento.nombre_tratamiento));
            });
        }
    });
    
    $("#tablahoras td").click(function() {
        if (!$("#nombredoctor").val()) {
            alert('Por favor seleccione un doctor');
            return;
        }
        $("#tablahoras td").css("background-color","inherit")
        $(this).css("background-color","cyan")
        diaSeleccionado =  $(this).text();
        doctorSeleccionado = $("#nombredoctor").val()
        cargarHorarios(diaSeleccionado,doctorSeleccionado);
        
    });
    
    $("#tratamiento").change(function() {
        if (diaSeleccionado && doctorSeleccionado) {
            cargarHorarios(diaSeleccionado, doctorSeleccionado);
        }
    });

    $("#nombredoctor").change(function() {
        if (diaSeleccionado && $(this).val()) {
            doctorSeleccionado = $(this).val();
            cargarHorarios(diaSeleccionado, doctorSeleccionado);
        }
    });
    
    $("#botonReservar input").click(function(e) {
        e.preventDefault();
        var fechaSeleccionada = $("#fecha").val();
        if (!fechaSeleccionada) {
            alert('Por favor seleccione una hora');
            return;
        }
        
        var partes = fechaSeleccionada.split(' ');
        var fecha = partes[0];
        var horaInicio = partes[1];
        
        $.ajax({
            url: '/reservar-ciata',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                doctor: doctorSeleccionado,
                tratamiento: $("#tratamiento").val(),
                fecha: fecha,
                hora_inicio: horaInicio,
                duracion: $("#duracion_tratamiento").val()
            },
            success: function(response) {
                if (response.ok) {
                    alert('Cita reservada. Proceda ao pagamento.');
                    window.location.href = '/payment?cita=' + response.cita.id_cita;
                } else {
                    alert(response.mensaje);
                }
            },
            error: function() {
                alert('Error al reservar la cita');
            }
        });
    });
    
});

var diaSeleccionado;
var doctorSeleccionado;

function relleno(data) {
    var $contenedor = $('#listadohoras');
    var $contenedorPadre = $('#horas');
    var $titulo = $('#tituloHoras');
    var $botonReservar = $('#botonReservar');
    $contenedor.empty();
    $contenedorPadre.show()
    $botonReservar.hide();
    $titulo.text('Seleccione una franquicia');
    
    var hayDisponible = data.horas.some(h => h.disponible);
    
    if (!hayDisponible) {
        $contenedor.append($('<div>').addClass('contenedorhora nodisponible').text('Día no disponible para el doctor seleccionado'));
        return;
    }
    
    $.each(data.horas, function(index, horaObj) {
        var $divHora = $('<div>')
            .addClass('contenedorhora')
            .text(horaObj.hora);
        
        if (!horaObj.disponible) {
            $divHora.addClass('nodisponible');
        } else {
            $divHora.addClass('disponible');
            $divHora.click(function() {
                $('.contenedorhora').css('background-color', '#b8c9d5');
                $(this).css('background-color', 'cyan');
                $("#fecha").val(data.fecha + ' ' + horaObj.hora + ':00');
                $botonReservar.show();
            });
        }
        
        $contenedor.append($divHora);
    });
}

function mostrarSinHorarios() {
    var $contenedor = $('#listadohoras');
    var $contenedorPadre = $('#horas');
    var $titulo = $('#tituloHoras');
    $contenedor.empty();
    $contenedorPadre.show();
    $titulo.text('Día no disponible para el doctor seleccionado');
}