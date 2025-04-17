<?php
// Database connection
$servername = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$dbname = "hirayafit_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $fullName = $firstName . " " . $lastName;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    
    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Handle profile image upload
    $profileImage = null;
    if(isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["profileImage"]["name"];
        $filetype = $_FILES["profileImage"]["type"];
        $filesize = $_FILES["profileImage"]["size"];
        
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) {
            die("Error: Please select a valid file format.");
        }
        
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) {
            die("Error: File size is larger than the allowed limit.");
        }
        
        // Create directory if it doesn't exist
        if (!file_exists("uploads/")) {
            mkdir("uploads/", 0777, true);
        }
        
        // Create unique file name
        $newFilename = uniqid() . "." . $ext;
        $uploadDirectory = "uploads/";
        $uploadPath = $uploadDirectory . $newFilename;
        
        // Save the file
        if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $uploadPath)) {
            $profileImage = $uploadPath;
        } else {
            die("Error: There was a problem uploading your file. Please try again.");
        }
    }
    
    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, username, password, address, phone, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $fullName, $email, $username, $hashedPassword, $address, $phone, $profileImage);
    
    // Execute query
    if ($stmt->execute()) {
        // Registration successful - send email notification
        sendEmailNotification($email, $fullName);
        
        // Redirect to sign-in page
        header("Location: sign-in.html?registration=success");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close statement
    $stmt->close();
}

$conn->close();

// Function to send email notification
function sendEmailNotification($recipientEmail, $fullName) {
    // Include PHPMailer
    require 'vendor/autoload.php'; // Make sure PHPMailer is installed via Composer
    
    // Create a new PHPMailer instance
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@gmail.com'; // Your Gmail address
        $mail->Password = 'your_app_password'; // Your Gmail app password
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        // Recipients
        $mail->setFrom('your_email@gmail.com', 'HirayaFit');
        $mail->addAddress($recipientEmail, $fullName); // Add recipient
        $mail->addReplyTo('info@hirayafit.com', 'Information');
        
        // Admin notification
        $mail->addBCC('admin@hirayafit.com', 'Admin'); // Send copy to admin
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Welcome to HirayaFit!';
        $mail->Body = '
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                    .header { background-color: #0071c5; color: white; padding: 20px; text-align: center; }
                    .content { padding: 20px; background-color: #f9f9f9; }
                    .footer { font-size: 12px; text-align: center; margin-top: 30px; color: #777; }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h1>Welcome to HirayaFit!</h1>
                    </div>
                    <div class="content">
                        <p>Hello ' . $fullName . ',</p>
                        <p>Thank you for registering at HirayaFit! Your account has been successfully created.</p>
                        <p>Here\'s a summary of your account details:</p>
                        <ul>
                            <li><strong>Username:</strong> ' . $username . '</li>
                            <li><strong>Email:</strong> ' . $recipientEmail . '</li>
                        </ul>
                        <p>You can now log in to your account and start shopping for your fitness needs.</p>
                        <p>If you have any questions or need assistance, please don\'t hesitate to contact our customer support team.</p>
                        <p>Best regards,<br>HirayaFit Team</p>
                    </div>
                    <div class="footer">
                        <p>This email was sent to you because you registered on HirayaFit.com</p>
                        <p>&copy; ' . date('Y') . ' HirayaFit. All rights reserved.</p>
                    </div>
                </div>
            </body>
            </html>
        ';
        $mail->AltBody = 'Hello ' . $fullName . ', Thank you for registering at HirayaFit! Your account has been successfully created.';
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
?>