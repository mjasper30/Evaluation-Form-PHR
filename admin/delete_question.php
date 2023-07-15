<?php
require('includes/dbconn.php');

if (isset($_POST['delete_question'])) {
    $question_id = mysqli_real_escape_string($conn, $_POST['question_id']);

    $query = "DELETE FROM `questions` WHERE question_id='$question_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Question Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Question Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
