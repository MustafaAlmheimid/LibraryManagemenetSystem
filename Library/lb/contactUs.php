<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #555;
            background: #ecf0f3;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        
        }
        
        .feedback-container {
      background-color: #fdfdfd;
      padding: 20px 35px 15px 35px;
            border-radius: 35px;
      
      margin-top: 20px;
      text-align: center;
      box-shadow: -6px -6px 6px rgba(255, 255, 255, 0.8),
                6px 6px 6px rgba(0, 0, 0, 0.2);
    }

    .feedback-box {
      width: 80%;
      margin: 0 auto;
      text-align: left;
    }

    .feedback-image {
      max-width: 250px;
      margin-top: 20px;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
        .container {
            
            align-items: center;
            justify-content: center;
            height: 30%;
            width:60%
           
        }

        .contact-form {
            max-width: 600px;
            width: 100%;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .input-group-prepend .input-group-text {
            border-radius: 15px 0 0 15px;
        }

        .input-group-append .input-group-text {
            border-radius: 0 15px 15px 0;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <?php
        // Check if the 'status' parameter is set in the URL
        if (isset($_GET['status'])) {
            $status = $_GET['status'];

            // Display success message if the status is 'success'
            if ($status === 'success') {
                echo '<div class="alert alert-success" role="alert">
                        <strong>Success!</strong> We received your message. Thanks for reaching out!
                      </div>';
            }

            // Display error message if the status is 'error'
            elseif ($status === 'error') {
                echo '<div class="alert alert-danger" role="alert">
                        <strong>Error!</strong> There was an issue submitting your message. Please try again.
                      </div>';
            }
        }
        ?>
        <div class="container">
            <div class="feedback-container">
                

              <div class="feedback-box">
             <img class="feedback-image" src="rh.png" alt="Feedback Image" />
                <h2 class="text-center mb-4">Contact Us</h2>
                <form action="sendMessage.php" method="post">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Your Name" id="name" name="name" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" placeholder="Your Email" id="email" name="email" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                        </div>
                        <input type="tel" class="form-control" placeholder="Your Phone Number" id="phone" name="phone" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-comment"></i></span>
                        </div>
                        <textarea class="form-control" placeholder="Your Message" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>


