<?php
include('config.php');

try {
    $conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD);
    if ($conn->connect_error) {
        throw new Exception("CONNECTION FAILED : " . $conn->connect_error);
    }
    SUCCESS_MESSAGE("CONNECT COMPLETED SUCCESSFULLY");
} catch (Exception $e) {
    ERROR_MESSAGE($e->getMessage());
}
