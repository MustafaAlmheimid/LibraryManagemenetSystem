<?php
define("ERROR_LOG_FILE_PATH", "C:/Users/mhama/OneDrive/Desktop/projects/zipfinal/database/error.log");
define("SUCCESS_LOG_FILE_PATH", "C:/Users/mhama/OneDrive/Desktop/projects/zipfinal/database/success.log");
define("SERVER_NAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE_NAME", "database_name");

function ERROR_MESSAGE($message)
{
    $currentDateTime = date('Y-m-d H:i:s');
    $formattedMessage = "ERROR:\nDate and Time: " . $currentDateTime . "\nMessage: " . $message;
    echo $formattedMessage;
    error_log($formattedMessage . "\n", 3, ERROR_LOG_FILE_PATH);
}

function SUCCESS_MESSAGE($message)
{
    $currentDateTime = date('Y-m-d H:i:s');
    $formattedMessage = "SUCCESS:\nDate and Time: " . $currentDateTime . "\nMessage: " . $message;
    echo $formattedMessage;
    error_log($formattedMessage . "\n", 3, SUCCESS_LOG_FILE_PATH);
}
