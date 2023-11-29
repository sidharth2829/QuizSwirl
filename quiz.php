<!DOCTYPE html>
<html>

<?php
include 'connection.php';

$sql = "SELECT * FROM quiz_questions";
$result = $link->query($sql);

$questions = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $question = array(
            'question' => $row['question_text'],
            'answers' => array(
                array('text' => $row['correct_answer'], 'correct' => true),
                array('text' => $row['wrong_answer1'], 'correct' => false),
                array('text' => $row['wrong_answer2'], 'correct' => false),
                array('text' => $row['wrong_answer3'], 'correct' => false)
            )
        );
        array_push($questions, $question);
    }
}

$link->close();
?>
    <head>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width">
        <title>
            My Quiz
        </title>
        <link rel="stylesheet" href="/css/quiz.css" type="text/css" />
    </head>

    <body>
        <div class="menu-bar">
            <button id="home-button"><a href="quiz.html">Home</a></button>
            <button id="logout-button"><a href="login.php">Logout</a></button>
        </div>                      
        <div class="name">Online Quiz</div>
        <div class="main">
            <div class="quiz">               
                <div class="question-number">Question <span id="question-number">1</span>/<span id="total-questions">10</span>
                    <div class="timer" id="timer"></div> 
                    <hr class="line">
                </div>
                <h1 id="question">Que</h1>
                <div id="answer-buttons">
                    <button class="btn">Option 1</button>
                    <button class="btn">Option 2</button>
                    <button class="btn">Option 3</button>
                    <button class="btn">Option 4</button>
                </div>
                <button id="next-button">Next</button>
            </div>
        </div>
        <script >
const questions = <?php echo json_encode($questions); ?>;
let timer;
let timeLeft = 30; 

function startTimer() 
{
    clearInterval(timer);
    updateTimerDisplay();

    timer = setInterval(function () 
    {
        if (timeLeft <= 0) 
        {
            clearInterval(timer);
            handleNextButton();
        } else 
        {
            timeLeft--;
            updateTimerDisplay();
        }
    }, 1000);
}

function updateTimerDisplay() 
{
    const timerDisplay = document.getElementById("timer");
    timerDisplay.textContent = `${(timeLeft).toLocaleString('en-US', { minimumIntegerDigits: 2 })}`;
}

startTimer();

function shuffleArray(array) 
{
    for (let i = array.length - 1; i > 0; i--) 
    {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

shuffleArray(questions);


const questionElement = document.getElementById("question");
const answerButtons = document.getElementById("answer-buttons");
const nextButton = document.getElementById("next-button");

let currentQuestionIndex = 0;
let score = 0;

function startQuiz()
{
    currentQuestionIndex = 0;
    score = 0;
    nextButton.innerHTML = "Next";
    showQuestion();
}

function showQuestion()
{
    resetState();
    let currentQuestion = questions[currentQuestionIndex];
    questionElement.innerHTML = currentQuestion.question;

    currentQuestion.answers.forEach(answer => 
        {
        const button = document.createElement("button");
        button.innerHTML = answer.text;
        button.classList.add("btn");
        answerButtons.appendChild(button);
        if(answer.correct)
        {
            button.dataset.correct = answer.correct;
        }
        button.addEventListener("click", selectAnswer);
        });
        document.getElementById("question-number").textContent = currentQuestionIndex + 1;
        document.getElementById("total-questions").textContent = questions.length;
}

function resetState()
{
    nextButton.style.display = "none";
    while(answerButtons.firstChild)
    {
        answerButtons.removeChild(answerButtons.firstChild);
    }
}

function selectAnswer(e)
{
    const selectedBtn = e.target;
    const isCorrect = selectedBtn.dataset.correct === "true";
    if(isCorrect)
    {
        selectedBtn.classList.add("correct");
        score++;
    }
    else
    {
        selectedBtn.classList.add("incorrect");
    }
    Array.from(answerButtons.children).forEach(button => 
        {
        if(button.dataset.correct === "true")
        {
            button.classList.add("correct");
        }
        button.disabled = true;
        });
        nextButton.style.display = "block";
}

function showScore() 
{
    resetState();
    window.location.href = "result.php";
}

function submitScore() 
{
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "submit_score.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () 
    {
         if (xhr.readyState === 4 && xhr.status === 200) 
         {
            const response = xhr.responseText;
            window.location.href = "result.php";
         }
    };
    xhr.send("score=" + score); 
}

function handleNextButton() 
{
clearInterval(timer);
timeLeft = 30;
currentQuestionIndex++;

if (currentQuestionIndex < questions.length) 
{
    showQuestion();
    startTimer();
} 
else 
{
    nextButton.style.display = "none"; 
    const submitButton = document.createElement("button");
    submitButton.innerHTML = "Submit";
    submitButton.classList.add("submit-button");
    submitButton.addEventListener("click", submitScore);
    answerButtons.appendChild(submitButton);
}
}


nextButton.addEventListener("click", () => {
    if(currentQuestionIndex < questions.length)
    {
        handleNextButton();
    }
    else
    {
        startQuiz();
    }
});

startQuiz();
</script>  
    </body>
</html>