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
    <title>Scores | Admin</title>
    <?php include('includes/links.php'); ?>
</head>

<body>
    <?php
    include('../includes/dbconn.php');
    ?>
    <?php include('includes/sidebar.php'); ?>

    <section class="page-content">
        <div class="container">
            <h1 class="text-center">Scores</h1>
            <!-- Content -->
            <div class="col-lg-12 col-md-9 col-sm-8">


                <!-- Table -->
                <table id="scoresTable" class="table table-info table-striped table-hover">
                    <thead class="table table-dark">
                        <tr>
                            <th scope="col">Score ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Score</th>
                            <th scope="col">Time Finished</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            loadScores();
        });

        // LOAD SCORES
        function loadScores() {
        // DataTable initialization
        $("#scoresTable").DataTable({
            ajax: {
            url: "get_scores.php", // Replace with your server-side endpoint
            dataSrc: "", // Empty string to indicate that the data is returned as an array
            },
            columns: [
            {data: "score_id" }, // Set width of 20 pixels for the first column
            {data: "username" }, // Set width of 200 pixels for the second column
            {data: "score" }, // Set width of 200 pixels for the second column
            {data: "time_finished" }, // Set width of 150 pixels for the third column
            ],
            columnDefs: [
            { targets: [2], orderable: false }, // Hide sorting for columns 1 and 3
            ],
        });
        }
    </script>
    <?php include('includes/scripts.php'); ?>
</body>

</html>