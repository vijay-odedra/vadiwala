<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Admin email
$adminEmail = "admin@gmail.com";
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vadiwala | Where Time Stands Still</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">

</head>
<body>
    <!-- Header -->
    <header id="header">
        <div class="container">
            <div class="header-content">
                <a href="#" class="logo">
                    <img src="../vadiwala/DIVYRAJ/food.png" alt="Vadiwala Logo" class="logo-image">
                    <!-- <i class="fas fa-door-open logo-icon"></i> -->
                    VadiWala
                </a>
                <nav>
                    <ul>
                        <li><a href="../vadiwala/index.html">Home</a></li>
                        <li><a href="../vadiwala/VANSH/about_us.html">About</a></li>
                        <li><a href="../vadiwala/CHIRAG/services.html">Services</a></li>
                        <li><a href="../vadiwala/VIJAY/gallery.html">Gallery</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="hero-content">
                <h1>Where Time Stands Still</h1>
                <p>At Vadiwala, we don't just offer accommodation; we offer an experience that lingers in your memory long after you've departed.</p>
                <a href="#experience" class="btn">Discover Vadiwala</a>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section class="experience" id="experience">
        <div class="container">
            <div class="section-title">
                <h2>The Vadiwala Experience</h2>
            </div>
            <div class="experience-grid">
                <div class="experience-card">
                    <div class="card-icon">
                        <i class="fas fa-spa"></i>
                    </div>
                    <h3>Sanctuary of Serenity</h3>
                    <p>Our spaces are designed to be havens of peace, where the outside world fades into a distant memory.</p>
                </div>
                <div class="experience-card">
                    <div class="card-icon">
                        <i class="fas fa-concierge-bell"></i>
                    </div>
                    <h3>Intuitive Service</h3>
                    <p>Our staff anticipates your needs before you even voice them, creating a seamless experience.</p>
                </div>
                <div class="experience-card">
                    <div class="card-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3>Nature's Embrace</h3>
                    <p>Surrounded by lush gardens and tranquil water features, Vadiwala connects you with nature.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Atmosphere Section -->
    <section class="atmosphere" id="atmosphere">
        <div class="atmosphere-left" id="leftPanel">
            <div class="atmosphere-content">
                <h2 class="atmosphere-heading">The Freshness of...</h2>
                <div class="atmosphere-word" id="leftWord">Morning Harvest</div>
            </div>
        </div>
        <div class="atmosphere-right" id="rightPanel">
            <div class="atmosphere-content">
                <h2 class="atmosphere-heading">The Flavor of...</h2>
                <div class="atmosphere-word" id="rightWord">Evening Meals</div>
            </div>
        </div>
    </section>

    <!-- Scent Section -->
    <section class="scent" id="scent">
        <div class="container">
            <div class="scent-container">
                <div class="scent-image">
                    <img src="../vadiwala/VIJAY/photos/vadiwalafoode.png" alt="Scented elements">
                </div>
                <div class="scent-content">
                    <h2 class="scent-heading">An Olfactory Signature</h2>
                    <p class="scent-text">
                        Upon arrival, you are greeted not just by a smile, but by a scent. Our signature blend of 
                        <span class="highlight">sandalwood</span>, <span class="highlight">vanilla</span>, and a hint of 
                        <span class="highlight">bergamot</span> is woven into the very fabric of our space. It is the first 
                        memory we give you, and the one we hope you take with you.
                    </p>
                    <a href="#contact" class="btn">Experience Our World</a>
                </div>
            </div>
        </div>
    </section>


    <!--footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <!-- Navigation Links Section -->
                <div class="footer-section">
                    <h3>Navigation</h3>
                    <ul>
                        <li><a href="../vadiwala/index.html">Home</a></li>
                        <li><a href="../vadiwala/VANSH/about_us.html">About</a></li>
                        <li><a href="../CHIRAG/services.html">Services</a></li>
                        <li><a href="../VIJAY/gallery.html">Gallery</a></li>
                    </ul>
                </div>

                <!-- Feedback Section (No Links, Just Form) -->
                <div class="footer-section feedback-section">
                    <h3>Feedback</h3>
                    <form class="feedback-form" id="feedbackForm">
                        <textarea class="feedback-textarea" placeholder="Share your feedback..." required></textarea>
                        <button type="submit" class="feedback-submit">Submit Feedback</button>
                    </form>
                </div>

                
                <!-- Add-ons Section -->
            
            <div class="footer-bottom">
                <div class="logo-section">
                    <div class="logo">
                            VADI<span class="red-o">W</span><span class="red-o">A</span>LA
                    </div>
                </div>
        <div class="social-links">
            <a href="https://www.facebook.com/share/16TptkqWen/" class="social-icon magic"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/vadiwala.foods?igsh=Y2lhYTlqcmprYjhs" class="social-icon magic"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-icon magic"><i class="fa-brands fa-x-twitter"></i></a>
        </div>
                
        <div class="contact-info">
            <div class="contact-item">
                <span>📞</span>
                <span>+919104369797</span>
        </div>
        </div>
        </div>
        </div>
        </div>
        </footer>



    <script>
        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Atmosphere section word changes
        const leftPanel = document.getElementById('leftPanel');
        const rightPanel = document.getElementById('rightPanel');
        const leftWord = document.getElementById('leftWord');
        const rightWord = document.getElementById('rightWord');
        
        const leftWords = [
    "Kaju-lasan",
    "Rajwadi Dhokdi",
    "Kaju Patra nu Shaak",
    "Suran Chana nu Shaak",
    "Navratna Mix Veg",
    "Dal Makhani",
    "Varadiyu"
];

const rightWords = [
    "Panchratna Dal",
    "Aakhi Dunghri nu Shaak",
    "Kaju Gathiya Sabji",
    "Nagauri Dal",
    "Madhpudo",
    "Tomato Kofta"
];

        let leftIndex = 0;
        let rightIndex = 0;
        
        leftPanel.addEventListener('mouseenter', () => {
            leftIndex = (leftIndex + 1) % leftWords.length;
            fadeWord(leftWord, leftWords[leftIndex]);
        });
        
        rightPanel.addEventListener('mouseenter', () => {
            rightIndex = (rightIndex + 1) % rightWords.length;
            fadeWord(rightWord, rightWords[rightIndex]);
        });
        
        function fadeWord(element, newWord) {
            element.style.opacity = 0;
            setTimeout(() => {
                element.textContent = newWord;
                element.style.opacity = 1;
            }, 300);
        }
        
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Add scroll animations
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.2
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observe elements for animation
        document.querySelectorAll('.experience-card, .scent-container, .section-title').forEach(element => {
            element.style.opacity = 0;
            element.style.transform = 'translateY(30px)';
            element.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
            observer.observe(element);
        });
    </script>
</body>
</html>