<?php
session_start();
$_SESSION['loggedin'] = true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Signup - Evaluation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-1.9.1.min.js"></script>
    <?php include('includes/dbconn.php'); ?>
    <?php include('includes/links.php'); ?>
    <style>
    body {
        overflow: hidden;
    }

    .bg-image-vertical {
        position: relative;
        overflow: hidden;
        background-repeat: no-repeat;
        background-position: right center;
        background-size: auto 100%;
    }

    @media (min-width: 1025px) {
        .h-custom-2 {
            height: 100%;
        }
    }
    </style>
</head>

<body>
    <?php
    if (isset($_POST['signup'])) {
        // Get the values from the form
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if the user already exists in the table
        $existingUserQuery = "SELECT * FROM `person` WHERE `username` = '$username'";
        $existingUserResult = mysqli_query($conn, $existingUserQuery);

        if (mysqli_num_rows($existingUserResult) > 0) {
            // User already exists, handle the error or display a message
            echo "<script>user_exist();</script>";
        } else {
            // User does not exist, insert the data
            $insertQuery = "INSERT INTO `person`(`firstname`, `lastname`, `username`, `password`, `role`) VALUES ('$firstname','$lastname','$username','$hashedPassword', 'employer')";

            // Execute the query
            if (mysqli_query($conn, $insertQuery)) {
                echo "<script>add_question_alert();</script>";
                echo "<script>location.window('index.php');</script>";
            } else {
                // Error occurred while executing the query
                echo "Error: " . mysqli_error($conn);
            }
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>
    <div class="container d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-sm-6 text-black animate__animated animate__bounceInLeft">

                <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                    <form style="width: 23rem;" id="signup_form" method="post">

                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign Up</h3>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="firstname">Firstname</label>
                            <input type="text" id="firstname" name="firstname" placeholder="Firstname"
                                class="form-control form-control-lg" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="lastname">Lastname</label>
                            <input type="text" id="lastname" name="lastname" placeholder="Lastname"
                                class="form-control form-control-lg" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" id="username" name="username" placeholder="Username"
                                class="form-control form-control-lg" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Password"
                                class="form-control form-control-lg" required />
                        </div>
                        <label class="form-label" for="password">Have an already account? <a href="index.php">Login
                                here</a></label>

                        <div class="pt-1 mb-4">
                            <button name="signup" type="submit" class="btn btn-info btn-lg btn-block">Sign up</button>
                        </div>

                    </form>

                </div>

            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block animate__animated animate__bounceInRight">
                <img src="images/login_bg1.svg" alt="Sign up image" style="object-fit: cover; object-position: left;">
            </div>
        </div>
    </div>

    <!--JS Bootstrap CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>