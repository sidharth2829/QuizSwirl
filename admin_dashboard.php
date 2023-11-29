<?php
include 'connection.php';

// Fetch all quizzes from the 'quizzes' table
$fetch_quizzes_query = "SELECT * FROM quizzes";
$quizzes_result = $link->query($fetch_quizzes_query);

// Fetch quizzes created by the logged-in admin
session_start(); // Assuming session has admin_id
$admin_id = $_SESSION['admin_id'];
$fetch_admin_quizzes_query = "SELECT q.* FROM quizzes q
                              INNER JOIN admin_quiz aq ON q.quiz_id = aq.quiz_id
                              WHERE aq.admin_id = '$admin_id'";
$admin_quizzes_result = $link->query($fetch_admin_quizzes_query);

$link->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Admin Dashboard</h1>
        </div>
        <div class="main-content">
            <div class="quiz-list">
                <h2>All Quizzes</h2>
                <?php
                if ($quizzes_result->num_rows > 0) {
                    while ($quiz = $quizzes_result->fetch_assoc()) {
                        echo '<div class="quiz-item">';
                        echo '<p>ID: ' . $quiz['quiz_id'] . '</p>';
                        echo '<p>Name: ' . $quiz['quiz_name'] . '</p>';
                        echo '<p>Date: ' . $quiz['quiz_date'] . '</p>';
                        echo '<p>Subject: ' . $quiz['quiz_subject'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo "No quizzes found.";
                }
                ?>
            </div>
            <div class="create-quiz">
                <h2>Create New Quiz</h2>
                <form action="create_quiz.php" method="post">
                    <div class="form-group">
                        <label for="quiz_name">Quiz Name:</label>
                        <input type="text" id="quiz_name" name="quiz_name" required>
                    </div>
                    <div class="form-group">
                        <label for="quiz_date">Quiz Date:</label>
                        <input type="date" id="quiz_date" name="quiz_date" required>
                    </div>
                    <div class="form-group">
                        <label for="quiz_subject">Quiz Subject:</label>
                        <input type="text" id="quiz_subject" name="quiz_subject" required>
                    </div>
                    <!-- Add more fields as needed -->
                    <button type="submit">Create Quiz</button>
                </form>
            </div>
            <div class="admin-quizzes">
                <h2>Your Quizzes</h2>
                <?php
                if ($admin_quizzes_result->num_rows > 0) {
                    while ($admin_quiz = $admin_quizzes_result->fetch_assoc()) {
                        echo '<div class="admin-quiz-item">';
                        echo '<p>ID: ' . $admin_quiz['quiz_id'] . '</p>';
                        echo '<p>Name: ' . $admin_quiz['quiz_name'] . '</p>';
                        echo '<p>Date: ' . $admin_quiz['quiz_date'] . '</p>';
                        echo '<p>Subject: ' . $admin_quiz['quiz_subject'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo "No quizzes created by you yet.";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
