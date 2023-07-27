<?php
session_start();

// Check if the session variable is not set or does not contain the necessary data
if (!isset($_SESSION['role']) || empty($_SESSION['role'])) {
    // Redirect to the login page or display an error message
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Textbox Admin</title>
    <?php include('includes/links.php'); ?>
</head>

<body>
    <?php
    include('../includes/dbconn.php');
    if (isset($_POST['yourTextbox'])) {
        // Get the values from the form
        $textbox = mysqli_real_escape_string($conn, $_POST['yourTextbox']);

        $sql = "INSERT INTO `textbox`(`textbox`) VALUES ('$textbox')";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            // Query executed successfully
            echo "Data added to the database.";
            echo "<script>add_question_alert();</script>";
        } else {
            // Error occurred while executing the query
            echo "Error: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>
    <?php include('includes/sidebar.php'); ?>

    <section class="page-content">
        <div class="container">
            <h1 class="text-center">Textbox</h1>
            <!-- Content -->
            <div class="col-lg-12 col-md-9 col-sm-8">
                <!-- Add Button Textbox trigger modal -->
                <div class="row">
                    <div class="col-3 mb-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTextboxModal">
                            <i class="bi bi-plus-lg"></i>
                            Add Textbox
                        </button>
                    </div>
                </div>


                <!-- Table -->
                <table id="myTable" class="table table-info table-striped table-hover">
                    <thead class="table table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Textbox</th>
                            <th style="width: 85px;" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>


                <!-- Add Textbox Modal -->
                <div class="modal fade" id="addTextboxModal" tabindex="-1" aria-labelledby="addTextboxModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addTextboxModalLabel">Add Textbox</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addTextboxForm" method="post">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a comment here" name="yourTextbox" maxlength="255" id="yourTextbox" style="height: 100px" required></textarea>
                                        <label for="yourTextbox">What is your textbox?</label>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="addTextboxName" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Textbox</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Textbox Modal -->
                <div class="modal fade" id="editTextboxModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Textbox</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editTextboxForm" method="post">
                                    <input type="hidden" name="textbox_id" id="textbox_id">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a comment here" name="editYourTextbox" maxlength="255" id="editYourTextbox" style="height: 100px" required></textarea>
                                        <label for="yourTextbox">What is your textbox?</label>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Confirmation Modal -->
                <div class="modal fade" id="confirmationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this data?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button id="confirmDeleteBtnTextbox" type="button" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            loadTextbox().ajax.reload();
        });

        function loadTextbox() {
            // DataTable initialization
            $("#myTable").DataTable({
                ajax: {
                url: "get_textbox.php", // Replace with your server-side endpoint
                dataSrc: "", // Empty string to indicate that the data is returned as an array
                responsive: true,
                },
                columns: [
                { width: "20px", data: "textbox_id" }, // Set width of 20 pixels for the first column
                { width: "200px", data: "textbox" }, // Set width of 200 pixels for the second column
                {
                    data: null,
                    width: "100px",
                    render: function (data, type, row) {
                    var textboxID = row.textbox_id;
                    return (
                        '<button class="editTextboxBtn btn btn-warning" data-textbox-id="' +
                        textboxID +
                        '" value="' +
                        textboxID +
                        '"><i class="bi bi-pencil-square"></i></button>' +
                        '<button class="deleteTextboxBtn ms-2 btn btn-danger" data-textbox-id="' +
                        textboxID +
                        '" value="' +
                        textboxID +
                        '"><i class="bi bi-trash"></i></button>'
                    );
                    },
                },
                ],
                columnDefs: [
                { targets: [2], orderable: false }, // Hide sorting for columns 1 and 3
                ],
            });
        }


        // Get id and value from the table
        $(document).on("click", ".editTextboxBtn", function () {
        var textbox_id = $(this).data("textbox-id");
        // var textbox_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "get_textbox_id.php?textbox_id=" + textbox_id,
            success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 422) {
                alert(res.message);
            } else if (res.status == 200) {
                $("#textbox_id").val(res.data.textbox_id);
                $("#editYourTextbox").val(res.data.textbox);

                $("#editTextboxModal").modal("show");
            }
            },
        });
        });

        // Confirmation Modal
        $(document).on("click", ".deleteTextboxBtn", function (e) {
            e.preventDefault();
            var textbox_id = $(this).data("textbox-id");

            // Set the textbox ID value in the modal
            $("#confirmationModal").data("textbox-id", textbox_id);

            // Show the confirmation modal
            $("#confirmationModal").modal("show");
            });

            // Handle the delete action when the confirmation is confirmed
            $("#confirmDeleteBtnTextbox").on("click", function () {
            var textbox_id = $("#confirmationModal").data("textbox-id");
            //  var textbox_id = $(this).val();
            $.ajax({
                type: "POST",
                url: "delete_textbox.php",
                data: {
                delete_textbox: true,
                textbox_id: textbox_id,
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

        $(document).on("submit", "#editTextboxForm", function (e) {
            var textbox_id = $(".editTextboxBtn").data("textbox-id");
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_textbox", true);
            formData.append("textbox_id", textbox_id); // Add textbox_id to the formData object

            $.ajax({
                type: "POST",
                url: "edit_textbox.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 422) {
                    alert(res.message);
                } else if (res.status == 200) {
                    $("#editTextboxModal").modal("hide");
                    $("#editTextboxForm")[0].reset();

                    // Load the updated data into the table
                    $("#myTable").DataTable().ajax.reload();
                    edit_question_alert();
                } else if (res.status == 500) {
                    alert(res.message);
                }
                },
            });
        });
    </script>
    <?php include('includes/scripts.php'); ?>
</body>

</html>