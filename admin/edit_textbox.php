<?php
require('includes/dbconn.php');

if (isset($_POST['update_textbox'])) {
    $textboxId = mysqli_real_escape_string($conn, $_POST['textbox_id']);
    $yourTextbox = mysqli_real_escape_string($conn, $_POST['editYourTextbox']);

    // if ($yourTextbox == NULL || $choiceOne == NULL || $choiceTwo == NULL || $choiceTwo == NULL || $choiceThree == NULL || $choiceFour == NULL || $correctAnswer || NULL) {
    //     $res = [
    //         'status' => 422,
    //         'message' => 'All fields are mandatory'
    //     ];
    //     echo json_encode($res);
    //     return;
    // }

    $query = "UPDATE `textbox` SET `textbox`='$yourTextbox' WHERE `textbox_id`=$textboxId";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Textbox Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Textbox Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}
