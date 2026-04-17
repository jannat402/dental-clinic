console.log("uoijfhsr")
async function cargarHorarios(diaSeleccionado,doctorSeleccionado) {
    try {
        console.log(diaSeleccionado)
        const response = await fetch('/horarios-disponibles?doctorSeleccionado='+doctorSeleccionado+'&dia='+diaSeleccionado);
        const data = await response.json();
        console.log(data);
        rellenarHoras(data);
    } catch (error) {
        console.error("Error:", error);
        mostrarSinHorarios()
    }
}
// panelCitas.js

// Asegurar que el DOM esté completamente cargado antes de ejecutar el código
$(document).ready(function() {

    
    // También puedes detectar clics en celdas específicas
    $("#tablahoras td").click(function() {
        $("#tablahoras td").css("background-color","inherit")
        $(this).css("background-color","cyan")
        diaSeleccionado =  $(this).text();
        doctorSeleccionado = $("#nombredoctor").val()
        cargarHorarios(diaSeleccionado,doctorSeleccionado);
        
    });
    
    
});
function rellenarHoras(data) {
    // Obtener el contenedor principal
    var $contenedor = $('#listadohoras');
    
    // Limpiar el contenido existente (opcional, si quieres reemplazar todo)
    $contenedor.empty();
    $contenedor.show()
    
    // Recorrer cada hora del array
    $.each(data.horas, function(index, horaObj) {
        // Crear un nuevo div
        var $divHora = $('<div>')
            .addClass('contenedorhora')
            .text(horaObj.hora); // Mostrar la hora en el div
        
        // Si no está disponible, añadir la clase nodisponible
        if (!horaObj.disponible) {
            $divHora.addClass('nodisponible');
        }
        
        // Añadir el div al contenedor
        $contenedor.append($divHora);
    });
}

function mostrarSinHorarios() {
    var $contenedor = $('#listadohoras');
    
    // Opción 2: Ocultar el contenedor de horas
    $contenedor.hide();
    
    // Opción 3: Mostrar todos los divs como no disponibles (como pediste)
    // Primero limpiamos
    $contenedor.empty();
    // Creamos 48 divs (cada 30 minutos) o los que necesites
    for (var i = 0; i < 48; i++) {
        var $divHora = $('<div>')
            .addClass('contenedorhora nodisponible')
            .text('No disponible');
        $contenedor.append($divHora);
    }
}

//cargarHorarios();