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
    $subtitle = "General Questionnaire";

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
    $pdf->Cell(0, 10, '______________________', 0, 1, 'C');
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
    $pdf->Cell(0, 10, "Date: " . $formattedDate, 0, 1, 'L'); // Use 0, 1 to add a line break after the date
    $pdf->Ln(10); // Add some spacing after the date

    // Text to display inside the box
    $score = "Score/Grade";
    // Set font and size for the score text
    $pdf->SetFont('Arial', '', 12);

    // Set width and height for the box
    $boxWidth = 40;
    $boxHeight = 20;

    // Set absolute X and Y coordinates for the box
    $boxX = 155;
    $boxY = 40;

    // Set absolute X and Y coordinates for the score text
    $textX = $boxX + ($boxWidth / 2) - ($pdf->GetStringWidth($score) / 2);
    $textY = $boxY + $boxHeight + 5;

    // Draw the box at the absolute position
    $pdf->SetXY($boxX, $boxY);
    $pdf->Rect($boxX, $boxY, $boxWidth, $boxHeight);

    // Add the score text at the absolute position below the box
    $pdf->SetXY($textX, $textY);
    $pdf->Cell($boxWidth, 10, $score, 0, 0, 'C');

    // Move the box and score text to a new position on the page
    $boxX = 120;
    $boxY = 80;

    $textX = $boxX + ($boxWidth / 2) - ($pdf->GetStringWidth($score) / 2);
    $pdf->Ln(10); // Add some spacing after the date

    // Set font and size for questions and choices
    $pdf->SetFont('Arial', 'B', 10);

    $margin = 15; // Set the margin size

    // Add questions and choices to the PDF
    foreach ($questions as $index => $question) {
        $cellWidth = 180; // Set the width of the cell
        $cellHeight = 8;  // Set the height of the cell
        $text = 'Question ' . ($index + 1) . ': ' . $question['question'];

        // Calculate the number of lines needed for the text
        $numLines = ceil($pdf->GetStringWidth($text) / $cellWidth);

        // Calculate the total height required for the text
        $textHeight = $numLines * $cellHeight;

        // Check if the text height exceeds the remaining space on the page, add a new page if needed
        if ($pdf->GetY() + $textHeight > $pdf->GetPageHeight() - $margin) {
            $pdf->AddPage();
        }

        // Add the text to the cell
        $pdf->MultiCell($cellWidth, $cellHeight, $text, 0, 'L');


        // Add choices
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 8, 'A) ' . $question['choice_a'], 0, 1);
        $pdf->Cell(0, 8, 'B) ' . $question['choice_b'], 0, 1);
        $pdf->Cell(0, 8, 'C) ' . $question['choice_c'], 0, 1);
        $pdf->Cell(0, 8, 'D) ' . $question['choice_d'], 0, 1);

        $pdf->SetFont('Arial', 'B', 10); // Reset font size for next question
        $pdf->Ln(10); // Add some spacing between questions
    }

    // Set font and size for the score text
    $pdf->SetFont('Arial', '', 12);

    // Set width and height for the box
    $boxWidth = 80;
    $boxHeight = 45;

    // Set absolute X and Y coordinates for the box
    $boxX = 115;
    $boxY = 230;

    // Set absolute X and Y coordinates for the score text
    $textX = $boxX + ($boxWidth / 2) - ($pdf->GetStringWidth($score) / 2);
    $textY = $boxY + $boxHeight + 5;

    // Draw the box at the absolute position
    $pdf->SetXY($boxX, $boxY);
    $pdf->Rect($boxX, $boxY, $boxWidth, $boxHeight);

    // Move the box and score text to a new position on the page
    $boxXNew = 120; // New X position for the box
    $boxYNew = 10;  // New Y position for the box

    $textXNew = $boxXNew + ($boxWidth / 2) - ($pdf->GetStringWidth($score) / 2);
    $textYNew = $boxYNew + $boxHeight + 5;

    // Add the score text at the new absolute position below the box
    $pdf->SetXY($textXNew, $textYNew);

    // Add text inside the new box
    $pdf->SetFont('Arial', '', 10);
    $boxText = "Employer Signature: _________________"; // Replace with your desired text
    $pdf->SetXY($boxXNew, $boxYNew + 229); // Adjust the coordinates for padding
    $pdf->MultiCell($boxWidth - 10, 8, $boxText, 0, 'L');

    // Add text inside the new box
    $pdf->SetFont('Arial', '', 10);
    $boxText = "Noted by: OPD _____________________"; // Replace with your desired text
    $pdf->SetXY($boxXNew, $boxYNew + 239); // Adjust the coordinates for padding
    $pdf->MultiCell($boxWidth - 10, 8, $boxText, 0, 'L');

    // Add text inside the new box
    $pdf->SetFont('Arial', '', 10);
    $boxText = "Approved by: MGT __________________"; // Replace with your desired text
    $pdf->SetXY($boxXNew, $boxYNew + 249); // Adjust the coordinates for padding
    $pdf->MultiCell($boxWidth - 10, 8, $boxText, 0, 'L');

    // Adjust the following content (questions and choices)
    $pdf->Ln(10); // Add some spacing after the box


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