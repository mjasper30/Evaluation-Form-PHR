<?php
require('../fpdf/fpdf.php'); // Include the FPDF library

date_default_timezone_set('Asia/Manila');
// Get the current date in Y-m-d format
$currentDate = date("Y-m-d");

// Convert the current date to a timestamp
$timestamp = strtotime($currentDate);

// Format the date in the desired format
$formattedDate = date("d.m.Y", $timestamp);

// Function to generate the PDF
function generatePDF($title, $name, $questions)
{
    // Create a DateTime object with the current date
    $now = new DateTime();
    // Get the current year
    $currentYear = date("Y");
    $subtitle = "General Questionaire";

    // Format the date in a human-readable format
    $formattedDate = $now->format('F j, Y');
    $pdf = new FPDF();
    $pdf->AddPage();

    // Set font and size for title
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(40, 1, "HR Evaluation Form - " . $currentYear . "-HR-EF-OPD", 0, 1, 'C');

    // Add image
    $logoPath = 'images/phr-logo.png'; // Set the image file path here
    $pdf->Image($logoPath, 100, 5, 10); // Adjust the coordinates and size as needed

    // Set font and size for title
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, $title, 0, 1, 'C');
    $pdf->Ln(-9); // Add some spacing

    // Set font and size for title
    $pdf->SetFont('Arial', '', 18);
    $pdf->Cell(0, 10, '______________________' , 0, 1, 'C');
    $pdf->Ln(-3); // Add some spacing

    // Set font and size for title
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, $subtitle, 0, 1, 'C');
    $pdf->Ln(10); // Add some spacing

    // Set font and size for name
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, "Employee's Name: " . $name, 0, 1, 'L');
    $pdf->Ln(1); // Add some spacing after the name

    // Set font and size for name
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, "Division: " . $name, 0, 1, 'L');
    $pdf->Ln(1); // Add some spacing after the name

    // Set font and size for name
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, "Date: " . $formattedDate, 0, 1, 'L');
    $pdf->Ln(10); // Add some spacing after the name

    // Set font and size for questions and choices
    $pdf->SetFont('Arial', 'B', 12);

    // Add questions and choices to the PDF
    foreach ($questions as $index => $question) {
        $pdf->Cell(0, 8, 'Question ' . ($index + 1) . ': ' . $question['question'], 0, 1);

        // Add choices
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 8, 'A) ' . $question['choice_a'], 0, 1);
        $pdf->Cell(0, 8, 'B) ' . $question['choice_b'], 0, 1);
        $pdf->Cell(0, 8, 'C) ' . $question['choice_c'], 0, 1);
        $pdf->Cell(0, 8, 'D) ' . $question['choice_d'], 0, 1);

        $pdf->SetFont('Arial', 'B', 10); // Reset font size for next question
        $pdf->Ln(10); // Add some spacing between questions
    }

    // Output the PDF
    $pdf->Output();
}

// Connect to the database
require('includes/dbconn.php');

// Fetch questions from the database
$questions = array();

$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
} else {
    echo "No questions found in the database.";
}

$conn->close();

// Call the function to generate the PDF
$title = "Examination " . $formattedDate; // Set the title here

$name = "___________________________"; // Set the name here
generatePDF($title, $name, $questions);
?>

