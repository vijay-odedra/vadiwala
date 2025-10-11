<?php
session_start();

// If user not logged in → redirect to login.php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Navigation Component</title>

</head>
<body>
    <!-- Navigation Component -->
    <nav class="navbar" id="mainNavigation">
        <div class="nav-container">
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <a href="#" class="nav-logo">
                <img src="https://via.placeholder.com/40x40/dc2626/ffffff?text=L" alt="Logo">
                <span class="logo-text">YourLogo</span>
            </a>
            
            <ul class="nav-menu" id="navMenu">
                <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Services</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Portfolio</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link">logout</a></li>
            </ul>

            <!-- Desktop Search Bar -->
            <div class="search-container">
                <form class="search-form" id="searchForm">
                    <input type="text" class="search-input" placeholder="Search..." id="searchInput">
                    <button type="submit" class="search-btn">🔍</button>
                </form>
            </div>

            <!-- Mobile Search Toggle Button -->
            <button class="search-toggle" id="searchToggle">🔍</button>
        </div>
    </nav>

    <!-- Mobile Search Bar -->
    <div class="mobile-search" id="mobileSearch">
        <form class="search-form" id="mobileSearchForm">
            <input type="text" class="search-input" placeholder="Search..." id="mobileSearchInput">
            <button type="submit" class="search-btn">🔍</button>
        </form>
    </div>

    <!-- Search Results Display -->
    <div class="search-results" id="searchResults">
        <h3>Search Results</h3>
        <p id="searchResultsText"></p>
    </div>




    <!-- Slideshow Header Component -->
    <header id="main-slideshow-header" class="slideshow-header">
        <div class="slideshow-container">
            <div class="slide active" style="background: url(2.jpg);">
                <div class="content-panel">
                    <h1 class="main-title">Welcome</h1>
                    <p class="description">Discover amazing experiences with our innovative platform designed for the modern world.</p>
                    <a href="#" class="action-btn">Get Started</a>
                </div>
            </div>

            <div class="slide" style="background: url(3.jpg);">
                <div class="content-panel">
                    <h1 class="main-title">Create</h1>
                    <p class="description">Unleash your creativity with powerful tools that bring your ideas to life effortlessly.</p>
                    <a href="#" class="action-btn">Start Creating</a>
                </div>
            </div>

            <div class="slide" style="background: url(4.jpg);">
                <div class="content-panel">
                    <h1 class="main-title">Connect</h1>
                    <p class="description">Join millions of users worldwide and build meaningful connections that matter.</p>
                    <a href="#" class="action-btn">Join Now</a>
                </div>
            </div>

            <div class="slide" style="background: url(5.jpg);">
                <div class="content-panel">
                    <h1 class="main-title">Grow</h1>
                    <p class="description">Scale your success with our comprehensive suite of growth-focused solutions.</p>
                    <a href="#" class="action-btn">Learn More</a>
                </div>
            </div>
        </div>

        <div class="progress-indicator">
            <div class="progress-fill"></div>
        </div>

        <div class="dots-indicator">
            <div class="nav-dot active"></div>
            <div class="nav-dot"></div>
            <div class="nav-dot"></div>
            <div class="nav-dot"></div>
        </div>
    </header>



    <!-- Footer -->


    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <!-- POS Section -->
                <div class="footer-section">
                    <h3>POS</h3>
                    <ul>
                        <li><a href="#">Billing</a></li>
                        <li><a href="#">Inventory</a></li>
                        <li><a href="#">Reporting</a></li>
                        <li><a href="#">Online Ordering</a></li>
                        <li><a href="#">CRM</a></li>
                        <li><a href="#">Menu</a></li>
                    </ul>
                    <a href="#" style="background: #333; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; display: inline-block; margin-top: 15px;">Take a free demo</a>
                </div>

                <!-- Add-ons Section -->
                <div class="footer-section">
                    <h3>Add-ons</h3>
                    <ul>
                        <li><a href="#">Marketplace</a></li>
                        <li><a href="#">Integrations</a></li>
                    </ul>
                </div>

                <!-- Outlet Types Section -->
                <div class="footer-section">
                    <h3>Outlet types</h3>
                    <ul>
                        <li><a href="#">Fine Dine</a></li>
                        <li><a href="#">QSR</a></li>
                        <li><a href="#">Cafe</a></li>
                        <li><a href="#">Food Court</a></li>
                        <li><a href="#">Cloud Kitchen</a></li>
                        <li><a href="#">Ice Cream</a></li>
                        <li><a href="#">Bakery</a></li>
                        <li><a href="#">Bar & Brewery</a></li>
                        <li><a href="#">Pizzeria</a></li>
                        <li><a href="#">Large Chains</a></li>
                    </ul>
                </div>

                <!-- Resources Section -->
                <div class="footer-section">
                    <h3>Resources</h3>
                    <ul>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Reseller</a></li>
                        <li><a href="#">Magazine</a></li>
                    </ul>
                </div>


            </div>

            <div class="footer-bottom">
                <div class="logo-section">
                    <div class="logo">
                        PETP<span class="red-o">O</span><span class="red-o">O</span>JA
                    </div>
                </div>

            <div class="social-links">
                <a href="#" class="social-icon magic"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://www.instagram.com/" class="social-icon magic"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon magic"><i class="fab fa-youtube"></i></a>
                <a href="https://www.facebook.com/" class="social-icon magic"><i class="fab fa-facebook-f"></i></a>
            </div>

                <div class="contact-info">
                    <div class="contact-item">
                        <span>📞</span>
                        <span>+919104369797</span>
                    </div>
                    <div class="contact-item">
                        <span>✉</span>
                        <span>getposs@petpooja.com</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <script>
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        const searchToggle = document.getElementById('searchToggle');
        const mobileSearch = document.getElementById('mobileSearch');
        const searchForm = document.getElementById('searchForm');
        const mobileSearchForm = document.getElementById('mobileSearchForm');
        const searchInput = document.getElementById('searchInput');
        const mobileSearchInput = document.getElementById('mobileSearchInput');
        const searchResults = document.getElementById('searchResults');
        const searchResultsText = document.getElementById('searchResultsText');

        // Hamburger menu functionality
        hamburger.addEventListener('click', function() {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
            
            // Close search if open
            mobileSearch.classList.remove('active');
        });

        // Mobile search toggle functionality
        searchToggle.addEventListener('click', function() {
            mobileSearch.classList.toggle('active');
            
            // Close menu if open
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
            
            // Focus on search input when opened
            if (mobileSearch.classList.contains('active')) {
                setTimeout(() => {
                    mobileSearchInput.focus();
                }, 100);
            }
        });

        // Search functionality
        function handleSearch(searchTerm) {
            if (searchTerm.trim()) {
                searchResultsText.textContent = `You searched for: "${searchTerm}"`;
                searchResults.classList.add('show');
                
                // Scroll to results
                searchResults.scrollIntoView({ behavior: 'smooth' });
            } else {
                searchResults.classList.remove('show');
            }
        }

        // Desktop search form
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleSearch(searchInput.value);
        });

        // Mobile search form
        mobileSearchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleSearch(mobileSearchInput.value);
            mobileSearch.classList.remove('active');
        });

        // Close menu when clicking on a link (mobile)
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });

        // Close menu and search when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInsideNav = hamburger.contains(event.target) || navMenu.contains(event.target);
            const isClickInsideSearch = searchToggle.contains(event.target) || mobileSearch.contains(event.target);
            
            if (!isClickInsideNav) {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
            }
            
            if (!isClickInsideSearch) {
                mobileSearch.classList.remove('active');
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                // Reset mobile elements on desktop
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
                mobileSearch.classList.remove('active');
            }
        });


        //------------------------------------------------------------------------------------


        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.nav-dot');
        const totalSlides = slides.length;
        let slideInterval;

        function showSlide(index) {
            // Remove active classes
            slides.forEach(slide => slide.classList.remove('active', 'exit'));
            dots.forEach(dot => dot.classList.remove('active'));

            // Add exit class to current slide
            if (slides[currentSlide]) {
                slides[currentSlide].classList.add('exit');
            }

            // Update current slide
            currentSlide = index;

            // Show new slide
            setTimeout(() => {
                slides.forEach(slide => slide.classList.remove('exit'));
                slides[currentSlide].classList.add('active');
                dots[currentSlide].classList.add('active');
            }, 100);

            // Restart progress animation
            const progressFill = document.querySelector('.progress-fill');
            progressFill.style.animation = 'none';
            progressFill.offsetHeight;
            progressFill.style.animation = 'fillProgress 4s linear infinite';
        }

        function nextSlide() {
            const nextIndex = (currentSlide + 1) % totalSlides;
            showSlide(nextIndex);
        }

        function startSlideshow() {
            slideInterval = setInterval(nextSlide, 4000);
        }

        // Initialize slideshow - starts automatically
        showSlide(0);
        startSlideshow();

    </script>
</body>
</html>