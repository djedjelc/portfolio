<?php
$data = [];
if ($_POST) {
    $name = "";
    $email = "";
    $subject = "";
    $comments = "";
    $recipient="lissassiyeliancandace@gmail.com";

    if (isset($_POST['name'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['email'])) {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    if (isset($_POST['subject'])) {
        $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['comments'])) {
        $comments = htmlspecialchars($_POST['comments']);
    }


    $headers = 'MIME-Version: 1.0' . "\r\n"
        . 'Content-type: text/html; charset=utf-8' . "\r\n"
        . 'From: ' . $email . "\r\n";
    if (mail($recipient, $subject, $comments, $headers)) {
        $data = array(
            'status' => 'Félicitations',
            'message' => 'Votre message a été envoyé avec succès.'
        );
    } else {
        $data = array(
            'status' => 'Erreur',
            'message' => 'Message non envoyé.'
        );
    }
} else {
	$data = array(
		'status' => 'Avertissement',
		'message' => 'Veillez réessayer.'
	);
}
echo json_encode($data);
