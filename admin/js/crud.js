function loadQuestions() {
  // DataTable initialization
  $('#myTable').DataTable({
    ajax: {
      url: 'get_questions.php',  // Replace with your server-side endpoint
      dataSrc: '',  // Empty string to indicate that the data is returned as an array
      responsive: true
    },
    columns: [
      { width: '20px', data: 'question_id' },  // Set width of 20 pixels for the first column
      { width: '200px', data: 'question' },  // Set width of 200 pixels for the second column
      { width: '150px', data: 'choice_a' },  // Set width of 150 pixels for the third column
      { width: '150px', data: 'choice_b' },  // Set width of 150 pixels for the fourth column
      { width: '150px', data: 'choice_c' },  // Set width of 150 pixels for the fifth column
      { width: '150px', data: 'choice_d' },  // Set width of 150 pixels for the sixth column
      { width: '100px', data: 'correct_answer' },  // Set width of 100 pixels for the seventh column
      { 
        data: null,
        width: '100px',
        render: function(data, type, row) {
          var questionID = row.question_id;
          return '<button class="editQuestionBtn btn btn-warning" value="' + questionID + '"><i class="bi bi-pencil-square"></i></button>' + '<button class="deleteQuestionBtn ms-2 btn btn-danger" data-question-id="'+ questionID +'" value="' + questionID + '"><i class="bi bi-trash"></i></button>';
        }
      },
    ],
    columnDefs: [
      { targets: [2, 3, 4, 5, 6, 7], orderable: false } // Hide sorting for columns 1 and 3
    ]
  });
}

// Get id and value from the table
$(document).on('click', '.editQuestionBtn', function() {
  var question_id = $(this).val();

  $.ajax({
    type: "GET",
    url: "get_question_id.php?question_id=" + question_id,
    success: function(response) {

      var res = jQuery.parseJSON(response);
      if (res.status == 422) {
        alert(res.message);
      } else if (res.status == 200) {
        $('#category_id').val(res.data.question_id);
        $('#editYourQuestion').val(res.data.question);
        $('#choiceOneEdit').val(res.data.choice_a);
        $('#choiceTwoEdit').val(res.data.choice_b);
        $('#choiceThreeEdit').val(res.data.choice_c);
        $('#choiceFourEdit').val(res.data.choice_d);

        $('#editQuestionModal').modal('show');
      }
    }
  });
});

// Confirmation Modal
$(document).on('click', '.deleteQuestionBtn', function(e) {
  e.preventDefault();
  var question_id = $(this).data('question-id');

  // Set the question ID value in the modal
  $('#confirmationModal').data('question-id', question_id);

  // Show the confirmation modal
  $('#confirmationModal').modal('show');
});

// Handle the delete action when the confirmation is confirmed
$('#confirmDeleteBtn').on('click', function() {
   var question_id = $('#confirmationModal').data('question-id');
    $.ajax({
      type: "POST",
      url: "delete_question.php",
      data: {
        'delete_question': true,
        'question_id': question_id
      },
      success: function(response) {
        var res = jQuery.parseJSON(response);
        if (res.status == 500) {
          alert(res.message);
        }else{
          // If deletion is successful, update the table without refreshing
          $('#myTable').DataTable().ajax.reload();
        }
      }
    });

  // Close the modal
  $('#confirmationModal').modal('hide');
});

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
        loadQuestions().ajax.reload();
        add_question_alert();
      },
      error: function (xhr, status, error) {
        // Handle the error
        console.error("Error adding data:", error);
      },
    });
  });
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
      loadQuestions().ajax.reload();
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
