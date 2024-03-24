<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se enviaron los campos esperados
    if (isset($_POST["name"], $_POST["email"], $_POST["subject"], $_POST["message"])) {
        $name = trim($_POST["name"]);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $subject = trim($_POST["subject"]);
        $message = trim($_POST["message"]);

        // Verificar si los campos no están vacíos
        if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
            // Construir el mensaje
            $email_body = "Nombre: $name\n";
            $email_body .= "Email: $email\n";
            $email_body .= "Asunto: $subject\n";
            $email_body .= "Mensaje:\n$message";

            // Enviar el correo electrónico
            $to = "victoriacursos2022@gmail.com";
            $headers = "From: $name <$email>";

            if (mail($to, $subject, $email_body, $headers)) {
                // Devolver una respuesta JSON con estado y mensaje
                echo json_encode(array("status" => "success", "message" => "¡Gracias! Tu mensaje ha sido enviado."));
            } else {
                echo json_encode(array("status" => "error", "message" => "Hubo un problema al enviar tu mensaje. Por favor, inténtalo de nuevo más tarde."));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "Por favor, complete todos los campos y vuelva a intentarlo."));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Los campos esperados no fueron enviados."));
    }
} else {
    http_response_code(403);
    echo json_encode(array("status" => "error", "message" => "Hubo un problema con tu solicitud. Por favor, intenta nuevamente."));
}
?>
