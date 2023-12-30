<?php
$file = 'files/courseSearch.xlsm';

// Set headers to force download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file) . '"');

// Read the file and output it to the browser
readfile($file);
exit;
?>
