<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Quiz Results</title>
    <link rel="stylesheet" href="/result.css">
</head>
<body>
        <div class="menu-bar">
            <button id="home-button"><a href="quiz_selector.php">Home</a></button>
            <button id="logout-button"><a href="login.php">Logout</a></button>
        </div>
        <h1>Quiz Results</h1>

    <?php
    session_start();

    if (isset($_SESSION['username'])) 
    {
        $db = new PDO('mysql:dbname=quiz;host=127.0.0.1', 'root', '');

        $username = $_SESSION['username'];
        $userScoreQuery = $db->prepare("SELECT correct_answer, wrong_answer FROM results WHERE username = ?");
        $userScoreQuery->execute([$username]);
        $userScore = $userScoreQuery->fetch();
        ?>

        <div class="user-score">
            <h2>Your Score: <?= $userScore['correct_answer'] ?></h2>
            <p>Correct Answers: <?= $userScore['correct_answer'] ?></p>
            <p>Wrong Answers: <?= $userScore['wrong_answer'] ?></p>
        </div>
    
        <div class="participants-table">
            <table>
                <tr>
                    <th>Username</th>
                    <th>Correct Answers</th>
                    <th>Wrong Answers</th>
                </tr>
                <?php
                $allScoresQuery = $db->query("SELECT username, correct_answer, wrong_answer FROM results");
                while ($row = $allScoresQuery->fetch()) 
                {
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['correct_answer'] . "</td>";
                    echo "<td>" . $row['wrong_answer'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    
        <?php
        } 
        else 
        {
            echo "You must be logged in to view the results.";
        }
        ?>
</body>
</html>