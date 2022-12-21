<?php

// Function to find the difference
// between two dates.
function dateDiffInDays($date1, $date2)
{
	// Calculating the difference in timestamps
	$diff = date('d-m-Y', strtotime($date2)) - date('d-m-Y', strtotime($date1));

	// 1 day = 24 hours
	// 24 * 60 * 60 = 86400 seconds
	return abs(round($diff / 86400));
}

// Start date
$date1 = "11-09-2018";

// End date
$date2 = "30-09-2018";

// Function call to find date difference
$dateDiff = dateDiffInDays($date1, $date2);

$week = $dateDiff/7; 
$days = $dateDiff%7;

// Display the result
printf("Days: ". $dateDiff);
printf("<br>Weeks: ". (int)$week);
printf("<br>Days: ". round($days));
?>
