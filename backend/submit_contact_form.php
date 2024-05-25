<?php
  try {
    $emailData = json_decode(file_get_contents("php://input"));
    $messageLength = strlen($emailData->$message);

    if ($messageLength > 1000) {
      formatLogMessage("message is too long: $message");
      throw new Exception("message is too long");
    }

    $name = sanitizeInput($emailData->name ?? '');
    $phone = sanitizeInput($emailData->phone ?? '');
    $email = sanitizeInput($emailData->email ?? '');
    $message = sanitizeInput($emailData->message ?? '');

    if (empty($name) || empty($email) || empty($message)) {
      formatLogMessage("required information is missing");
      throw new Exception("required information is missing");
    }

    if (!validateEmail($email)) {
      formatLogMessage("invalid email address: $email");
      throw new Exception("invalid email address");
    }

    $to = "superslimetimeinfo@gmail.com";
    $subject = "$name wants to get in contact!";
    $headers = [
      "From: $name <$email>",
      "Reply-To: $email",
      "X-Mailer: PHP/" . phpversion(),
    ];
    $headersString = implode("\r\n", $headers);
    $messageBody = "Name: $name\nPhone: $phone\nEmail: $email\n\nMessage:\n$message";

    if (mail($to, $subject, $messageBody, $headersString)) {
      echo json_encode([
        "status" => "success",
        "data" => $emailData,
      ], JSON_PRETTY_PRINT);
      formatLogMessage("an email was successfully sent from $name at $email", "success");
    } else {
      formatLogMessage("failed to send email");
      throw new Exception("failed to send email");
    }
  } catch (\Throwable $error) {
    $errorMessage = $error->getMessage();
    formatLogMessage($errorMessage);
    error_log($errorMessage);
    http_response_code(500);
    echo json_encode([
      "error" => "there was an error submitting in submit_contact_form.php",
      "message" => $errorMessage,
    ]);
  }