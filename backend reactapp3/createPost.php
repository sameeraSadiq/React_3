<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$host = 'localhost';
$db = 'practice';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the raw POST data
$data = json_decode(file_get_contents("php://input"));

// Check if $data is null
if ($data === null) {
    die("Error: Received null data. Check the JSON format.");
}

$title = isset($data->title) ? $data->title : null;
$content = isset($data->content) ? $data->content : null;
$author = isset($data->author) ? $data->author : null;

// Check for missing fields
if ($title === null || $content === null || $author === null) {
    die("Error: Missing fields in the input.");
}

$sql = "INSERT INTO posts (title, content, author) VALUES ('$title', '$content', '$author')";
if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Post created successfully"]);
} else {
    echo json_encode(["error" => $conn->error]);
}

$conn->close();
?>