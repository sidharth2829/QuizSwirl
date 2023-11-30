<!DOCTYPE html>
<html>
<head>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
background-repeat: no-repeat;
    background-size: cover;
background-attachment : fixed;
background-image: url(assets/3.jpg);

}

.container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(30%, 1fr));
    gap: 2%;
    padding: 2%;
}

.panel {
    border: 1px solid #ccc;
    padding: 3%;
    text-align: center;
    background-color: rgba(214, 212, 212, 0.9);

}

.panel h2 {
    margin-top: 0;
}

.panel p {
    margin-bottom: 5%;
}

button {
    padding: 3% 5%;
    font-size: 1.6vw;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <div class="container">
       <?php
include 'connection.php'; // Include your database connection file

$sql = "SELECT * FROM quizzes";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="panel">';
        echo '<h2>' . $row['quiz_name'] . '</h2>';
        echo '<p>Date: ' . $row['quiz_date'] . '</p>';
        echo '<p>Subject: ' . $row['quiz_subject'] . '</p>';
        echo '<form action="quiz.php" method="post">';
        echo '<input type="hidden" name="quiz_id" value="' . $row['quiz_id'] . '">';
        echo '<button type="submit">Start Quiz</button>'; // Link to quiz.php
        echo '</form>';
        echo '</div>';
    }
} else {
    echo 'No quizzes available.';
}

$link->close();
?>
    </div>
</body>
</html>
