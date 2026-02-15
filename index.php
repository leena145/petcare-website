<?php include 'includes/config.php'; ?>
<?php include 'includes/header.php'; ?>

<section style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1450778869180-41d0601e046e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center; color: white; text-align: center; padding: 180px 0 100px;">
    <div class="container">
        <h1 style="font-size: 3.5rem; margin-bottom: 20px;">Professional Pet Care Services</h1>
        <p style="font-size: 1.2rem; max-width: 700px; margin: 0 auto 30px;">We provide the highest quality care for your furry friends. From grooming to veterinary services, we've got you covered.</p>
        <div style="display: flex; justify-content: center; gap: 15px;">
            <a href="services.php" class="btn">Our Services</a>
            <a href="contact.php" class="btn btn-secondary">Contact Us</a>
        </div>
    </div>
</section>

<section style="padding: 80px 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 50px;">
            <h2 style="font-size: 2.5rem; color: #343a40; margin-bottom: 15px;">Our Services</h2>
            <p style="color: #666; max-width: 600px; margin: 0 auto;">We offer a wide range of services to keep your pets healthy, happy, and looking their best.</p>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            <?php
            $services_data = [
                [
                    'id' => 1,
                    'name' => 'Pet Grooming',
                    'description' => 'Professional grooming services including bath, haircut, nail trimming, and ear cleaning',
                    'price' => 45.00,
                    'duration' => '2 hours',
                    'image' => 'https://images.unsplash.com/photo-1596492784531-6e6eb5ea9993?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
                ],
                [
                    'id' => 2,
                    'name' => 'Veterinary Care',
                    'description' => 'Comprehensive health examination and vaccination services by certified veterinarians',
                    'price' => 65.00,
                    'duration' => '1 hour',
                    'image' => 'https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
                ],
                [
                    'id' => 3,
                    'name' => 'Pet Boarding',
                    'description' => 'Safe and comfortable boarding facilities with daily exercise and personalized care',
                    'price' => 35.00,
                    'duration' => 'Per night',
                    'image' => 'https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
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
        <div style="text-align: center; margin-top: 40px;">
            <a href="services.php" class="btn btn-secondary">View All Services</a>
        </div>
    </div>
</section>

<section style="background-color: #f8f9fa; padding: 80px 0;">
    <div class="container">
        <div style="display: flex; align-items: center; gap: 50px;">
            <div style="flex: 1; height: 400px; border-radius: 8px; background-image: url('https://images.unsplash.com/photo-1583337130417-3346a1be7dee?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80'); background-size: cover; background-position: center;"></div>
            <div style="flex: 1;">
                <h2 style="font-size: 2.2rem; margin-bottom: 20px; color: #343a40;">About PetCare</h2>
                <p style="margin-bottom: 20px; color: #666;">At PetCare, we understand that your pets are family. That's why we're committed to providing the highest quality care with compassion and expertise.</p>
                <p style="margin-bottom: 20px; color: #666;">Our team of certified professionals has years of experience in pet care, grooming, and veterinary services. We treat every pet as if they were our own.</p>
                <a href="about.php" class="btn">Learn More</a>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section style="padding: 80px 0; background-color: white;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 50px;">
            <h2 style="font-size: 2.5rem; color: #343a40; margin-bottom: 15px;">What Pet Owners Say</h2>
            <p style="color: #666; max-width: 600px; margin: 0 auto;">Don't just take our word for it - hear from our satisfied customers</p>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            <div style="background: #f8f9fa; padding: 30px; border-radius: 8px; text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 20px;">🐕</div>
                <p style="font-style: italic; margin-bottom: 20px; color: #555;">"The team at PetCare has been amazing with my golden retriever, Max. Their grooming services are top-notch and he always comes back happy and clean!"</p>
                <p style="font-weight: 600; color: #343a40;">- Sarah Johnson</p>
            </div>
            <div style="background: #f8f9fa; padding: 30px; border-radius: 8px; text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 20px;">🐱</div>
                <p style="font-style: italic; margin-bottom: 20px; color: #555;">"I trust PetCare completely with my cat's health. Their veterinary services are professional and affordable. Highly recommended!"</p>
                <p style="font-weight: 600; color: #343a40;">- Michael Chen</p>
            </div>
            <div style="background: #f8f9fa; padding: 30px; border-radius: 8px; text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 20px;">🏠</div>
                <p style="font-style: italic; margin-bottom: 20px; color: #555;">"When we go on vacation, we always board our two dogs at PetCare. The staff is wonderful and our pets love going there. Peace of mind for us!"</p>
                <p style="font-weight: 600; color: #343a40;">- Emily Rodriguez</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>