function addQuestion() {
  $("#addQuestionForm").submit(function (e) {
    e.preventDefault(); // Prevent the form from submitting normally

    // Get the form data
    var formData = {
      yourQuestion: $("#yourQuestion").val(),
      choiceOne: $("#choiceOne").val(),
      choiceTwo: $("#choiceTwo").val(),
      choiceThree: $("#choiceThree").val(),
      choiceFour: $("#choiceFour").val(),
      correctAnswer: $('input[name="correctAnswer"]:checked').val(),
    };

    // Send the AJAX request
    $.ajax({
      url: "backend/add_question.php", // Replace with the actual URL to your server-side script
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


function loadQuestions() {
  var table = $('#myTable').DataTable({
    columnDefs: [
      { targets: [2, 3, 4, 5, 6, 7], orderable: false } // Hide sorting for columns 1 and 3
    ]
  });

  $.ajax({
    url: 'get_questions.php', // Replace with the correct path to your PHP script
    method: 'GET', // Use the appropriate HTTP method (GET, POST, etc.)
    dataType: 'json', // Specify the expected data type
    success: function(data) {
      // Handle the returned data
      console.log(data); // Example: Output the data to the console

      // Clear any existing data from the table
      table.clear();

      // Loop through the data and add rows to the table
      $.each(data, function(index, question) {
        // Create a button element
        var editButton = '<div class="row"><div class="col-6"><button class="btn btn-warning mb-2" data-id="' + question.question_id + '"><i class="bi bi-pencil-square"></i></button></div>';
        var deleteButton = '<div class="col-6"><button class="btn btn-danger" data-id="' + question.question_id + '"><i class="bi bi-trash"></i></button></div></div>';

        table.row.add([
          question.question_id,
          question.question,
          question.choice_a,
          question.choice_b,
          question.choice_c,
          question.choice_d,
          question.correct_answer,
          editButton + deleteButton
        ]);
      });

      // Redraw the table to display the new data
      table.draw();
    },
    error: function(xhr, status, error) {
      // Handle any errors that occur during the request
      console.error(status + ': ' + error);
    }
  });
}


function logOut(){
  $.ajax({
    url: 'backend/logout.php',
    type: 'POST',
    success: function(response) {
      // Redirect to the login page or perform any other actions
      var delay = 1000;
      setTimeout(function(){ window.location = 'index.php' }, delay);  
      logout_success_alert();
    },
    error: function(xhr, status, error) {
      // Handle error
      console.log(error);
    }
  });
}
