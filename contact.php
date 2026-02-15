<?php
include 'includes/config.php';

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $subject = sanitize_input($_POST['subject']);
    $message_text = sanitize_input($_POST['message']);
    
    // Validate inputs
    if (empty($name) || empty($email) || empty($subject) || empty($message_text)) {
        $message = 'All fields are required.';
        $message_type = 'error';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please enter a valid email address.';
        $message_type = 'error';
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $subject, $message_text]);
            
            $message = 'Thank you for your message! We will get back to you soon.';
            $message_type = 'success';
            
            // Clear form
            $_POST = array();
        } catch (PDOException $e) {
            $message = 'Sorry, there was an error sending your message. Please try again.';
            $message_type = 'error';
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<section style="background-color: #f8f9fa; padding: 80px 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 50px;">
            <h2 style="font-size: 2.5rem; color: #343a40; margin-bottom: 15px;">Contact Us</h2>
            <p style="color: #666; max-width: 600px; margin: 0 auto;">Get in touch with us to schedule an appointment or ask any questions.</p>
        </div>
        
        <?php if ($message): ?>
            <div class="alert <?php echo $message_type == 'success' ? 'alert-success' : 'alert-error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 50px;">
            <div>
                <h3 style="margin-bottom: 20px; color: #343a40;">Get In Touch</h3>
                <div style="margin-bottom: 30px;">
                    <div style="display: flex; align-items: center; margin-bottom: 15px;">
                        <span style="margin-right: 10px; color: #4a90e2;">📍</span>
                        <p>123 Pet Street, Animal City, AC 12345</p>
                    </div>
                    <div style="display: flex; align-items: center; margin-bottom: 15px;">
                        <span style="margin-right: 10px; color: #4a90e2;">📞</span>
                        <p>(555) 123-4567</p>
                    </div>
                    <div style="display: flex; align-items: center; margin-bottom: 15px;">
                        <span style="margin-right: 10px; color: #4a90e2;">✉️</span>
                        <p>info@petcare.com</p>
                    </div>
                </div>
            </div>
            <div style="background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                <form method="POST" action="">
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 500;">Your Name</label>
                        <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;" required>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 500;">Your Email</label>
                        <input type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;" required>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 500;">Subject</label>
                        <input type="text" name="subject" value="<?php echo isset($_POST['subject']) ? $_POST['subject'] : ''; ?>" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;" required>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 500;">Message</label>
                        <textarea name="message" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem; min-height: 150px; resize: vertical;" required><?php echo isset($_POST['message']) ? $_POST['message'] : ''; ?></textarea>
                    </div>
                    <button type="submit" class="btn">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>