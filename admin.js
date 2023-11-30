document.addEventListener('DOMContentLoaded', function() {
    const quizForm = document.getElementById('quizForm');
    const previewContainer = document.getElementById('previewContainer');
    const addQuestionButton = document.getElementById('addQuestionButton');
    const finalSubmitButton = document.getElementById('finalSubmitButton');

    const questions = [];
    const correctAnswers = [];
    const wrongAnswers1 = [];
    const wrongAnswers2 = [];
    const wrongAnswers3 = [];

    quizForm.addEventListener('submit', function(event) {
        event.preventDefault();
    });

    addQuestionButton.addEventListener('click', function() {
        const question = document.getElementById('question').value;
        const correctAnswer = document.getElementById('correctAnswer').value;
        const wrongAnswer1 = document.getElementById('wrongAnswer1').value;
        const wrongAnswer2 = document.getElementById('wrongAnswer2').value;
        const wrongAnswer3 = document.getElementById('wrongAnswer3').value;

        questions.push(question);
        correctAnswers.push(correctAnswer);
        wrongAnswers1.push(wrongAnswer1);
        wrongAnswers2.push(wrongAnswer2);
        wrongAnswers3.push(wrongAnswer3);

        // Create HTML for the preview
        const previewHTML = `
            <div class="question-preview">
                <h3>Question: ${question}</h3>
                <p>Correct Answer: ${correctAnswer}</p>
                <p>Wrong Answers: ${wrongAnswer1}, ${wrongAnswer2}, ${wrongAnswer3}</p>
            </div>
        `;

        // Append the preview to the container
        previewContainer.innerHTML += previewHTML;

        // Clear form fields after submission
        quizForm.reset();
    });

    finalSubmitButton.addEventListener('click', function() {
        // Perform final submission to the server using AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'process_quiz.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText); // Log the response from the server
                } else {
                    console.error("Error submitting questions");
                }
            }
        };

        // Convert arrays to JSON for sending to the server
        const data = {
            questions: questions,
            correctAnswers: correctAnswers,
            wrongAnswers1: wrongAnswers1,
            wrongAnswers2: wrongAnswers2,
            wrongAnswers3: wrongAnswers3,
        };

        // Encode data for POST request
        const encodedData = Object.keys(data).map(key => encodeURIComponent(key) + '=' + encodeURIComponent(JSON.stringify(data[key]))).join('&');

        xhr.send(encodedData);
    });
});
