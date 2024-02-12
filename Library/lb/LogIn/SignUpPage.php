<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Library</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Lato", sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: #ecf0f3;
        }

        .gfg-div {
            width: 90%;
            max-width: 600px;
            padding: 20px;
            border-radius: 20px;
            background: #ecf0f3;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .gfg-logo {
            background: url("readershome-high-resolution-logo.png");
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
            margin-top: 10px;
            letter-spacing: 0.5px;
            color: #0766AD;
        }

        .gfg-input-fields {
            width: 100%;
            margin-top: 20px;
        }

        .gfg-name,
        .gfg-email,
        .gfg-password,
        .gfg-address,
        .gfg-interests {
            margin-bottom: 15px;
            border-radius: 15px;
            box-shadow: inset 3px 3px 5px #cbced1, inset -3px -3px 5px #ffffff;
        }

        .gfg-input-fields input {
            width: 100%;
            border: none;
            outline: none;
            background: none;
            font-size: 16px;
            color: #555;
            padding: 10px 15px;
        }

        .gfg-button {
            outline: none;
            border: none;
            cursor: pointer;
            width: 100%;
            height: 50px;
            border-radius: 15px;
            font-size: 18px;
            font-weight: 700;
            color: #fff;
            background: #0766AD;
            box-shadow: 3px 3px 5px #cbced1, -3px -3px 5px #ffffff;
            transition: background 0.5s;
        }

        .gfg-button:hover {
            background: #3887BE;
        }

        .gfg-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .gfg-link a {
            text-decoration: none;
            color: #555;
            margin-right: 10px;
            transition: color 0.5s;
        }

        .gfg-link a:hover {
            color: #0766AD;
        }

        @media (max-width: 600px) {
            .gfg-div {
                width: 100%;
                border-radius: 0;
                box-shadow: none;
            }

            .gfg-input-fields .gfg-name,
            .gfg-input-fields .gfg-email,
            .gfg-input-fields .gfg-password,
            .gfg-input-fields .gfg-address,
            .gfg-input-fields .gfg-interests {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="gfg-div">
        <div class="gfg-logo"></div>
        <div class="gfg-title">ReadersHome</div>
        <form action="signbe.php" method="post">
        <div class="gfg-input-fields">
            
            <?php 
                if(isset($fname_error)){
                    echo "<p style='color: red;'>$fname_error</p>";
                }
            ?>
            <div class="gfg-name">
                <input type="text" name="firstname" placeholder="First name" />
            </div>
            
                <?php 
                if(isset($lname_error)){
                    echo "<p style='color: red;'>$lname_error</p>";
                }
                ?>
            <div class="gfg-name">
                <input type="text" name="lastname" placeholder="Last name" />
            </div>
            
                <?php 
                if(isset($email_error)){
                    echo "<p style='color: red;'>$email_error</p>";
                }
                ?>
            <div class="gfg-email">
                <input type="email" name="email" placeholder="Email" />
            </div>
            
                <?php 
                if(isset($num_error)){
                    echo "<p style='color: red;'>$num_error</p>";
                }
                ?>
            <div class="gfg-name">
                <input type="text" name="number" placeholder="Phone Number" />
            </div>
            
                <?php
                    if(isset($age_error)){
                    echo "<p style='color: red;'>$age_error</p>";
                }
                ?>
            <div class="gfg-name">
                <input type="text" name="age" placeholder="Age" />
            </div>
            
                <?php 
                if(isset($address_error)){
                    echo "<p style='color: red;'>$address_error<p>";
                }
                ?>
            <div class="gfg-address">
                <input type="text" name="address" placeholder="Address" />
            </div>
            
                <?php 
                if(isset($interests_error)){
                    echo "<p style='color: red;'>$interests_error</p>";
                }
                ?>
            <div class="gfg-interests">
                <input type="text" name="interests" placeholder="Interests" />
            </div>
            
                <?php 
                if(isset($password_error)){
                    echo "<p style='color: red;'>$password_error</p>";
                }
                ?>
            <div class="gfg-password">
                <input type="password" name="password" placeholder="Password" />
            </div>
            
                <?php 
                if(isset($confpass_error)){
                    echo"<p style='color: red;'> $confpass_error</p>";
                }
                ?>
            <div class="gfg-password">
                <input type="password" name="confpass" placeholder="Confirm Password" />
            </div>
        </div>
        <button class="gfg-button" name="submit">Library Signup</button>
        </form>
        <div class="gfg-link">
            Already have an account?<a href="loginn.php"> Log in</a>
            
        </div>
    </div>
</body>

</html>
