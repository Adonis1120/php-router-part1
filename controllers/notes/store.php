<?php

use Core\Database;
use Core\Validator;

require base_path("Core/Validator.php");

$config = require base_path("config.php");
$db = new Database($config["database"]);

$errors = [];

if (!Validator::string(($_POST["body"]), 1, 255)) {
    $errors["body"] = "The body must be at least 1 character and not exceed 255 characters.";
}

if (!empty($errors)) {
    view("notes/create.view.php", [
        "heading" => "create note",
        "errors" => []
    ]);
}

$db->query("INSERT INTO notes(body, user_id) VALUES(:body, :user_id)", [
    "body" => $_POST["body"],
    "user_id" => 1
]);

header("location: /notes");
die();