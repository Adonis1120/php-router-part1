<?php

use Http\Forms\LoginForm;
use Core\Authenticator;
use Core\Session;

$email = $_POST["email"];
$password = $_POST["password"];

// Validate form inputs
$form = new LoginForm;

if ($form->validate($email, $password)) {
    // Match the credentials
    $auth = new Authenticator();

    if ($auth->attempt($email, $password)) {
        redirect("/");
    }
    
    $form->error("email", "No matching account for that email and password.");
}

Session::flash("errors", $form->errors());

return redirect("/login");