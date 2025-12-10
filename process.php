<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $address = htmlspecialchars(trim($_POST['address']));
    $gender = htmlspecialchars(trim($_POST['gender'] ?? 'Not specified'));
    $course = htmlspecialchars(trim($_POST['course'] ?? 'Not specified'));
    
    // Generate registration ID
    $reg_id = "REG" . strtoupper(substr(md5(uniqid()), 0, 8));
    $date = date('F j, Y, g:i a');
    
    // Create formatted HTML response
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration Successful</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
                margin: 0;
            }
            
            .success-container {
                background: white;
                border-radius: 15px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
                width: 100%;
                max-width: 700px;
                padding: 40px;
                text-align: center;
            }
            
            .success-icon {
                font-size: 80px;
                color: #4CAF50;
                margin-bottom: 20px;
            }
            
            h1 {
                color: #333;
                margin-bottom: 20px;
                font-size: 2.5rem;
            }
            
            .reg-id {
                background: linear-gradient(to right, #667eea, #764ba2);
                color: white;
                padding: 12px 25px;
                border-radius: 50px;
                display: inline-block;
                margin-bottom: 30px;
                font-weight: bold;
                font-size: 1.1rem;
                letter-spacing: 1px;
            }
            
            .details-container {
                background: #f8f9fa;
                border-radius: 10px;
                padding: 30px;
                margin: 30px 0;
                text-align: left;
                border-left: 5px solid #667eea;
            }
            
            .detail-row {
                margin-bottom: 15px;
                padding-bottom: 15px;
                border-bottom: 1px solid #eee;
                display: flex;
            }
            
            .detail-label {
                font-weight: bold;
                color: #444;
                min-width: 150px;
            }
            
            .detail-value {
                color: #666;
            }
            
            .buttons {
                display: flex;
                gap: 15px;
                justify-content: center;
                margin-top: 30px;
            }
            
            .btn {
                padding: 14px 30px;
                border: none;
                border-radius: 8px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s;
                text-decoration: none;
                display: inline-block;
            }
            
            .print-btn {
                background: linear-gradient(to right, #667eea, #764ba2);
                color: white;
            }
            
            .print-btn:hover {
                background: linear-gradient(to right, #5a6fd8, #6a4190);
                transform: translateY(-2px);
            }
            
            .back-btn {
                background: #f0f0f0;
                color: #333;
                border: 2px solid #ddd;
            }
            
            .back-btn:hover {
                background: #e0e0e0;
                transform: translateY(-2px);
            }
            
            .timestamp {
                color: #777;
                font-size: 0.9rem;
                margin-top: 30px;
                padding-top: 20px;
                border-top: 1px solid #eee;
            }
        </style>
    </head>
    <body>
        <div class="success-container">
            <div class="success-icon">✅</div>
            
            <h1>Registration Successful!</h1>
            
            <div class="reg-id">Registration ID: <?php echo $reg_id; ?></div>
            
            <p>Thank you <strong><?php echo $name; ?></strong> for registering with us.</p>
            
            <div class="details-container">
                <h2 style="color: #444; margin-bottom: 20px;">📋 Registration Details:</h2>
                
                <div class="detail-row">
                    <div class="detail-label">Full Name:</div>
                    <div class="detail-value"><?php echo $name; ?></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Email Address:</div>
                    <div class="detail-value"><?php echo $email; ?></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Phone Number:</div>
                    <div class="detail-value"><?php echo $phone; ?></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Address:</div>
                    <div class="detail-value"><?php echo nl2br($address); ?></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Gender:</div>
                    <div class="detail-value"><?php echo $gender; ?></div>
                </div>
                
                <?php if ($course !== 'Not specified'): ?>
                <div class="detail-row">
                    <div class="detail-label">Course Interest:</div>
                    <div class="detail-value"><?php echo $course; ?></div>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="buttons">
                <button class="btn print-btn" onclick="window.print()">🖨️ Print Confirmation</button>
                <a href="index.html" class="btn back-btn">← Back to Registration</a>
            </div>
            
            <div class="timestamp">
                Submitted on: <?php echo $date; ?>
            </div>
        </div>
        
        <script>
            // Auto scroll to top
            window.scrollTo(0, 0);
            
            // Print enhancement
            document.querySelector('.print-btn').addEventListener('click', function() {
                setTimeout(function() {
                    alert('Print dialog opened. Select your printer options.');
                }, 100);
            });
        </script>
    </body>
    </html>
    <?php
    
    // Optional: Save to text file
    $fileContent = "=================================\n";
    $fileContent .= "NEW REGISTRATION - $reg_id\n";
    $fileContent .= "Date: $date\n";
    $fileContent .= "=================================\n";
    $fileContent .= "Name: $name\n";
    $fileContent .= "Email: $email\n";
    $fileContent .= "Phone: $phone\n";
    $fileContent .= "Address: $address\n";
    $fileContent .= "Gender: $gender\n";
    $fileContent .= "Course: $course\n";
    $fileContent .= "=================================\n\n";
    
    file_put_contents('registrations.txt', $fileContent, FILE_APPEND);
    
} else {
    // Redirect if accessed directly
    header("Location: index.html");
    exit();
}
?>
