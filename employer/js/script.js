let quizData; // Declare the quizData variable

const quiz = document.getElementById("quiz");
const answerEls = document.querySelectorAll(".answer");
const questionEl = document.getElementById("question");
const a_text = document.getElementById("a_text");
const b_text = document.getElementById("b_text");
const c_text = document.getElementById("c_text");
const d_text = document.getElementById("d_text");
const submitBtn = document.getElementById("submit");

let currentQuiz = 0;
let score = 0;

let currentQuizQuestionId = 0;

loadQuiz();

function loadQuiz() {
  deselectAnswers();

  const quizUrl = "list_of_questions.php";

  fetch(quizUrl)
    .then((response) => response.json())
    .then((data) => {
      // Process the fetched data
      console.log(data); // or do something else with the data
      quizData = data;

      const currentQuizData = data[currentQuiz];

      questionEl.innerText = currentQuizData.question;
      a_text.innerText = currentQuizData.a;
      b_text.innerText = currentQuizData.b;
      c_text.innerText = currentQuizData.c;
      d_text.innerText = currentQuizData.d;
    })
    .catch((error) => {
      // Handle any errors
      console.error("Error fetching quiz data:", error);
    });
}

function deselectAnswers() {
  answerEls.forEach((answerEl) => (answerEl.checked = false));
}

function getSelected() {
  let answer;

  answerEls.forEach((answerEl) => {
    if (answerEl.checked) {
      answer = answerEl.id;
    }
  });

  return answer;
}

submitBtn.addEventListener("click", () => {
  const answer = getSelected();
  console.log(quizData[currentQuiz].correct);
  console.log(answer);

  if (answer) {
    if (answer === quizData[currentQuiz].correct) {
      score++;
    }

    currentQuiz++;
    currentQuizQuestionId++;
    submitAnswer();

    if (currentQuiz < quizData.length) {
      loadQuiz();
    } else {
      quiz.innerHTML = `
                <h2 id="question">Lets now proceed to know your opinion</h2>

                <button onclick="addScoreToDatabase()">Okay</button>
            `;
    }
  }
});

// Function to handle form submission and send data to the server
function submitAnswer() {
  const answer = getSelected();
  var data = {
    answer: answer,
    currentQuizQuestionId: currentQuizQuestionId,
  }; // Create an object with the data to be sent

  // Send the data to the server using AJAX
  $.ajax({
    url: "add_user_answer.php", // Replace with the URL of your server-side script or API
    type: "POST",
    dataType: "json",
    data: data,
    success: function (response) {
      // Handle the response from the server if needed
      console.log("Data saved successfully:", response);
    },
    error: function (xhr, status, error) {
      // Handle any errors that occurred during the AJAX request
      console.error("Error:", error);
    },
  });
}

function addScoreToDatabase() {
  const scoreData = {
    score: score,
  };

  const requestData =
    "scoreData=" + encodeURIComponent(JSON.stringify(scoreData));

  fetch("add_score.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: requestData,
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data); // Handle the response from the server if needed
      location.replace("textbox.php");
    })
    .catch((error) => {
      console.error("Error adding score to the database:", error);
    });
}

const textarea = document.getElementById("yourQuestion");

textarea.addEventListener("input", function () {
  const maxLength = parseInt(textarea.getAttribute("maxlength"));
  const currentLength = textarea.value.length;

  if (currentLength > maxLength) {
    textarea.value = textarea.value.slice(0, maxLength); // Truncate the text
  }
});
