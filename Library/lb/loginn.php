<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GFG Neumorphism Signin</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            font-family: "Lato", sans-serif;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #555;
            background: #ecf0f3;
        }

        .gfg-div {
            width: 90%; /* Adjust as needed for responsiveness */
            max-width: 430px;
            height: auto;
            padding: 20px 35px 15px 35px;
            border-radius: 35px;
            background: #ffffff;
            box-shadow: -6px -6px 6px rgba(255, 255, 255, 0.8),
                6px 6px 6px rgba(0, 0, 0, 0.2);
        }
        .gfg-logo {
            background: url("rh.png");
            background-size: 120px 120px;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto;
            box-shadow: 0 0 5px #5f5f5f, 0 0 5px 5px #ecf0f3, 5px 5px 10px #a7aaaf, -5px -5px 10px #ffffff;
        }

        .gfg-title {
            text-align: center;
            font-size: 28px;
            padding-top: 24px;
            letter-spacing: 0.5px;
            color: #5ed887;
        }

        .gfg-sub-title {
            text-align: center;
            font-size: 20px;
            padding-top: 7px;
            letter-spacing: 3px;
            color: #0766AD;
        }

        .gfg-input-fields {
            width: 100%;
            padding: 20px 5px 10px 5px;
        }

        .gfg-input-fields input {
            border: none;
            outline: none;
            background: none;
            font-size: 18px;
            color: #555;
            padding: 15px 10px 15px 5px;
        }

        .gfg-email,
        .gfg-password {
            margin-bottom: 20px;
            border-radius: 20px;
            box-shadow: inset 5px 5px 5px #cbced1,
                inset -5px -5px 5px #ffffff;
        }

        .gfg-input-fields svg {
            height: 22px;
            margin: 0 10px -3px 25px;
        }

        .gfg-button {
            outline: none;
            border: none;
            cursor: pointer;
            width: 100%;
            height: 60px;
            border-radius: 25px;
            font-size: 20px;
            font-weight: 700;
            font-family: "Lato", sans-serif;
            color: #fff;
            text-align: center;
            background: #0766AD;
            box-shadow: 7px 7px 8px #cbced1, -7px -7px 8px #ffffff;
            transition: 0.5s;
        }

        .gfg-button:hover {
            background: #3887BE;
        }

        .gfg-button:active {
            background: #3887BE;
        }

        .gfg-link {
            padding-top: 20px;
            text-align: center;
        }

        .gfg-link a {
            text-decoration: none;
            color: #aaa;
            font-size: 15px;
            transition: 0.5s;
        }

        .gfg-link a:hover {
            text-decoration: none;
            color: #0766AD;
            font-size: 15px;
        }

        @media only screen and (max-width: 600px) {
            .gfg-div {
                width: 90%; /* Adjust as needed for smaller screens */
                max-width: none;
            }
        }
    </style>
</head>

<?php global $error;
$error="";
?>
<?php
include('dbconnection.php');
session_start();

// Initialize error variable
$err = 0;

// Use the connectServer function from dbconnection.php to establish a connection
$dbc = connectServer('localhost', 'root', '', 1);

// Use the selectDB function from dbconnection.php to select the database
selectDB($dbc, 'librarydb1', 1);

if (isset($_POST['submit'])) {
    // ... (your existing code to retrieve form data)
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        $email_error = "Please enter your email";
        $err = 1;
    }
    if (empty($password)) {
        $password_error = "Please enter your password";
        $err = 1;
        include("loginn.php");
    }


    if ($err == 0) {
        // Perform the query with proper password handling
        $query = "SELECT userId, email, password FROM users WHERE email = '$email'";
        $result = mysqli_query($dbc, $query);

        if ($result) {
            $user = mysqli_fetch_assoc($result);
            if ($user && password_verify($password, $user['password'])) {
                $userId = $user['userId'];
                $userEmail = $user['email'];
                echo "Authentication successful";
                // Redirect or perform additional actions here
                header("Location:projet.php");


                $userEmail = str_replace('.', '_', $user['email']);

                if (array_key_exists( $userEmail, $_COOKIE)) {
                    echo "b";
                    $str = $_COOKIE[$userEmail];
                    $userInfo = explode("_", $str);
                    print_r($userInfo);
        
                    // Verify the password using password_verify
                    if ($user && password_verify($password, $userInfo[0])) {
                        // Correct pass, log in
                        $visit = $userInfo[1] + 1;
                        echo "it is our $visit visit <br><br>";
                        $arrUser = array($userInfo[0], $visit);
                        $str = implode("_", $arrUser);
                        setcookie($userEmail, $str, time() + 60 * 60 * 24, '/', '', true, true);
                    } else {
                        echo "your password isn't correct";
                    }}
                    else {
                        // It is the first time
                        $arrUser = array(password_hash($password, PASSWORD_DEFAULT), 1);
                        $str = implode("_", $arrUser);
                        setcookie($email, $str, time() + 60 * 60 * 24, '/', '', true, true);
                        echo "cookies are set";
                        
                    }
            } else {
                $error = "Invalid email or password. Please try again.";
                //echo "<script>alert('$error');</script>";
            }
        } else {
            $error = "Error executing the query.";
            //echo "<script>alert('$error');</script>";

        
        }
    }
}



// Display error message if any
// if (isset($error)) {
//     echo "<p style='color: red;'>$error</p>";
// }

// Close the database connection
$dbc->close();
?>


<body>
    <div class="gfg-div">
        <div class="gfg-logo"></div>
        <div class="gfg-title"></div>
        <div class="gfg-sub-title">ReadersHome</div>
        <div class="gfg-input-fields">
            <form action="loginn.php" method="post">
            <?php 
                if(isset($email_error)){
                    echo $email_error;
                }
            ?>
            
            <div class="gfg-email">
                <svg fill="#999" viewBox="0 0 1024 1024">
                    <path class="path1"
                        d="M896 307.2h-819.2c-42.347 0-76.8 34.453-76.8 76.8v460.8c0
                            42.349 34.453 76.8 76.8 76.8h819.2c42.349 0 76.8-34.451
                            76.8-76.8v-460.8c0-42.347-34.451-76.8-76.8-76.8zM896
                            358.4c1.514 0 2.99 0.158 4.434 0.411l-385.632 257.090c-14.862
                            9.907-41.938 9.907-56.802 0l-385.634-257.090c1.443-0.253
                            2.92-0.411 4.434-0.411h819.2zM896 870.4h-819.2c-14.115
                            0-25.6-11.485-25.6-25.6v-438.566l378.4 252.267c15.925
                            10.618 36.363 15.925 56.8 15.925s40.877-5.307
                            56.802-15.925l378.398-252.267v438.566c0 14.115-11.485
                            25.6-25.6 25.6z">
                    </path>
                </svg>
                <input type="email" name="email" placeholder="email" />
            </div>
            <?php 
                if(isset($password_error)){
                    echo $password_error;
                }
            ?>
            <div class="gfg-password">
                <svg fill="#999" viewBox="0 0 1024 1024">
                    <path class="path1"
                        d="M742.4 409.6h-25.6v-76.8c0-127.043-103.357-230.4-230.4-230.4s-230.4 103.357-230.4 230.4v76.8h-25.6c-42.347 0-76.8 34.453-76.8 76.8v409.6c0 42.347 34.453 76.8 76.8 76.8h512c42.347 0 76.8-34.453 76.8-76.8v-409.6c0-42.347-34.453-76.8-76.8-76.8zM307.2 332.8c0-98.811 80.389-179.2 179.2-179.2s179.2 80.389 179.2 179.2v76.8h-358.4v-76.8zM768 896c0 14.115-11.485 25.6-25.6 25.6h-512c-14.115 0-25.6-11.485-25.6-25.6v-409.6c0-14.115 11.485-25.6 25.6-25.6h512c14.115 0 25.6 11.485 25.6 25.6v409.6z">
                    </path>
                </svg>
                <input type="password" name="password" placeholder="password" />
            </div>
            <?php if($error)echo "<p style='color:red;'>".$error."</p>"?>
        </div>
        <button class="gfg-button" name="submit">LogIn</button>
        </form>
        <div class="gfg-link">
            Don't have account ?<a href="SignUpPage.php">Signup</a>
        </div>
    </div>
</body>
</html>
        