<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>PREOPERACIONALES Y ACTIVIDADES ADICIONALES</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form id="signatureForm" method="post" autocomplete="off">
        <h2>ACTIVIDADES DIARIAS</h2>

        <div class="input-group">
            <div class="input-container">
                <input type="text" name="name" placeholder="Mecanico" required>
                <i class="fa-solid fa-user"></i>
            </div>

            <div class="input-container">
                <input type="date" name="date" required>
                <i class="fa-solid fa-envelope"></i>
            </div>

        
            <div class="input-container">
                    <i class="fa-solid fa-motorcycle"></i>
                    <select name="maquina" id="maquina">
                                    
                        <option value="maquina1">Máquina 1</option>
                        <option value="maquina3">Máquina 3</option>
                        <option value="maquina4">Máquina 4</option>
                        <option value="molino1">Molino 1</option>
                        <option value="molino2">Molino 2</option>
                        <option value="molino3">Molino 3</option>
                        <option value="molinodecarbon">Molino de Carbón</option>
                        <option value="hornotunel">Horno Túnel</option>
                        <option value="rapilado">R. Apilado</option>
                        <option value="rdesapilado">R. Desapilado</option>
                    </select>

            </div>
                

            <div class="input-container">
                <input type="email" name="email" placeholder="correo" required>
                <i class="fa-solid fa-envelope"></i>
            </div>

            <div class="input-container">
                <input type="tel" name="phone" placeholder="telefono" required>
                <i class="fa-solid fa-phone"></i>
            </div>

            <label for="signature">Firma:</label>
            <canvas id="signatureCanvas"></canvas>

            <button type="button" class="button" id="clearBtn">Limpiar Firma</button>

            <a href="#">Terminos y condiciones</a>
            <input type="submit" name="send" class="btn" value="enviar">
        </div>
    </form>

    <?php
        include("send.php");
    ?>

    <script>
        // Configuración del lienzo de la firma
        const canvas = document.getElementById("signatureCanvas");
        const ctx = canvas.getContext("2d");

        
        canvas.width = 300; 
        canvas.height = 100; 

        // Cambiar el color de fondo del canvas
        ctx.fillStyle = "#f2f2f2"; // Color de fondo (gris claro)
        ctx.fillRect(0, 0, canvas.width, canvas.height); // Rellenar el canvas con el color de fondo

        // Cambiar el color del trazo (firma)
        ctx.strokeStyle = "#000000"; // Color de la firma (negro)
        ctx.lineWidth = 2; // Grosor de la línea

        let isDrawing = false;

        // Comienza a dibujar en el lienzo
        canvas.addEventListener("mousedown", (e) => {
            isDrawing = true;
            ctx.beginPath();
            ctx.moveTo(e.offsetX, e.offsetY); // Usar offsetX y offsetY para obtener la posición correcta
        });

        // Dibuja mientras el ratón se mueve
        canvas.addEventListener("mousemove", (e) => {
            if (isDrawing) {
                ctx.lineTo(e.offsetX, e.offsetY); // Continuar el trazo en base a la posición del ratón
                ctx.stroke(); // Dibujar la línea
            }
        });

        // Detiene el dibujo cuando el ratón se suelta
        canvas.addEventListener("mouseup", () => {
            isDrawing = false;
        });

        // Borra el lienzo (firma)
        document.getElementById("clearBtn").addEventListener("click", () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height); // Borrar todo el contenido del lienzo
            // Rellenar el canvas con el fondo después de limpiar
            ctx.fillStyle = "#f2f2f2"; 
            ctx.fillRect(0, 0, canvas.width, canvas.height);
        });

        // Procesa el formulario al enviarlo
        document.getElementById("signatureForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Previene el envío del formulario para poder procesar los datos primero

            // Obtenemos los datos del formulario
            const formData = new FormData(this);
            const signatureData = canvas.toDataURL(); // Obtiene la firma en formato de imagen base64

            // Agregar la firma a los datos del formulario
            formData.append("signature", signatureData);

            // Aquí puedes enviar los datos al servidor con AJAX (por ejemplo, usando Fetch o XMLHttpRequest)
            console.log("Formulario enviado");
            console.log("Firma en Base64:", signatureData);

            // Muestra una alerta de éxito
            alert("Formulario enviado con éxito.");

            // Aquí puedes hacer la lógica de enviar los datos al servidor (usando Fetch, AJAX, etc.)
        });
    </script>
</body>
</html>
