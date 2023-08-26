
document.addEventListener("DOMContentLoaded", function () {
    const output = document.getElementById("chat-output");
    const citaInput = document.getElementById("cita-input");
    const submitBtn = document.getElementById("submit-btn");

    submitBtn.addEventListener("click", () => {
        const cita = citaInput.value;

        // Realizar solicitud a la API
        fetch(`http://localhost/biblia_chatbot/index.php?cita=${cita}`)
            .then(response => response.json())
            .then(data => {
                // Mostrar respuesta en el chat
                output.innerHTML += `
                    <div class="mb-3">
                        <strong>Cita:</strong> ${cita}
                    </div>
                    <div class="mb-3">
                        <strong>Texto:</strong> ${data.texto}
                    </div>
                    <div class="mb-3">
                        <strong>Explicación:</strong> ${data.explicacion}
                    </div>
                    <hr class="my-4">
                `;
            })
            .catch(error => {
                console.error(error);
            });
    });
});
