<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Roberts Treize</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> 
    <style>
        body {
            font-family: 'Helvetica Neue', sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://via.placeholder.com/1500x1000.png?text=Tech+Background') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #004d40;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 15px 20px;
            text-decoration: none;
            font-size: 1.2em;
            color: white;
            display: block;
            text-align: left;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background-color: #00332a;
        }

        .content {
            margin-left: 260px;
            padding: 40px;
        }

        header {
            background-color: rgba(0, 77, 64, 0.9); 
            color: #fff;
            padding: 40px;
            text-align: center;
            overflow: hidden;
        }
        header h1 {
            font-size: 3.5em;
            font-weight: bold;
            animation: slideDown 1.5s ease-in-out forwards; 
            opacity: 1;
        }

             @keyframes slideDown {
            0% {
                transform: translateY(-100%);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        header p {
            font-size: 1.4em;
            margin: 10px 0;
            animation: fadeIn 2s ease-in-out;
        }

        .main-section {
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.5s ease;
        }

        .main-section:hover {
            transform: scale(1.05);
        }

        .main-section h2 {
            color: #004d40;
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        form input,
        form textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1.1em;
        }

        form input[type="submit"] {
            background-color: #004d40;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1.2em;
            transition: background-color 0.3s ease;
        }

        form input[type="submit"]:hover {
            background-color: #00332a;
        }

        footer {
            background-color: #004d40;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-top: 40px;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 2.5em;
            }

            header p {
                font-size: 1.1em;
            }

            .main-section h2 {
                font-size: 2em;
            }

            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 210px;Portfolio
            }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <a href="index.html">Home</a>
        <a href="about.html">About</a>
        <a href="experience.html">Experience</a>
        <a href="contact.php">Contact</a>
    </div>

    <div class="content">
        
        <header>
            <h1>Contact Me</h1>
            <p>Roberts Treize - Electrical Engineer | Innovator | Problem Solver</p>
        </header>

        
        <div class="main-section">
            <h2>Get in Touch</h2>

            <?php
            require 'vendor/autoload.php'; 

            use Twilio\Rest\Client;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = htmlspecialchars($_POST['name']);
                $email = htmlspecialchars($_POST['email']);Portfolio
                $message = htmlspecialchars($_POST['message']);
                $timestamp = date("Y-m-d H:i:s");
                $recaptchaResponse = $_POST['g-recaptcha-response'];

                $secretKey = '6LfZz24qAAAAALyDpQ1iIsAeLnMjdor063jTzhn3'; 
                $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
                $responseData = json_decode($verifyResponse);

                if ($responseData->success) {
                    $accountSid = 'xx'; 
                    $authToken = 'xx'; 
                    $twilioNumber = 'xx'; 
                    $recipientNumber = 'xx'; 

                    $twilio = new Client($accountSid, $authToken);

                    $whatsappMessage = "New form submission from $name\nEmail: $email\nMessage: $message\nTimestamp: $timestamp";
                    try {
                        $twilio->messages->create(
                            $recipientNumber, 
                            [
                                'from' => $twilioNumber,
                                'body' => $whatsappMessage
                            ]
                        );
                        echo "<p style='color: green;'>Notification sent to WhatsApp successfully!</p>";
                    } catch (Exception $e) {
                        echo "<p style='color: red;'>Failed to send WhatsApp message. Error: " . $e->getMessage() . "</p>";
                    }
                } else {
                    echo "<p style='color: red;'>Please complete the CAPTCHA to verify you're human.</p>";
                }
            }
            ?>

            <form id="contactForm" method="POST" action="contact.php">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" rows="5" required></textarea>

                <div class="g-recaptcha" data-sitekey="6LfZz24qAAAAAEVuQzQ646icEFnvBjef7_hgq-q_"></div> 

                <input type="submit" value="Send Message">
            </form>
        </div>
    </div>

    <footer>
        <p>© 2024 Roberts Treize | All rights reserved</p>
    </footer>

</body>
</html>
