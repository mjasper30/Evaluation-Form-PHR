<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- Bootstrap Link CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <!-- jQuery Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--Alert JS-->
    <script src="js/alert.js"></script>
    <!--Alert CSS-->
    <link rel="stylesheet" href="css/alert.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Admin</h1>
        <!-- Add Button Question trigger modal -->
        <div class="row">
            <div class="col-2 mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                Add Question
                </button>
            </div>
            <div class="col-2 mb-3">
                <button onclick="logOut()" name="logOut" class="btn btn-primary">Logout</button>
            </div>
        </div>


        <!-- Table -->
        <table id="myTable" class="table table-info table-striped table-hover">
            <thead class="table table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Question</th>
                    <th scope="col">Choice 1</th>
                    <th scope="col">Choice 2</th>
                    <th scope="col">Choice 3</th>
                    <th scope="col">Choice 4</th>
                    <th scope="col">Correct Answer</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jasper</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jasper</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jasper</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jasper</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                </tr>
            </tbody>
        </table>


        <!-- Add Question Modal -->
        <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addQuestionModalLabel">Add Question</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addQuestionForm">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" name="yourQuestion" id="yourQuestion" style="height: 100px" required></textarea>
                        <label for="yourQuestion">What is your question?</label>
                    </div>

                    <label for="choiceOne" class="form-label">Choice 1</label>
                    <div class="input-group">
                        <div class="input-group-text">
                        <input class="form-check-input mt-0" type="radio" name="correctAnswer" value="Choice One" aria-label="Radio button for following text input" required>
                        </div>

                        <input type="text" name="choiceOne" id="choiceOne" class="form-control" aria-label="Text input with radio button" required>
                    </div>


                    <label for="choiceTwo" class="form-label">Choice 2</label>
                    <div class="input-group">
                        <div class="input-group-text">
                        <input class="form-check-input mt-0" type="radio" name="correctAnswer" value="Choice Two" aria-label="Radio button for following text input" required>
                        </div>

                        <input type="text" name="choiceTwo" id="choiceTwo" class="form-control" aria-label="Text input with radio button" required>
                    </div>


                    <label for="choiceThree" class="form-label">Choice 3</label>
                    <div class="input-group">
                        <div class="input-group-text">
                        <input class="form-check-input mt-0" type="radio" name="correctAnswer" value="Choice Three" aria-label="Radio button for following text input" required>
                        </div>

                        <input type="text" name="choiceThree" id="choiceThree" class="form-control" aria-label="Text input with radio button" required>
                    </div>

                    <label for="choiceFour" class="form-label">Choice 4</label>
                    <div class="input-group">
                        <div class="input-group-text">
                        <input class="form-check-input mt-0" type="radio" name="correctAnswer" value="Choice Four" aria-label="Radio button for following text input" required>
                        </div>

                        <input type="text" name="choiceFour" id="choiceFour" class="form-control" aria-label="Text input with radio button" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="addQuestion()" type="submit" name="addQuestionName" class="btn btn-primary">Add</button>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- DataTable Initialization -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable()
            loadQuestions();
        });
    </script>
    <!-- Functionality -->
    <script src="js/script.js"></script>
    <!-- Crud -->
    <script src="js/crud.js"></script>

    <!-- Boostrap Link JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    
</body>
</html>