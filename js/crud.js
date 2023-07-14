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
      },
      error: function (xhr, status, error) {
        // Handle the error
        console.error("Error adding data:", error);
      },
    });
  });
}
