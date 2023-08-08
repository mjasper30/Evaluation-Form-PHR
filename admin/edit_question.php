<?php
require('includes/dbconn.php');

if (isset($_POST['update_question'])) {
    $questionId = mysqli_real_escape_string($conn, $_POST['question_id']);
    $yourCategory = mysqli_real_escape_string($conn, $_POST['editYourCategory']);
    $yourQuestion = mysqli_real_escape_string($conn, $_POST['editYourQuestion']);
    $choiceOne = mysqli_real_escape_string($conn, $_POST['choiceOneEdit']);
    $choiceTwo = mysqli_real_escape_string($conn, $_POST['choiceTwoEdit']);
    $choiceThree = mysqli_real_escape_string($conn, $_POST['choiceThreeEdit']);
    $choiceFour = mysqli_real_escape_string($conn, $_POST['choiceFourEdit']);
    $correctAnswer = mysqli_real_escape_string($conn, $_POST['correctAnswerEdit']);

    // if ($yourQuestion == NULL || $choiceOne == NULL || $choiceTwo == NULL || $choiceTwo == NULL || $choiceThree == NULL || $choiceFour == NULL || $correctAnswer || NULL) {
    //     $res = [
    //         'status' => 422,
    //         'message' => 'All fields are mandatory'
    //     ];
    //     echo json_encode($res);
    //     return;
    // }

    $query = "UPDATE `questions` SET `category`='$yourCategory', `question`='$yourQuestion', `choice_a`='$choiceOne', `choice_b`='$choiceTwo', `choice_c`='$choiceThree', `choice_d`='$choiceFour', `correct_answer`='$correctAnswer' WHERE `question_id`=$questionId";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Question Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Question Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}