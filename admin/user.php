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
    <title>Users | Admin</title>
    <?php include('includes/links.php'); ?>
</head>

<body>
    <?php
    include('../includes/dbconn.php');
    ?>
    <?php include('includes/sidebar.php'); ?>

    <section class="page-content">
        <div class="container">
            <h1 class="text-center">Users</h1>
            <!-- Content -->
            <div class="col-lg-12 col-md-9 col-sm-8">


                <!-- Table -->
                <table id="scoresTable" class="table table-info table-striped table-hover">
                    <thead class="table table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Firstname</th>
                            <th scope="col">Lastname</th>
                            <th scope="col">Username</th>
                            <th scope="col">Role</th>
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
            loadUsers();
        });

        // LOAD SCORES
        function loadUsers() {
        // DataTable initialization
        $("#scoresTable").DataTable({
            ajax: {
            url: "get_users.php", // Replace with your server-side endpoint
            dataSrc: "", // Empty string to indicate that the data is returned as an array
            },
            columns: [
            {data: "person_id" }, // Set width of 20 pixels for the first column
            {data: "firstname" }, // Set width of 200 pixels for the second column
            {data: "lastname" }, // Set width of 200 pixels for the second column
            {data: "username" }, // Set width of 150 pixels for the third column
            {data: "role" }, // Set width of 150 pixels for the third column
            ],
        });
        }
    </script>
    <?php include('includes/scripts.php'); ?>
</body>

</html>