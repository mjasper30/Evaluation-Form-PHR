<?php
require('includes/dbconn.php');

if (isset($_GET['textbox_id'])) {
    $textbox_id = mysqli_real_escape_string($conn, $_GET['textbox_id']);

    $query = "SELECT * FROM textbox WHERE textbox_id='$textbox_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $textbox = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Textbox ID Found',
            'data' => $textbox
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Textbox ID Not Found'
        ];
        echo json_encode($res);
        return false;
    }
}
