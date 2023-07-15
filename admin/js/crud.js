function loadQuestions() {
  // DataTable initialization
  $('#myTable').DataTable({
    ajax: {
      url: 'get_questions.php',  // Replace with your server-side endpoint
      dataSrc: '',  // Empty string to indicate that the data is returned as an array
    },
    columns: [
      { data: 'question_id' },  // Replace 'column1' with the actual column name in your database
      { data: 'question' },  // Replace 'column2' with the actual column name in your database
      { data: 'choice_a' },  // Replace 'column3' with the actual column name in your database
      { data: 'choice_b' },  // Replace 'column3' with the actual column name in your database
      { data: 'choice_c' },  // Replace 'column3' with the actual column name in your database
      { data: 'choice_d' },  // Replace 'column3' with the actual column name in your database
      { data: 'correct_answer' },  // Replace 'column3' with the actual column name in your database
      { 
        data: null,
        render: function(data, type, row) {
          var questionID = row.question_id;
          return '<button onclick="alert("hello");" data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-warning edit-btn" data-question-id="' + questionID + '"><i class="bi bi-pencil-square"></i></button>' + '<button class="ms-2 btn btn-danger"><i class="bi bi-trash"></i></button>';
        }
      },
    ],
    columnDefs: [
      { targets: [2, 3, 4, 5, 6, 7], orderable: false } // Hide sorting for columns 1 and 3
    ]
  });
}



function addQuestion() {
  $("#addQuestionForm").submit(function (e) {
    e.preventDefault(); // Prevent the form from submitting normally

    // Get the form data
    var yourQuestion = $("#yourQuestion").val();
    var choiceOne = $("#choiceOne").val();
    var choiceTwo = $("#choiceTwo").val();
    var choiceThree = $("#choiceThree").val();
    var choiceFour = $("#choiceFour").val();
    var correctAnswer = $('input[name="correctAnswer"]:checked').val();

    // Basic validation
    if (!yourQuestion || !choiceOne || !choiceTwo || !choiceThree || !choiceFour || !correctAnswer) {
      // Display an error message or perform any other validation handling
      console.error("Please fill in all fields.");
      return;
    }

    // Form data is valid, proceed with the AJAX request
    var formData = {
      yourQuestion: yourQuestion,
      choiceOne: choiceOne,
      choiceTwo: choiceTwo,
      choiceThree: choiceThree,
      choiceFour: choiceFour,
      correctAnswer: correctAnswer,
    };

    // Send the AJAX request
    $.ajax({
      url: "../backend/add_question.php", // Replace with the actual URL to your server-side script
      type: "POST",
      data: formData,
      success: function (response) {
        // Handle the successful response
        console.log("Data added successfully");
        console.log(response);
        $("#addQuestionModal").modal("hide");
        $("#yourQuestion").val('');
        $("#choiceOne").val('');
        $("#choiceTwo").val('');
        $("#choiceThree").val('');
        $("#choiceFour").val('');
        $('input[name="correctAnswer"]').prop('checked', false);
        
        // Load the updated data into the table
        add_question_alert();
      },
      error: function (xhr, status, error) {
        // Handle the error
        console.error("Error adding data:", error);
      },
    });
  });
}

function editQuestion(questionId) {
  // Get the existing question data from the table
  var questionData = $('#myTable').DataTable().row('#question_' + questionId).data();

  // Pre-fill the form with the existing data
  $("#editQuestionId").val(questionData.question_id);
  $("#editYourQuestion").val(questionData.question);
  $("#editChoiceOne").val(questionData.choice_a);
  $("#editChoiceTwo").val(questionData.choice_b);
  $("#editChoiceThree").val(questionData.choice_c);
  $("#editChoiceFour").val(questionData.choice_d);
  $('input[name="editCorrectAnswer"][value="' + questionData.correct_answer + '"]').prop('checked', true);

  // Show the edit modal
  $("#editQuestionModal").modal("show");
}

$("#editQuestionForm").submit(function (e) {
  e.preventDefault(); // Prevent the form from submitting normally

  // Get the form data
  var questionId = $("#editQuestionId").val();
  var yourQuestion = $("#editYourQuestion").val();
  var choiceOne = $("#editChoiceOne").val();
  var choiceTwo = $("#editChoiceTwo").val();
  var choiceThree = $("#editChoiceThree").val();
  var choiceFour = $("#editChoiceFour").val();
  var correctAnswer = $('input[name="editCorrectAnswer"]:checked').val();

  // Basic validation
  if (!yourQuestion || !choiceOne || !choiceTwo || !choiceThree || !choiceFour || !correctAnswer) {
    // Display an error message or perform any other validation handling
    console.error("Please fill in all fields.");
    return;
  }

  // Form data is valid, proceed with the AJAX request
  var formData = {
    questionId: questionId,
    yourQuestion: yourQuestion,
    choiceOne: choiceOne,
    choiceTwo: choiceTwo,
    choiceThree: choiceThree,
    choiceFour: choiceFour,
    correctAnswer: correctAnswer,
  };

  // Send the AJAX request
  $.ajax({
    url: "../backend/edit_question.php", // Replace with the actual URL to your server-side script
    type: "POST",
    data: formData,
    success: function (response) {
      // Handle the successful response
      console.log("Data edited successfully");
      console.log(response);
      $("#editQuestionModal").modal("hide");

      // Load the updated data into the table
      loadQuestions();
      edit_question_alert();
    },
    error: function (xhr, status, error) {
      // Handle the error
      console.error("Error editing data:", error);
    },
  });
});



function logOut(){
  $.ajax({
    url: '../backend/logout.php',
    type: 'POST',
    success: function(response) {
      // Redirect to the login page or perform any other actions
      var delay = 1000;
      setTimeout(function(){ window.location = '../index.php' }, delay);  
      logout_success_alert();
    },
    error: function(xhr, status, error) {
      // Handle error
      console.log(error);
    }
  });
}
