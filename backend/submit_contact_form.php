<?php
  try {
    $emailData = json_decode(file_get_contents("php://input"));
    $name = sanitizeInput($emailData->name);
    $phone = sanitizeInput($emailData->phone);
    $email = sanitizeInput($emailData->email);
    $message = sanitizeInput($emailData->message);

    if (!validateEmail($email)) {
      throw new Exception("invalid email address");
    }

    $to = "superslimetimeinfo@gmail.com";
    $subject = "$name sent you an email";
    $headers = [
      "From" => $email,
      "Reply-To" => $email,
      "X-Mailer" => "PHP/" . phpversion(),
    ];
    $messageBody = "Name: $name\nPhone: $phone\nEmail: $email\nMessage:\n$message";

    if (mail($to, $subject, $messageBody, $headers)) {
      echo json_encode([
        "status" => "success",
        "data" => $emailData,
      ], JSON_PRETTY_PRINT);
      formatLogMessages("an email was successfully sent from $name at $email", "success");
    } else {
      throw new Exception("failed to send email");
    }
  } catch (\Throwable $error) {
    $errorMessage = $error->getMessage();
    formatLogMessages($errorMessage);
    error_log($errorMessage);
    http_response_code(500);
    echo json_encode([
      "error" => "there was an error submitting the contact form",
      "message" => $errorMessage,
    ]);
  }