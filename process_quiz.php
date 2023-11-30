<?php
echo"bhoot";
include 'connection.php';
session_start();

// Retrieve the quiz ID from the session
if (isset($_SESSION['quiz_id'])) {
    $quiz_id = $_SESSION['quiz_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Assuming you're sending the arrays as JSON strings in the request body
        $questions = json_decode($_POST['questions'], true);
        $correctAnswers = json_decode($_POST['correctAnswers'], true);
        $wrongAnswers1 = json_decode($_POST['wrongAnswers1'], true);
        $wrongAnswers2 = json_decode($_POST['wrongAnswers2'], true);
        $wrongAnswers3 = json_decode($_POST['wrongAnswers3'], true);

        // Assuming each array has the same number of elements
        $length = count($questions);

        // Prepare a SQL statement for insertion
        $stmt = $link->prepare("INSERT INTO quiz_questions (quiz_id, question_text, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3)
                                VALUES (?, ?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bind_param("isssss", $quiz_id, $question, $correctAnswer, $wrongAnswer1, $wrongAnswer2, $wrongAnswer3);

        for ($i = 0; $i < $length; $i++) {
            $question = $questions[$i];
            $correctAnswer = $correctAnswers[$i];
            $wrongAnswer1 = $wrongAnswers1[$i];
            $wrongAnswer2 = $wrongAnswers2[$i];
            $wrongAnswer3 = $wrongAnswers3[$i];

            // Execute the prepared statement
            if (!$stmt->execute()) {
                echo "Error: " . $stmt->error;
            }
        }

        // Close the statement
        $stmt->close();

        // After processing questions, you can redirect or perform any other actions as needed
        echo "Questions submitted successfully!";
    } else {
        echo "Invalid request method";
    }
} else {
    echo "No quiz ID found in session.";
}

$link->close();
?>
