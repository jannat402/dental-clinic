console.log("uoijfhsr")
async function cargarHorarios() {
    try {
        const response = await fetch('/horarios-disponibles?doctor_id=3&fecha=2026-04-15');
        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.error("Error:", error);
    }
}

cargarHorarios();