
<?php

include('dbconnection.php');


// Initialize error variable
$err = 0;
// Use the connectServer function from dbconnection.php to establish a connection
$dbc = connectServer('localhost', 'root', '', 0);

// Use the selectDB function from dbconnection.php to select the database
selectDB($dbc, 'librarydb1', 0);


if (isset($_POST['submit'])) {
    // ... (your existing code to retrieve form data)
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['number'];
    $age = $_POST['age'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confpass'];
    $err = 0;
    $address = $_POST['address'];
    $interests = $_POST['interests'];
    $role='user';
    // Validate fields (your existing validation code)
    // Validate first name
    if (empty($firstname)) {
        $fname_error = "Please enter your first name";
        $err = 1;
    } elseif (strlen($firstname) < 3) {
        $fname_error = "Enter at minimum 3 characters";
        $err = 1;
    } elseif (filter_var($firstname, FILTER_VALIDATE_INT)) {
        $fname_error = "Please enter your first name not a number";
        $err = 1;
    } else {
        $err = 0;
    }

    // ... (similar validation for other fields)
    if (empty($lastname)) {
        $lname_error = "please enter your last name";
        $err = 1;
    } elseif (strlen($lastname) < 3) {
        $lname_error = "enter at minimum 3 characters";
        $err = 1;
    } elseif (filter_var($lastname, FILTER_VALIDATE_INT)) {
        $lname_error = "please enter your last name not a number";
        $err = 1;
    } else {
        $err = 0;
    }

    if (empty($email)) {
        $email_error = "please enter your email";
        $err = 1;
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "please enter a valid email";
        $err = 1;
    } else {
        $err = 0;
    }


    if (empty($phonenumber)) {
        $num_error = "please enter your phone number";
        $err = 1;
    } elseif (!(filter_var($phonenumber, FILTER_VALIDATE_INT))) {
        $num_error = "please enter a valid phone number";
        $err = 1;
    } else {
        $err = 0;
    }

    if (empty($age)) {
        $age_error = "please enter your age";
        $err = 1;
    } elseif (!(filter_var($age, FILTER_VALIDATE_INT))) {
        $age_error = "please enter a valid age";
        $err = 1;
    } 

    if (empty($password)) {
        $pass_error = "please enter a password";
        $err = 1;
    } elseif (strlen($password) < 6) {
        $pass_error = "please enter at minimum  characters ";
        $err = 1;
    }
    
    if (empty($confirmpassword)) {
        $confpass_error = "please enter your password";
        $err = 1;
    } elseif ($password != $confirmpassword) {
        $pass_error = "please enter your old password";
        $err = 1;
        include('SignUpPage.php');
    } 
    
    if (empty($address)) {
            $address_error = "please enter your address";
            $err = 1;
    }
    
    if (empty($interests)) {
        $interests_error = "please enter your interests";
        $err = 1;
    }



    if ($err == 0) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        //$queryy = ("INSERT INTO users (firstName, lastName, email, address, age, phoneNumber, interests) 
          //  VALUES ($firstname, $lastname, $email, $address, $age, $phonenumber, $interests)");

        // Assuming $dbc is your database connection and $queryy is a valid SQL query string
        $queryy = "INSERT INTO users (firstName, lastName, email, address, age, phoneNumber, interests,password,role) 
            VALUES ('" . mysqli_real_escape_string($dbc, $firstname) . "', 
            '" . mysqli_real_escape_string($dbc, $lastname) . "',
            '" . mysqli_real_escape_string($dbc, $email) . "',
            '" . mysqli_real_escape_string($dbc, $address) . "', 
            '" . mysqli_real_escape_string($dbc, $age) . "',
            '" . mysqli_real_escape_string($dbc, $phonenumber) . "',
            '" . mysqli_real_escape_string($dbc, $interests) . "',
            '" . mysqli_real_escape_string($dbc,$hashedPassword ) . "', 
            '" . mysqli_real_escape_string($dbc,$role ) . "')";

        // Assuming $dbc is your database connection and $queryy is a valid SQL query string

        insertDataToTab($dbc, "users", $queryy);

        //header("Location: success.php");
        //exit();

        //-----------------------------------------------------------------------------------------------------------------------

        // Assuming $dbc is your database connection

    }else{
        include('SignUpPage.php');
    }
        
        // Close the database connection
        
    
}
// Close the database connection when done
mysqli_close($dbc);

?>
