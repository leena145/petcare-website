    </main>
    <footer style="background-color: #343a40; color: white; padding: 60px 0 30px;">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 40px; margin-bottom: 40px;">
                <div>
                    <h3 style="margin-bottom: 20px; font-size: 1.2rem;">PetCare</h3>
                    <p>Providing exceptional care for your beloved pets since 2010.</p>
                </div>
                <div>
                    <h3 style="margin-bottom: 20px; font-size: 1.2rem;">Quick Links</h3>
                    <ul style="list-style: none;">
                        <li style="margin-bottom: 10px;"><a href="index.php" style="color: white; text-decoration: none;">Home</a></li>
                        <li style="margin-bottom: 10px;"><a href="services.php" style="color: white; text-decoration: none;">Services</a></li>
                        <li style="margin-bottom: 10px;"><a href="about.php" style="color: white; text-decoration: none;">About</a></li>
                        <li style="margin-bottom: 10px;"><a href="contact.php" style="color: white; text-decoration: none;">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 style="margin-bottom: 20px; font-size: 1.2rem;">Services</h3>
                    <ul style="list-style: none;">
                        <li style="margin-bottom: 10px;"><a href="#" style="color: white; text-decoration: none;">Pet Grooming</a></li>
                        <li style="margin-bottom: 10px;"><a href="#" style="color: white; text-decoration: none;">Veterinary Care</a></li>
                        <li style="margin-bottom: 10px;"><a href="#" style="color: white; text-decoration: none;">Pet Boarding</a></li>
                        <li style="margin-bottom: 10px;"><a href="#" style="color: white; text-decoration: none;">Pet Training</a></li>
                    </ul>
                </div>
                <div>
                    <h3 style="margin-bottom: 20px; font-size: 1.2rem;">Contact Info</h3>
                    <p>123 Pet Street, Animal City</p>
                    <p>Phone: (555) 123-4567</p>
                    <p>Email: info@petcare.com</p>
                </div>
            </div>
            <div style="text-align: center; padding-top: 30px; border-top: 1px solid rgba(255, 255, 255, 0.1); color: #aaa;">
                <p>&copy; 2023 PetCare. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        document.querySelector('.mobile-menu').addEventListener('click', function() {
            document.querySelector('nav').classList.toggle('active');
        });

        // Smooth Scrolling for Anchor Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu if open
                    document.querySelector('nav').classList.remove('active');
                }
            });
        });
    </script>
  <!-- Voice Chatbot -->
<div id="chatbot-container" class="chatbot-container">
    <div class="chat-header" id="chat-toggle">
        <h3>🐾 PetCare Assistant</h3>
        <button class="chat-toggle">−</button>
    </div>
    
    <div class="chat-messages" id="chat-messages">
        <!-- Messages will appear here -->
    </div>
    
    <div class="chat-input-container">
        <div class="input-group">
            <input type="text" id="user-input" class="chat-input" placeholder="Type your message or use voice...">
            <button id="voice-btn" class="voice-btn" title="Voice Input">🎤</button>
            <button id="send-btn" class="send-btn" title="Send Message">➤</button>
        </div>
    </div>
</div>

<!-- Include chatbot JavaScript -->
<script src="chatbot/chatbot.js"></script>
</body>
</html>