<?php
  try {
    $emailData = json_decode(file_get_contents("php://input"));

    if (json_last_error() !== JSON_ERROR_NONE) {
      $jsonError = json_last_error_msg();
      throw new Exception("invalid json input: $jsonError");
    }

    foreach (["name", "email", "message"] as $requiredField) {
      if (empty($emailData->$requiredField)) {
        throw new Exception("missing required field: $requiredField");
      }
    }

    $rawMessageLength = strlen($emailData->message);
    if ($rawMessageLength > 4000) {
      throw new Exception("message is too long");
    }

    $name = sanitizeUserInput($emailData->name);
    $email = sanitizeUserInput($emailData->email);
    $message = sanitizeUserInput($emailData->message);
    $phone = sanitizeUserInput($emailData->phone ? $emailData->phone : "NO PHONE NUMBER PROVIDED");

    if (!validateEmail($email)) {
      throw new Exception("invalid email address: $email");
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
      http_response_code(200);
      echo json_encode([
        "status" => "success",
      ], JSON_PRETTY_PRINT);
      formatLogMessage("an email was successfully sent from $name: $email", "success");
    } else {
      throw new Exception("failed to send email");
    }
  } catch (Exception $error) {
    $errorMessage = $error->getMessage();
    $errorLine = $error->getLine();
    formatLogMessage("$errorMessage at line $errorLine in submit_contact_form.php");

    http_response_code(500);
    $errorMessageFragments = [
      "invalid json input",
      "missing required field",
      "invalid email address",
      "message is too long",
    ];

    foreach ($errorMessageFragments as $errorMessageFragment) {
      if (strpos($errorMessage, $errorMessageFragment) !== false) {
        http_response_code(400);
        break;
      }
    }

    echo json_encode([
      "error" => "there was an error processing your request.",
      "message" => "please check your input and try again.",
      "status" => "failed",
    ]);
  } catch (\Throwable $error) {
    $errorMessage = $error->getMessage();
    $errorLine = $error->getLine();
    formatLogMessage("$errorMessage at line $errorLine in submit_contact_form.php");

    http_response_code(500);

    echo json_encode([
      "error" => "there was an unexpected error.",
      "message" => "an unexpected error occurred. please try again later.",
      "status" => "failed",
    ]);
  }


  