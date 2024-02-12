<?php
include('connect.php');
try {
    $query = "CREATE DATABASE IF NOT EXISTS " . DATABASE_NAME;
    if ($conn->query($query) === FALSE) {
        throw new Exception("DATABSE CREATION FAILED : " . $conn->error);
    }
    SUCCESS_MESSAGE("DATABASE CREATED SUCCESSFULLY");
} catch (Exception $e) {
    ERROR_MESSAGE($e->getMessage());
}
