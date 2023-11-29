<?php
include 'connection.php';

// Retrieve the quiz ID from the URL parameter
if (isset($_GET['quiz_id'])) {
    $quiz_id = $_GET['quiz_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $questions = $_POST['question'];
        $correctAnswers = $_POST['correctAnswer'];
        $wrongAnswers1 = $_POST['wrongAnswer1'];
        $wrongAnswers2 = $_POST['wrongAnswer2'];
        $wrongAnswers3 = $_POST['wrongAnswer3'];

        // Assuming each array has the same number of elements
        $length = count($questions);

        for ($i = 0; $i < $length; $i++) {
            $question = $link->real_escape_string($questions[$i]);
            $correctAnswer = $link->real_escape_string($correctAnswers[$i]);
            $wrongAnswer1 = $link->real_escape_string($wrongAnswers1[$i]);
            $wrongAnswer2 = $link->real_escape_string($wrongAnswers2[$i]);
            $wrongAnswer3 = $link->real_escape_string($wrongAnswers3[$i]);

            $sql = "INSERT INTO quiz_questions (quiz_id, question_text, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3)
                    VALUES ('$quiz_id', '$question', '$correctAnswer', '$wrongAnswer1', '$wrongAnswer2', '$wrongAnswer3')";

            if ($link->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $link->error;
            }
        }
        // After processing questions, you can redirect or perform any other actions as needed
    } else {
        echo "Invalid request method";
    }
} else {
    echo "No quiz ID received.";
}

$link->close();
?>
