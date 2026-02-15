<?php
include 'includes/config.php';

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_id = sanitize_input($_POST['service_id']);
    $pet_name = sanitize_input($_POST['pet_name']);
    $pet_type = sanitize_input($_POST['pet_type']);
    $booking_date = sanitize_input($_POST['booking_date']);
    $booking_time = sanitize_input($_POST['booking_time']);
    $special_requests = sanitize_input($_POST['special_requests']);
    $customer_name = sanitize_input($_POST['customer_name']);
    $customer_email = sanitize_input($_POST['customer_email']);
    $customer_phone = sanitize_input($_POST['customer_phone']);
    
    // Validate inputs
    if (empty($service_id) || empty($pet_name) || empty($pet_type) || empty($booking_date) || empty($booking_time) || empty($customer_name) || empty($customer_email) || empty($customer_phone)) {
        $message = 'All fields are required.';
        $message_type = 'error';
    } elseif (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please enter a valid email address.';
        $message_type = 'error';
    } else {
        try {
            // For demo purposes, we'll insert without user_id
            $stmt = $pdo->prepare("INSERT INTO bookings (service_id, pet_name, pet_type, booking_date, booking_time, special_requests, customer_name, customer_email, customer_phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$service_id, $pet_name, $pet_type, $booking_date, $booking_time, $special_requests, $customer_name, $customer_email, $customer_phone]);
            
            $message = 'Booking request submitted successfully! We will contact you to confirm your appointment.';
            $message_type = 'success';
            
            // Clear form
            $_POST = array();
        } catch (PDOException $e) {
            $message = 'Sorry, there was an error processing your booking. Please try again.';
            $message_type = 'error';
        }
    }
}

// Get services for dropdown
$services = $pdo->query("SELECT * FROM services")->fetchAll(PDO::FETCH_ASSOC);

// Get service details if service_id is provided in URL
$selected_service = null;
if (isset($_GET['service_id'])) {
    $service_id = intval($_GET['service_id']);
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([$service_id]);
    $selected_service = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<?php include 'includes/header.php'; ?>

<section style="padding: 80px 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 50px;">
            <h2 style="font-size: 2.5rem; color: #343a40; margin-bottom: 15px;">Book a Service</h2>
            <p style="color: #666; max-width: 600px; margin: 0 auto;">Schedule an appointment for your pet with our professional care team.</p>
        </div>
        
        <?php if ($message): ?>
            <div class="alert <?php echo $message_type == 'success' ? 'alert-success' : 'alert-error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <div style="max-width: 800px; margin: 0 auto;">
            <div style="background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                <form method="POST" action="">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Service</label>
                            <select name="service_id" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;" required>
                                <option value="">Select a service</option>
                                <?php foreach ($services as $service): ?>
                                    <option value="<?php echo $service['id']; ?>" <?php echo (isset($selected_service) && $selected_service['id'] == $service['id']) ? 'selected' : ''; ?>>
                                        <?php echo $service['name']; ?> - $<?php echo $service['price']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Pet Type</label>
                            <select name="pet_type" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;" required>
                                <option value="">Select pet type</option>
                                <option value="Dog" <?php echo (isset($_POST['pet_type']) && $_POST['pet_type'] == 'Dog') ? 'selected' : ''; ?>>Dog</option>
                                <option value="Cat" <?php echo (isset($_POST['pet_type']) && $_POST['pet_type'] == 'Cat') ? 'selected' : ''; ?>>Cat</option>
                                <option value="Bird" <?php echo (isset($_POST['pet_type']) && $_POST['pet_type'] == 'Bird') ? 'selected' : ''; ?>>Bird</option>
                                <option value="Other" <?php echo (isset($_POST['pet_type']) && $_POST['pet_type'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Pet Name</label>
                            <input type="text" name="pet_name" value="<?php echo isset($_POST['pet_name']) ? $_POST['pet_name'] : ''; ?>" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;" required>
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Booking Date</label>
                            <input type="date" name="booking_date" value="<?php echo isset($_POST['booking_date']) ? $_POST['booking_date'] : ''; ?>" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;" required>
                        </div>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Booking Time</label>
                            <select name="booking_time" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;" required>
                                <option value="">Select time</option>
                                <option value="09:00" <?php echo (isset($_POST['booking_time']) && $_POST['booking_time'] == '09:00') ? 'selected' : ''; ?>>9:00 AM</option>
                                <option value="10:00" <?php echo (isset($_POST['booking_time']) && $_POST['booking_time'] == '10:00') ? 'selected' : ''; ?>>10:00 AM</option>
                                <option value="11:00" <?php echo (isset($_POST['booking_time']) && $_POST['booking_time'] == '11:00') ? 'selected' : ''; ?>>11:00 AM</option>
                                <option value="12:00" <?php echo (isset($_POST['booking_time']) && $_POST['booking_time'] == '12:00') ? 'selected' : ''; ?>>12:00 PM</option>
                                <option value="13:00" <?php echo (isset($_POST['booking_time']) && $_POST['booking_time'] == '13:00') ? 'selected' : ''; ?>>1:00 PM</option>
                                <option value="14:00" <?php echo (isset($_POST['booking_time']) && $_POST['booking_time'] == '14:00') ? 'selected' : ''; ?>>2:00 PM</option>
                                <option value="15:00" <?php echo (isset($_POST['booking_time']) && $_POST['booking_time'] == '15:00') ? 'selected' : ''; ?>>3:00 PM</option>
                                <option value="16:00" <?php echo (isset($_POST['booking_time']) && $_POST['booking_time'] == '16:00') ? 'selected' : ''; ?>>4:00 PM</option>
                            </select>
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Your Name</label>
                            <input type="text" name="customer_name" value="<?php echo isset($_POST['customer_name']) ? $_POST['customer_name'] : ''; ?>" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;" required>
                        </div>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Your Email</label>
                            <input type="email" name="customer_email" value="<?php echo isset($_POST['customer_email']) ? $_POST['customer_email'] : ''; ?>" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;" required>
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Your Phone</label>
                            <input type="tel" name="customer_phone" value="<?php echo isset($_POST['customer_phone']) ? $_POST['customer_phone'] : ''; ?>" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;" required>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 500;">Special Requests</label>
                        <textarea name="special_requests" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem; min-height: 100px; resize: vertical;"><?php echo isset($_POST['special_requests']) ? $_POST['special_requests'] : ''; ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn">Submit Booking</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>