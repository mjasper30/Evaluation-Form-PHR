<?php
session_start();
$_SESSION['loggedin'] = true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login - Evaluation</title>
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
    <div class="container d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-sm-6 text-black animate__animated animate__bounceInLeft">

                <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                    <form style="width: 23rem;" id="login_form" method="post">

                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Welcome to PHR Evaluation</h3>

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
                        <p>Create an account. <a href="signup.php">Sign up
                                here</a></p>

                        <div class="pt-1 mb-4">
                            <button name="login" type="submit" class="btn btn-info btn-lg btn-block">Login</button>
                        </div>

                    </form>

                </div>

            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block animate__animated animate__bounceInRight">
                <img src="images/login_bg1.svg" alt="Login image" style="object-fit: cover; object-position: left;">
            </div>
        </div>
    </div>


    <script>
    jQuery(document).ready(function() {
        jQuery("#login_form").submit(function(e) {
            e.preventDefault();
            var formData = jQuery(this).serialize();
            $.ajax({
                type: "POST",
                url: "backend/login.php",
                data: formData,
                success: function(role) {
                    if (role == 'admin') {
                        var delay = 1000;
                        setTimeout(function() {
                            window.location = 'admin/index.php'
                        }, delay);
                        show_success_alert();
                    } else if (role == 'employer') {
                        var delay = 1000;
                        setTimeout(function() {
                            window.location = 'employer/evaluation.php'
                        }, delay);
                        show_success_alert();
                    } else {
                        show_Err_alert();
                    }
                }

            });
            let form = document.getElementById('login_form');
            form.reset();
            return false;
        });
    });
    </script>

    <!--JS Bootstrap CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>