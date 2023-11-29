document.addEventListener('DOMContentLoaded', function() {
    const quizForm = document.getElementById('quizForm');
    const previewContainer = document.getElementById('previewContainer');

    quizForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const question = document.getElementById('question').value;
        const correctAnswer = document.getElementById('correctAnswer').value;
        const wrongAnswer1 = document.getElementById('wrongAnswer1').value;
        const wrongAnswer2 = document.getElementById('wrongAnswer2').value;
        const wrongAnswer3 = document.getElementById('wrongAnswer3').value;

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
});
