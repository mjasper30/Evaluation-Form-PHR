<?php
require('includes/dbconn.php');

if (isset($_GET['question_id'])) {
    $question_id = mysqli_real_escape_string($conn, $_GET['question_id']);

    $query = "SELECT * FROM questions WHERE question_id='$question_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $question = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Question ID Found',
            'data' => $question
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Question ID Not Found'
        ];
        echo json_encode($res);
        return false;
    }
}
