<?php
require 'vendor/autoload.php'; // include Composer's autoloader

// Connect to MongoDB
$client = new MongoDB\Client("mongodb://localhost:27017");

// Select a database and collection
$collection = $client->counselling->forms;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Insert form data into MongoDB
    $result = $collection->insertOne([
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'message' => $message,
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ]);

    if ($result->getInsertedCount() == 1) {
        echo 'Form submitted successfully';
    } else {
        echo 'Error submitting form';
    }
}
?>
