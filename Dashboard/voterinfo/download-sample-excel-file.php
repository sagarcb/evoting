<?php
$filename = "voters.xlsx";
$filepath = "/evoting/Dashboard/voterinfo/sample-excel-file";

// Read the file contents
$file_contents = readfile($filepath);

// Set the appropriate headers
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$filename\"");

// Output the file contents
echo $file_contents;
exit();
