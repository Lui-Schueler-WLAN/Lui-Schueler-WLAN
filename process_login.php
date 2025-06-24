<?php

// --- SECURITY CHECK ---
// Only allow processing if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- CAPTURE AND SANITIZE INPUTS ---
    // Use trim() to remove any accidental leading/trailing whitespace
    $account = trim($_POST['account']);


    // --- PREPARE DATA FOR FILE ---
    // Get the current date and time for the log entry
    $timestamp = date('Y-m-d H:i:s');
    
    // Create the string to be saved in the file
    $dataToSave = "------------------------------------\n";
    $dataToSave .= "Timestamp:     {$timestamp}\n";
    $dataToSave .= "Account:       {$account}\n";
    $dataToSave .= "------------------------------------\n\n";

    // --- DEFINE THE FILENAME ---
    $file = 'logins.txt';

    // --- SAVE DATA TO FILE ---
    // file_put_contents() is a simple way to write to a file.
    // FILE_APPEND flag ensures we add to the file, not overwrite it.
    // LOCK_EX prevents other users from writing to the file at the same time.
    if (file_put_contents($file, $dataToSave, FILE_APPEND | LOCK_EX)) {
        // --- REDIRECT ON SUCCESS ---
        // If saving was successful, redirect the user to the success page.
        // Make sure you have the second HTML page named 'registration_success.html'
        header('Location: registration_success.html');
        exit(); // Always call exit() after a header redirect
    } else {
        // --- HANDLE ERRORS ---
        echo "Error: Could not write to the file. Please check file permissions.";
    }

} else {
    // --- HANDLE DIRECT ACCESS ---
    // If someone tries to access this PHP file directly in their browser
    echo "Error: This page can only be accessed by submitting the form.";
}

?>