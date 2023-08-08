function loadQuestions() {
  // DataTable initialization
  $("#myTable").DataTable({
    ajax: {
      url: "get_questions.php", // Replace with your server-side endpoint
      dataSrc: "", // Empty string to indicate that the data is returned as an array
      responsive: true,
    },
    columns: [
      { width: "20px", data: "question_id" }, // Set width of 20 pixels for the first column
      { width: "200px", data: "category" }, // Set width of 20 pixels for the first column
      { width: "200px", data: "question" }, // Set width of 200 pixels for the second column
      { width: "150px", data: "choice_a" }, // Set width of 150 pixels for the third column
      { width: "150px", data: "choice_b" }, // Set width of 150 pixels for the fourth column
      { width: "150px", data: "choice_c" }, // Set width of 150 pixels for the fifth column
      { width: "150px", data: "choice_d" }, // Set width of 150 pixels for the sixth column
      { width: "100px", data: "correct_answer" }, // Set width of 100 pixels for the seventh column
      {
        data: null,
        width: "100px",
        render: function (data, type, row) {
          var questionID = row.question_id;
          return (
            '<button class="editQuestionBtn btn btn-warning" data-question-id="' +
            questionID +
            '" value="' +
            questionID +
            '"><i class="bi bi-pencil-square"></i></button>' +
            '<button class="deleteQuestionBtn ms-2 btn btn-danger" data-question-id="' +
            questionID +
            '" value="' +
            questionID +
            '"><i class="bi bi-trash"></i></button>'
          );
        },
      },
    ],
    columnDefs: [
      { targets: [3, 4, 5, 6, 7, 8], orderable: false }, // Hide sorting for columns 1 and 3
    ],
  });
}

var question_id;

// Get id and value from the table
$(document).on("click", ".editQuestionBtn", function () {
  question_id = $(this).data("question-id");
  // var question_id = $(this).val();

  $.ajax({
    type: "GET",
    url: "get_question_id.php?question_id=" + question_id,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 422) {
        alert(res.message);
      } else if (res.status == 200) {
        $("#category_id").val(res.data.question_id);
        $("#editYourCategory").val(res.data.category);
        $("#editYourQuestion").val(res.data.question);
        $("#choiceOneEdit").val(res.data.choice_a);
        $("#choiceTwoEdit").val(res.data.choice_b);
        $("#choiceThreeEdit").val(res.data.choice_c);
        $("#choiceFourEdit").val(res.data.choice_d);

        $("#editQuestionModal").modal("show");
      }
    },
  });
});

// Confirmation Modal
$(document).on("click", ".deleteQuestionBtn", function (e) {
  e.preventDefault();
  var question_id = $(this).data("question-id");

  // Set the question ID value in the modal
  $("#confirmationModal").data("question-id", question_id);

  // Show the confirmation modal
  $("#confirmationModal").modal("show");
});

// Handle the delete action when the confirmation is confirmed
$("#confirmDeleteBtn").on("click", function () {
  var question_id = $("#confirmationModal").data("question-id");
  //  var question_id = $(this).val();
  $.ajax({
    type: "POST",
    url: "delete_question.php",
    data: {
      delete_question: true,
      question_id: question_id,
    },
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 500) {
        alert(res.message);
      } else {
        // If deletion is successful, update the table without refreshing
        $("#myTable").DataTable().ajax.reload();
      }
    },
  });

  // Close the modal
  $("#confirmationModal").modal("hide");
});

$(document).on("submit", "#editQuestionForm", function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("update_question", true);
  formData.append("question_id", question_id); // Add question_id to the formData object

  $.ajax({
    type: "POST",
    url: "edit_question.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 422) {
        alert(res.message);
      } else if (res.status == 200) {
        $("#editQuestionModal").modal("hide");
        $("#editQuestionForm")[0].reset();

        // Load the updated data into the table
        $("#myTable").DataTable().ajax.reload();
        edit_question_alert();
      } else if (res.status == 500) {
        alert(res.message);
      }
    },
  });
});


function logOut() {
  $.ajax({
    url: "../backend/logout.php",
    type: "POST",
    success: function (response) {
      // Redirect to the login page or perform any other actions
      var delay = 1000;
      setTimeout(function () {
        window.location = "../index.php";
      }, delay);
      logout_success_alert();
    },
    error: function (xhr, status, error) {
      // Handle error
      console.log(error);
    },
  });
}
