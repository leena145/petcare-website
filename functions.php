<?php
// includes/functions.php

/**
 * Redirect to a specific URL
 */
function redirect($url) {
    header("Location: " . $url);
    exit;
}

/**
 * Check if user is logged in
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

/**
 * Check if user is admin
 */
function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
}

/**
 * Format date for display
 */
function format_date($date, $format = 'F j, Y') {
    return date($format, strtotime($date));
}

/**
 * Format time for display
 */
function format_time($time, $format = 'g:i A') {
    return date($format, strtotime($time));
}

/**
 * Get service name by ID
 */
function get_service_name($service_id, $pdo) {
    $stmt = $pdo->prepare("SELECT name FROM services WHERE id = ?");
    $stmt->execute([$service_id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);
    return $service ? $service['name'] : 'Unknown Service';
}

/**
 * Get booking status badge with color
 */
function get_status_badge($status) {
    $colors = [
        'pending' => '#fff3cd',
        'confirmed' => '#d1ecf1', 
        'completed' => '#d4edda',
        'cancelled' => '#f8d7da'
    ];
    
    $color = isset($colors[$status]) ? $colors[$status] : '#e2e3e5';
    
    return '<span style="padding: 4px 8px; border-radius: 4px; background: ' . $color . ';">' . 
           ucfirst($status) . '</span>';
}

/**
 * Validate email format
 */
function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate phone number (basic validation)
 */
function is_valid_phone($phone) {
    return preg_match('/^[0-9\-\+\(\)\s]{10,}$/', $phone);
}

/**
 * Get upcoming bookings
 */
function get_upcoming_bookings($pdo, $limit = 5) {
    $stmt = $pdo->prepare("
        SELECT b.*, s.name as service_name 
        FROM bookings b 
        LEFT JOIN services s ON b.service_id = s.id 
        WHERE b.booking_date >= CURDATE() 
        ORDER BY b.booking_date ASC, b.booking_time ASC 
        LIMIT ?
    ");
    $stmt->execute([$limit]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get booking statistics
 */
function get_booking_stats($pdo) {
    $stats = [
        'total' => 0,
        'pending' => 0,
        'confirmed' => 0,
        'completed' => 0,
        'cancelled' => 0
    ];
    
    $stmt = $pdo->query("SELECT status, COUNT(*) as count FROM bookings GROUP BY status");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($results as $result) {
        $stats[$result['status']] = $result['count'];
        $stats['total'] += $result['count'];
    }
    
    return $stats;
}

/**
 * Send email notification (placeholder function)
 */
function send_booking_confirmation($booking_id, $pdo) {
    // In a real application, this would send an actual email
    // For demo purposes, we'll just log it
    
    error_log("Booking confirmation email would be sent for booking ID: " . $booking_id);
    return true;
}

/**
 * Check if booking date/time is available
 */
function is_booking_available($service_id, $booking_date, $booking_time, $pdo, $exclude_booking_id = null) {
    $sql = "SELECT COUNT(*) FROM bookings WHERE service_id = ? AND booking_date = ? AND booking_time = ? AND status IN ('pending', 'confirmed')";
    $params = [$service_id, $booking_date, $booking_time];
    
    if ($exclude_booking_id) {
        $sql .= " AND id != ?";
        $params[] = $exclude_booking_id;
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $count = $stmt->fetchColumn();
    
    return $count == 0;
}

/**
 * Generate random password
 */
function generate_random_password($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $password;
}

/**
 * Get available time slots
 */
function get_available_time_slots() {
    return [
        '09:00' => '9:00 AM',
        '10:00' => '10:00 AM', 
        '11:00' => '11:00 AM',
        '12:00' => '12:00 PM',
        '13:00' => '1:00 PM',
        '14:00' => '2:00 PM',
        '15:00' => '3:00 PM',
        '16:00' => '4:00 PM'
    ];
}

/**
 * Calculate service duration in minutes
 */
function get_service_duration_minutes($duration_string) {
    if (strpos($duration_string, 'hour') !== false) {
        return intval($duration_string) * 60;
    }
    if (strpos($duration_string, 'minute') !== false) {
        return intval($duration_string);
    }
    return 60; // default 1 hour
}

/**
 * Format currency
 */
function format_currency($amount) {
    return '$' . number_format($amount, 2);
}

/**
 * Log activity
 */
function log_activity($action, $user_id = null, $details = '') {
    $log_file = __DIR__ . '/../logs/activity.log';
    $timestamp = date('Y-m-d H:i:s');
    $user_id = $user_id ?: (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'guest');
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    
    $log_entry = "[$timestamp] [IP: $ip_address] [User: $user_id] $action";
    if ($details) {
        $log_entry .= " - $details";
    }
    $log_entry .= PHP_EOL;
    
    // Ensure logs directory exists
    $logs_dir = dirname($log_file);
    if (!is_dir($logs_dir)) {
        mkdir($logs_dir, 0755, true);
    }
    
    file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
}

/**
 * Get pagination parameters
 */
function get_pagination_params($page, $per_page = 10) {
    $page = max(1, intval($page));
    $offset = ($page - 1) * $per_page;
    
    return [
        'page' => $page,
        'per_page' => $per_page,
        'offset' => $offset
    ];
}

/**
 * Generate pagination links
 */
function generate_pagination($total_items, $current_page, $per_page, $url_pattern) {
    $total_pages = ceil($total_items / $per_page);
    
    if ($total_pages <= 1) {
        return '';
    }
    
    $pagination = '<div class="pagination">';
    
    // Previous link
    if ($current_page > 1) {
        $pagination .= '<a href="' . sprintf($url_pattern, $current_page - 1) . '">&laquo; Previous</a>';
    }
    
    // Page numbers
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            $pagination .= '<span class="current">' . $i . '</span>';
        } else {
            $pagination .= '<a href="' . sprintf($url_pattern, $i) . '">' . $i . '</a>';
        }
    }
    
    // Next link
    if ($current_page < $total_pages) {
        $pagination .= '<a href="' . sprintf($url_pattern, $current_page + 1) . '">Next &raquo;</a>';
    }
    
    $pagination .= '</div>';
    
    return $pagination;
}
?>