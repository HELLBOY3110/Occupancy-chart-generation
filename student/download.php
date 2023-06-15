<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['roomNumber'])) {
    $roomNumber = $_POST['roomNumber'];
    $timetable = generateTimetable($roomNumber, $conn);

    if (!empty($timetable)) {
        // Generate a CSV file of the timetable
        $filename = "timetable_$roomNumber.csv";
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('Day/Slot', 'Slot 1', 'Slot 2', 'Slot 3', 'Slot 4', 'Slot 5', 'Slot 6', 'Slot 7', 'Slot 8'));
        $days = array("", "Tuesday", "Wednesday", "Thursday", "Friday");
        foreach ($days as $day) {
            $row = array($day);
            for ($slot = 1; $slot <= 8; $slot++) {
                $row[] = $timetable[$day][$slot];
            }
            fputcsv($output, $row);
        }
        fclose($output);
        exit();
    } else {
        echo "No bookings found for room number $roomNumber.";
    }
}
?>

