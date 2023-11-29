<?php
include 'connection.php';
session_start(); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quiz_name = $_POST['quiz_name'];
    $quiz_date = $_POST['quiz_date'];
    $quiz_subject = $_POST['quiz_subject'];

    $sql = "INSERT INTO quizzes (quiz_name, quiz_date, quiz_subject) VALUES ('$quiz_name', '$quiz_date', '$quiz_subject')";

    if ($link->query($sql) === TRUE) {
        $quiz_id = $link->insert_id; // Retrieve the auto-generated ID of the inserted quiz
        
        $admin_id = $_SESSION["admin_id"];

        // Link admin ID and quiz ID in admin_quiz table
        $linking_sql = "INSERT INTO admin_quiz (admin_id, quiz_id) VALUES ('$admin_id', '$quiz_id')";
        if ($link->query($linking_sql) !== TRUE) {
            echo "Error linking admin and quiz: " . $link->error;
        }

        // Redirect to process_quiz.php and pass the quiz ID in the URL
        header("Location: admin.html?quiz_id=$quiz_id");
        exit();
    } else {
        echo "Error creating quiz: " . $link->error;
    }
}

$link->close();
?>
