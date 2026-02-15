<?php include 'includes/config.php'; ?>
<?php include 'includes/header.php'; ?>

<section style="padding: 80px 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 50px;">
            <h2 style="font-size: 2.5rem; color: #343a40; margin-bottom: 15px;">Our Services</h2>
            <p style="color: #666; max-width: 600px; margin: 0 auto;">Comprehensive pet care services tailored to your pet's needs.</p>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            <?php
            $services_data = [
                [
                    'id' => 1,
                    'name' => 'Pet Grooming',
                    'description' => 'Professional grooming services including bath, haircut, nail trimming, and ear cleaning. We use pet-safe products and techniques to keep your furry friend looking their best.',
                    'price' => 45.00,
                    'duration' => '2 hours',
                    'image' => 'https://images.unsplash.com/photo-1596492784531-6e6eb5ea9993?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
                ],
                [
                    'id' => 2,
                    'name' => 'Veterinary Care',
                    'description' => 'Comprehensive health examination and vaccination services by certified veterinarians. Regular checkups and preventive care to keep your pet healthy.',
                    'price' => 65.00,
                    'duration' => '1 hour',
                    'image' => 'https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
                ],
                [
                    'id' => 3,
                    'name' => 'Pet Boarding',
                    'description' => 'Safe and comfortable boarding facilities with daily exercise and personalized care. Your pet will feel at home while you\'re away.',
                    'price' => 35.00,
                    'duration' => 'Per night',
                    'image' => 'https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
                ],
                [
                    'id' => 4,
                    'name' => 'Pet Training',
                    'description' => 'Basic obedience training and behavior modification sessions. We help you build a strong bond with your pet through positive reinforcement.',
                    'price' => 50.00,
                    'duration' => '1 hour session',
                    'image' => 'https://images.unsplash.com/photo-1568640347023-a616a30bc3bd?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
                ],
                [
                    'id' => 5,
                    'name' => 'Pet Walking',
                    'description' => 'Daily walking services to keep your pet active and healthy. Regular exercise tailored to your pet\'s age, breed, and energy level.',
                    'price' => 20.00,
                    'duration' => '30 minutes',
                    'image' => 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
                ],
                [
                    'id' => 6,
                    'name' => 'Pet Sitting',
                    'description' => 'In-home pet sitting services for when you\'re away. Your pets stay in their familiar environment with personalized care and attention.',
                    'price' => 25.00,
                    'duration' => 'Per visit',
                    'image' => 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
                ]
            ];
            
            foreach ($services_data as $service) {
                echo "
                <div style='background-color: white; border-radius: 8px; overflow: hidden; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); transition: transform 0.3s;'>
                    <div style='height: 200px; background-image: url(\"{$service['image']}\"); background-size: cover; background-position: center;'></div>
                    <div style='padding: 25px;'>
                        <h3 style='margin-bottom: 10px; color: #343a40;'>{$service['name']}</h3>
                        <p style='margin-bottom: 15px; color: #666;'>{$service['description']}</p>
                        <p style='font-weight: bold; color: #4a90e2; margin-bottom: 15px;'>\${$service['price']} - {$service['duration']}</p>
                        <a href='booking.php?service_id={$service['id']}' class='btn'>Book Now</a>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section style="background-color: #4a90e2; padding: 60px 0; text-align: center; color: white;">
    <div class="container">
        <h2 style="font-size: 2.2rem; margin-bottom: 20px;">Ready to Book a Service?</h2>
        <p style="font-size: 1.1rem; margin-bottom: 30px; max-width: 600px; margin-left: auto; margin-right: auto;">Contact us today to schedule an appointment or learn more about our services.</p>
        <div style="display: flex; justify-content: center; gap: 15px;">
            <a href="booking.php" class="btn" style="background-color: white; color: #4a90e2;">Book Now</a>
            <a href="contact.php" class="btn btn-secondary">Contact Us</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>