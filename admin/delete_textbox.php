<?php
require('includes/dbconn.php');

if (isset($_POST['delete_textbox'])) {
    $textbox_id = mysqli_real_escape_string($conn, $_POST['textbox_id']);

    $query = "DELETE FROM `textbox` WHERE textbox_id='$textbox_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Textbox Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Textbox Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
