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
    <title>Hotel Deli - Menu Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>


        /* Navigation Bar Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        .header-navigation {
            background-color: #fef7cd;
            padding: 0.7rem 0;
            border-bottom: 2px solid #dc2626;
            position: relative;
        }

        .navigation-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #dc2626;
        }

        .brand-logo img {
            height: 40px;
            width: 40px;
            margin-right: 10px;
            border-radius: 50%;
            object-fit: cover;
        }

        .brand-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #dc2626;
        }

        .menu-list {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            align-items: center;
        }

        .menu-option {
            margin: 0 1.5rem;
        }

        .menu-anchor {
            text-decoration: none;
            color: #dc2626;
            font-weight: 500;
            padding: 0.5rem 0;
            border-bottom: 2px solid transparent;
            transition: border-bottom 0.3s ease;
        }

        .menu-anchor:hover {
            border-bottom: 2px solid #dc2626;
        }

        /* Order Button Styles */
        .order-button {
            background-color: #dc2626;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-left: 1rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .order-button:hover {
            background-color: #b91c1c;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        .order-button i {
            font-size: 1rem;
        }

        /* Search Bar Styles */
        .lookup-wrapper {
            position: relative;
            margin-left: 1rem;
        }

        .lookup-element {
            display: flex;
            align-items: center;
            background-color: white;
            border: 2px solid #dc2626;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .lookup-element:focus-within {
            box-shadow: 0 0 10px rgba(220, 38, 38, 0.3);
        }

        .lookup-field {
            border: none;
            outline: none;
            background: transparent;
            color: #333;
            font-size: 0.9rem;
            width: 200px;
            padding: 0;
        }

        .lookup-field::placeholder {
            color: #999;
        }

        .lookup-submit {
            background: none;
            border: none;
            color: #dc2626;
            cursor: pointer;
            margin-left: 0.5rem;
            padding: 0;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .lookup-submit:hover {
            color: #b91c1c;
        }

        /* Search Button for Mobile */
        .mobile-lookup-trigger {
            display: none;
            background: none;
            border: 2px solid #dc2626;
            color: #dc2626;
            padding: 0.5rem;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1rem;
            margin-left: 1rem;
            transition: all 0.3s ease;
        }

        .mobile-lookup-trigger:hover {
            background-color: #dc2626;
            color: white;
        }

        /* Mobile Search Bar */
        .mobile-lookup-panel {
            display: none;
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            background-color: #fef7cd;
            padding: 1rem;
            border-bottom: 2px solid #dc2626;
            z-index: 1000;
        }

        .mobile-lookup-panel.active {
            display: block;
        }

        .mobile-lookup-panel .lookup-element {
            width: 100%;
            max-width: none;
        }

        .mobile-lookup-panel .lookup-field {
            width: 100%;
        }

        .menu-toggle-icon {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 0.5rem;
            order: -1;
            margin-right: 1rem;
        }

        .menu-toggle-icon span {
            width: 25px;
            height: 3px;
            background-color: #dc2626;
            margin: 2px 0;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .menu-toggle-icon.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .menu-toggle-icon.active span:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle-icon.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        /* Search Results */
        .lookup-results-display {
            background-color: white;
            border: 2px solid #dc2626;
            border-radius: 10px;
            padding: 2rem;
            margin: 2rem auto;
            max-width: 1200px;
            display: none;
        }

        .lookup-results-display.show {
            display: block;
        }

        .lookup-results-display h3 {
            color: #dc2626;
            margin-bottom: 1rem;
        }

        /* Action buttons container for better organization */
        .nav-actions {
            display: flex;
            align-items: center;
        }

        /* Mobile Responsive */
        @media screen and (max-width: 768px) {
            .navigation-wrapper {
                flex-wrap: wrap;
            }

            .menu-toggle-icon {
                display: flex;
            }

            .lookup-wrapper {
                display: none;
            }

            .mobile-lookup-trigger {
                display: block;
            }

            .menu-list {
                position: fixed;
                left: -100%;
                top: 70px;
                flex-direction: column;
                background-color: #fef7cd;
                width: 100%;
                text-align: left;
                padding: 2rem 0;
                border-bottom: 2px solid #dc2626;
                z-index: 1000;
                transition: left 0.3s ease;
            }

            .menu-list.active {
                left: 0;
            }

            .menu-option {
                margin: 0;
                padding: 0 2rem;
            }

            .menu-anchor {
                padding: 1rem 0;
                display: block;
                border-bottom: none;
            }

            .menu-anchor:hover {
                border-bottom: none;
                background-color: rgba(220, 38, 38, 0.1);
            }

            .brand-title {
                font-size: 1.3rem;
            }

            /* Mobile Order Button Adjustments */
            .order-button {
                margin-left: 0.5rem;
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }

            .nav-actions {
                gap: 0.5rem;
            }
        }

        @media screen and (max-width: 480px) {
            .navigation-wrapper {
                padding: 0 0.5rem;
            }

            .brand-logo img {
                height: 35px;
                width: 35px;
            }

            .brand-title {
                font-size: 1.2rem;
            }

            .mobile-lookup-trigger {
                margin-left: 10rem;
                padding: 0.4rem;
            }

            .order-button {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
                margin-left: 0.25rem;
            }

            .order-button span {
                display: none; /* Hide text on very small screens, keep icon */
            }
        }

                



        :root {
            --primary-red: #c62828;
            --secondary-cream: #f5f5f5;
            --accent-dark: #333;
            --text-light: #fff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--secondary-cream);
            color: var(--accent-dark);
            line-height: 1.6;
        }
        
        header {
            background-color: var(--primary-red);
            color: var(--text-light);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo i {
            font-size: 2rem;
        }
        
        .admin-controls {
            display: flex;
            gap: 1rem;
        }
        
        button {
            background-color: var(--secondary-cream);
            color: var(--primary-red);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        button:hover {
            background-color: #e0e0e0;
            transform: translateY(-2px);
        }
        
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .menu-categories {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }
        
        .category-btn {
            background-color: white;
            color: var(--accent-dark);
            border: 1px solid #ddd;
            white-space: nowrap;
        }
        
        .category-btn.active {
            background-color: var(--primary-red);
            color: var(--text-light);
        }
        
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        
        .menu-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            position: relative;
        }
        
        .menu-card:hover {
            transform: translateY(-5px);
        }
        
        .menu-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        
        .menu-card-content {
            padding: 1rem;
        }
        
        .menu-card h3 {
            margin-bottom: 0.5rem;
            color: var(--primary-red);
        }
        
        .menu-card p {
            color: #666;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        
        .menu-card-price {
            font-weight: bold;
            color: var(--primary-red);
            font-size: 1.2rem;
        }
        
        .order-btn {
            width: 100%;
            margin-top: 1rem;
            background-color: var(--primary-red);
            color: white;
        }
        
        .expiry-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content {
            background-color: white;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 2rem;
            position: relative;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        .close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.5rem;
            background: none;
            color: var(--accent-dark);
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        
        .form-group input, 
        .form-group select, 
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: var(--transition);
        }
        
        .form-group input:focus, 
        .form-group select:focus, 
        .form-group textarea:focus {
            border-color: var(--primary-red);
            outline: none;
        }
        
        .sub-items {
            margin: 1rem 0;
        }
        
        .sub-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        
        .sub-item input[type="checkbox"] {
            width: auto;
            margin-right: 0.5rem;
        }
        
        .payment-methods {
            display: flex;
            gap: 1rem;
            margin: 1rem 0;
            flex-wrap: wrap;
        }
        
        .payment-method {
            flex: 1;
            min-width: 100px;
            text-align: center;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .payment-method.selected {
            border-color: var(--primary-red);
            background-color: rgba(198, 40, 40, 0.1);
        }
        
        /* Admin Panel Styles */
        .admin-panel {
            display: none;
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
            animation: fadeIn 0.5s ease;
        }
        
        .image-upload {
            border: 2px dashed #ddd;
            padding: 2rem;
            text-align: center;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .image-upload:hover {
            border-color: var(--primary-red);
        }
        
        .sub-item-input {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }
        
        .sub-item-input input {
            flex: 1;
        }
        
        .success-message {
            background-color: #4caf50;
            color: white;
            padding: 1rem;
            border-radius: 4px;
            margin-top: 1rem;
            display: none;
            text-align: center;
        }
        
        /* Order History Styles */
        .order-history {
            display: none;
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }
        
        .order-item {
            border-bottom: 1px solid #eee;
            padding: 1rem 0;
            position: relative;
        }
        
        .order-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }
        
        .cancel-btn {
            background-color: #f44336;
            color: white;
            padding: 0.3rem 0.8rem;
            font-size: 0.9rem;
        }
        
        .delete-btn {
            background-color: #ff9800;
            color: white;
            padding: 0.3rem 0.8rem;
            font-size: 0.9rem;
        }
        
        /* Token Display */
        .token-display {
            background-color: #e8f5e9;
            border-left: 4px solid #4caf50;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 4px;
        }
        
        .token-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2e7d32;
        }
        
        .estimated-time {
            font-size: 1.2rem;
            color: #d32f2f;
            font-weight: bold;
        }
        
        /* Cancellation Modal */
        .cancellation-reason {
            margin: 1rem 0;
        }
        
        .cancellation-reason textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: vertical;
            min-height: 100px;
        }
        
        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 0.3rem 0.6rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
            margin-left: 0.5rem;
        }
        
        .status-confirmed {
            background-color: #4caf50;
            color: white;
        }
        
        .status-cancelled {
            background-color: #f44336;
            color: white;
        }
        
        /* Responsive Styles */
        @media (max-width: 768px) {
            .menu-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
            
            header {
                flex-direction: column;
                gap: 1rem;
            }
            
            .admin-controls {
                width: 100%;
                justify-content: center;
            }
            
            .payment-methods {
                flex-direction: column;
            }
            
            .order-actions {
                flex-direction: column;
            }
        }
        
        @media (max-width: 480px) {
            .menu-grid {
                grid-template-columns: 1fr;
            }
            
            .modal-content {
                width: 95%;
                padding: 1rem;
            }
            
            .sub-item-input {
                flex-direction: column;
            }
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Hide back button */
        .back-button {
            display: none;
        }
        
        /* Disabled state for expired items */
        .expired {
            opacity: 0.7;
        }
        
        .expired .order-btn {
            background-color: #ccc;
            cursor: not-allowed;
        }



                /* ---------------------------------------------------------------------------------- */


        
        /* Footer */

        .main-content {
            min-height: calc(100vh - 200px);
            padding: 40px 20px;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        footer {
            background-color: #f5f3f0;
            padding: 60px 0 40px;
            color: #666;
            font-size: 14px;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 12px;
        }

        .footer-section ul li a {
            color: #000;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: #e74c3c;
        }

        .marketplace-link {
            color: #e74c3c !important;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 30px;
            border-top: 1px solid #e0ddd8;
            flex-wrap: wrap;
            gap: 20px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #333;
        }

        .logo .red-o {
            color: #e74c3c;
        }

        .social-links {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background: #333;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .social-icon:hover {
            background: #e74c3c;
        }

        .contact-info {
            display: flex;
            gap: 30px;
            align-items: center;
            flex-wrap: wrap;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
        }

        .company-address {
            grid-column: span 2;
            padding: 20px;
            background: rgba(231, 76, 60, 0.05);
            border-radius: 8px;
            border-left: 4px solid #e74c3c;
        }

        .company-address h3 {
            color: #e74c3c;
            margin-bottom: 15px;
        }

        .company-address p {
            line-height: 1.6;
            color: #555;
        }

        @media (max-width: 768px) {
            
            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
            
            .social-links {
                order: -1;
            }
        }

    .social-links {
    display: flex;
    gap: 12px;
    }

    .social-icon {
    text-decoration: none;
    font-size: 20px;
    }

    .magic {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: black;
    color: white;
    transition: all 0.3s ease;
    }

    .magic:hover {
    background: linear-gradient(45deg,#e74c3c);
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }




    </style>
</head>
<body>


    <!-- Navigation Component -->
    <nav class="header-navigation" id="primaryNavigation">
        <div class="navigation-wrapper">
            <div class="menu-toggle-icon" id="burgerIcon">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <a href="#" class="brand-logo">
                <img src="../DIVYRAJ/food.png" alt="Logo">
                <span class="brand-title">VadiWala</span>
            </a>
            
            <ul class="menu-list" id="navigationMenu">
                <li class="menu-option"><a href="../VIJAY/home1.html" class="menu-anchor">Home</a></li>
                <li class="menu-option"><a href="../VANSH/about_us.html" class="menu-anchor">About</a></li>
                <li class="menu-option"><a href="../CHIRAG/services.html" class="menu-anchor">Services</a></li>
                <li class="menu-option"><a href="../VIJAY/gallery.html" class="menu-anchor">Gallery</a></li>
            </ul>

            <!-- Action buttons container -->
            <div class="nav-actions">
                <!-- Desktop Search Bar -->
                <div class="lookup-wrapper">
                    <form class="lookup-element" id="desktopLookupForm">
                        <input type="text" class="lookup-field" placeholder="Search..." id="desktopLookupField">
                        <button type="submit" class="lookup-submit">🔍</button>
                    </form>
                </div>

                <!-- Mobile Search Toggle Button -->
                <button class="mobile-lookup-trigger" id="mobileLookupToggle">🔍</button>

                <!-- Order Button -->
                <a href="../VIJAY/menu4.html" class="order-button">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Order Now</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Mobile Search Panel -->
    <div class="mobile-lookup-panel" id="mobileLookupPanel">
        <form class="lookup-element" id="mobileLookupForm">
            <input type="text" class="lookup-field" placeholder="Search..." id="mobileLookupField">
            <button type="submit" class="lookup-submit">🔍</button>
        </form>
    </div>




    <header>
        <div class="logo">
            <i class="fas fa-utensils"></i>
            <span></span>
        </div>
        
        <div class="admin-controls">
            <?php if ($_SESSION['email'] === $adminEmail): ?>
            <button id="adminToggle"><i class="fas fa-user-cog"></i> Admin Panel</button>
            <?php endif; ?>
            <button id="viewOrders"><i class="fas fa-clipboard-list"></i> View Orders</button>
            <button id="cancelOrderBtn"><i class="fas fa-times-circle"></i> Cancel Order</button>
        </div>
         
    </header>
    
    <div class="container">
        <!-- Admin Panel -->
        <div class="admin-panel" id="adminPanel">
            <h2><i class="fas fa-plus-circle"></i> Add New Menu Item</h2>
            <form id="addItemForm">
                <div class="form-group">
                    <label for="itemName">Item Name</label>
                    <input type="text" id="itemName" required>
                </div>
                
                <div class="form-group">
                    <label for="itemDescription">Description</label>
                    <textarea id="itemDescription" rows="3" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="itemPrice">Price (₹)</label>
                    <input type="number" id="itemPrice" min="0" step="0.01" required>
                </div>
                
                <div class="form-group">
                    <label for="itemCategory">Category</label>
                    <select id="itemCategory" required>
                        <option value="sandwiches">Sandwiches</option>
                        <option value="salads">Salads</option>
                        <option value="soups">Soups</option>
                        <option value="desserts">Desserts</option>
                        <option value="beverages">Beverages</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Item Image</label>
                    <div class="image-upload" id="imageUpload">
                        <p><i class="fas fa-cloud-upload-alt"></i> Click to select an image</p>
                        <input type="file" id="itemImage" accept="image/*" style="display: none;">
                    </div>
                    <div id="imagePreview"></div>
                </div>
                
                <div class="form-group">
                    <label>Sub-items (Optional)</label>
                    <div id="subItemsContainer">
                        <div class="sub-item-input">
                            <input type="text" placeholder="Sub-item name">
                            <input type="number" placeholder="Price (₹)" min="0" step="0.01">
                            <button type="button" class="remove-sub-item"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                    <button type="button" id="addSubItem"><i class="fas fa-plus"></i> Add Sub-item</button>
                </div>
                
                <button type="submit"><i class="fas fa-save"></i> Add Menu Item</button>
            </form>
            <div class="success-message" id="successMessage">
                <i class="fas fa-check-circle"></i> Menu item added successfully!
            </div>
        </div>
        
        <!-- Order History -->
        <div class="order-history" id="orderHistory">
            <h2><i class="fas fa-history"></i> Order History</h2>
            <div id="ordersList">
                <!-- Orders will be listed here -->
            </div>
            <button id="closeOrderHistory"><i class="fas fa-times"></i> Close</button>
        </div>
        
        <!-- Menu Categories -->
        <div class="menu-categories">
            <button class="category-btn active" data-category="all">All Items</button>
            <button class="category-btn" data-category="sandwiches">Sandwiches</button>
            <button class="category-btn" data-category="salads">Salads</button>
            <button class="category-btn" data-category="soups">Soups</button>
            <button class="category-btn" data-category="desserts">Desserts</button>
            <button class="category-btn" data-category="beverages">Beverages</button>
        </div>
        
        <!-- Menu Items Grid -->
        <div class="menu-grid" id="menuGrid">
            <!-- Menu items will be dynamically added here -->
        </div>
    </div>
    
    <!-- Order Modal -->
    <div class="modal" id="orderModal">
        <div class="modal-content">
            <button class="close-btn" id="closeOrderModal">&times;</button>
            <h2><i class="fas fa-shopping-cart"></i> Place Your Order</h2>
            <form id="orderForm">
                <div id="orderItemDetails">
                    <!-- Order item details will be populated here -->
                </div>
                
                <div class="sub-items" id="orderSubItems">
                    <!-- Sub-items will be populated here -->
                </div>
                
                <div class="form-group">
                    <label for="customerName">Your Name</label>
                    <input type="text" id="customerName" required>
                </div>
                
                <div class="form-group">
                    <label for="customerEmail">Email</label>
                    <input type="email" id="customerEmail" required>
                </div>
                
                <div class="form-group">
                    <label for="customerPhone">Phone Number</label>
                    <input type="tel" id="customerPhone" required>
                </div>
                
                <div class="form-group">
                    <label for="specialInstructions">Special Instructions</label>
                    <textarea id="specialInstructions" rows="3"></textarea>
                </div>
                
                <div class="form-group">
                    <label>Payment Method</label>
                    <div class="payment-methods">
                        <div class="payment-method" data-method="credit"><i class="fas fa-credit-card"></i> Credit Card</div>
                        <div class="payment-method" data-method="debit"><i class="fas fa-credit-card"></i> Debit Card</div>
                        <div class="payment-method" data-method="upi"><i class="fas fa-mobile-alt"></i> UPI</div>
                        <div class="payment-method" data-method="cash"><i class="fas fa-money-bill-wave"></i> Cash</div>
                    </div>
                    <input type="hidden" id="paymentMethod" required>
                </div>
                
                <button type="submit"><i class="fas fa-paper-plane"></i> Place Order</button>
            </form>
        </div>
    </div>
    
    <!-- Order Confirmation Modal -->
    <div class="modal" id="confirmationModal">
        <div class="modal-content">
            <h2><i class="fas fa-check-circle"></i> Order Confirmed!</h2>
            <div class="token-display">
                <p>Your order token number is: <span class="token-number" id="confirmedToken">1</span></p>
                <p>Your food will be ready in approximately: <span class="estimated-time" id="estimatedReadyTime">15 minutes</span></p>
            </div>
            <p>Thank you for your order. A confirmation email has been sent to your email address.</p>
            <div class="order-actions" style="justify-content: center; margin-top: 1.5rem;">
                <button id="cancelOrderFromConfirmation" class="cancel-btn"><i class="fas fa-times"></i> Cancel This Order</button>
                <button id="closeConfirmationModal">OK</button>
            </div>
        </div>
    </div>
    
    <!-- Cancel Order Modal -->
    <div class="modal" id="cancelOrderModal">
        <div class="modal-content">
            <button class="close-btn" id="closeCancelModal">&times;</button>
            <h2><i class="fas fa-times-circle"></i> Cancel Order</h2>
            <form id="cancelOrderForm">
                <div class="form-group">
                    <label for="cancelToken">Token Number</label>
                    <input type="number" id="cancelToken" min="1" required>
                </div>
                
                <div class="form-group">
                    <label for="cancelEmail">Email Address</label>
                    <input type="email" id="cancelEmail" required>
                </div>
                
                <div class="cancellation-reason">
                    <label for="cancelReason">Reason for Cancellation (Optional)</label>
                    <textarea id="cancelReason" placeholder="Please let us know why you're cancelling..."></textarea>
                </div>
                
                <button type="submit"><i class="fas fa-times"></i> Cancel Order</button>
            </form>
        </div>
    </div>
    
    <!-- Cancellation Confirmation Modal -->
    <div class="modal" id="cancellationConfirmationModal">
        <div class="modal-content">
            <h2><i class="fas fa-check-circle"></i> Order Cancelled!</h2>
            <p>Your order has been successfully cancelled. A confirmation email has been sent to your email address.</p>
            <button id="closeCancellationModal">OK</button>
        </div>
    </div>




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
                            VADI<span class="red-o">W</span><span class="red-o">A</span>LA
                    </div>
                </div>

    <div class="social-links">
        <a href="#" class="social-icon magic"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="social-icon magic"><i class="fab fa-instagram"></i></a>
        <a href="#" class="social-icon magic"><i class="fa-brands fa-x-twitter"></i></a>
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
        // Sample menu data with expiry timestamps
        let menuItems = [
            {
                id: 1,
                name: "Club Sandwich",
                description: "Triple-decker sandwich with turkey, bacon, lettuce, tomato, and mayo",
                price: 350,
                category: "sandwiches",
                image: "https://images.unsplash.com/photo-1553909489-cd47e0907980?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60",
                subItems: [
                    { name: "Extra Cheese", price: 30 },
                    { name: "Extra Bacon", price: 40 }
                ],
                addedAt: Date.now() // Current timestamp
            },
            {
                id: 2,
                name: "Caesar Salad",
                description: "Fresh romaine lettuce with Caesar dressing, croutons, and parmesan cheese",
                price: 280,
                category: "salads",
                image: "https://images.unsplash.com/photo-1546793665-c74683f339c1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60",
                addedAt: Date.now() - (12 * 60 * 60 * 1000) // 12 hours ago
            },
            {
                id: 3,
                name: "Tomato Basil Soup",
                description: "Creamy tomato soup with fresh basil and croutons",
                price: 180,
                category: "soups",
                image: "https://images.unsplash.com/photo-1476124369491-e7addf5db371?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60",
                addedAt: Date.now() - (20 * 60 * 60 * 1000) // 20 hours ago
            }
        ];
        
        // Orders data
        let orders = [];
        
        // Token counter (starts at 1)
        let tokenCounter = 1;
        
        // DOM Elements
        const adminPanel = document.getElementById('adminPanel');
        const adminToggle = document.getElementById('adminToggle');
        const menuGrid = document.getElementById('menuGrid');
        const categoryBtns = document.querySelectorAll('.category-btn');
        const orderModal = document.getElementById('orderModal');
        const closeOrderModal = document.getElementById('closeOrderModal');
        const orderForm = document.getElementById('orderForm');
        const confirmationModal = document.getElementById('confirmationModal');
        const closeConfirmationModal = document.getElementById('closeConfirmationModal');
        const cancelOrderFromConfirmation = document.getElementById('cancelOrderFromConfirmation');
        const confirmedToken = document.getElementById('confirmedToken');
        const estimatedReadyTime = document.getElementById('estimatedReadyTime');
        const addItemForm = document.getElementById('addItemForm');
        const imageUpload = document.getElementById('imageUpload');
        const itemImage = document.getElementById('itemImage');
        const imagePreview = document.getElementById('imagePreview');
        const subItemsContainer = document.getElementById('subItemsContainer');
        const addSubItemBtn = document.getElementById('addSubItem');
        const successMessage = document.getElementById('successMessage');
        const orderHistory = document.getElementById('orderHistory');
        const viewOrders = document.getElementById('viewOrders');
        const closeOrderHistory = document.getElementById('closeOrderHistory');
        const ordersList = document.getElementById('ordersList');
        const cancelOrderBtn = document.getElementById('cancelOrderBtn');
        const cancelOrderModal = document.getElementById('cancelOrderModal');
        const closeCancelModal = document.getElementById('closeCancelModal');
        const cancelOrderForm = document.getElementById('cancelOrderForm');
        const cancellationConfirmationModal = document.getElementById('cancellationConfirmationModal');
        const closeCancellationModal = document.getElementById('closeCancellationModal');
        
        // Current order item
        let currentOrderItem = null;
        let currentOrder = null;
        
        // Initialize the page
        function init() {
            // Load data from localStorage if available
            loadDataFromStorage();
            
            // Check for expired items and remove them
            checkExpiredItems();
            
            renderMenuItems();
            setupEventListeners();
            
            // Set up automatic expiration check every hour
            setInterval(checkExpiredItems, 60 * 60 * 1000);
        }
        
        // Load data from localStorage
        function loadDataFromStorage() {
            const savedMenuItems = localStorage.getItem('hotelDeliMenuItems');
            const savedOrders = localStorage.getItem('hotelDeliOrders');
            const savedTokenCounter = localStorage.getItem('hotelDeliTokenCounter');
            
            if (savedMenuItems) {
                menuItems = JSON.parse(savedMenuItems);
            }
            
            if (savedOrders) {
                orders = JSON.parse(savedOrders);
            }
            
            if (savedTokenCounter) {
                tokenCounter = parseInt(savedTokenCounter);
            }
        }
        
        // Save data to localStorage
        function saveDataToStorage() {
            localStorage.setItem('hotelDeliMenuItems', JSON.stringify(menuItems));
            localStorage.setItem('hotelDeliOrders', JSON.stringify(orders));
            localStorage.setItem('hotelDeliTokenCounter', tokenCounter.toString());
        }
        
        // Check for expired items (older than 24 hours) and remove them
        function checkExpiredItems() {
            const now = Date.now();
            const twentyFourHours = 24 * 60 * 60 * 1000;
            
            menuItems = menuItems.filter(item => {
                return (now - item.addedAt) < twentyFourHours;
            });
            
            saveDataToStorage();
            renderMenuItems();
        }
        
        // Calculate time remaining until expiration
        function getTimeRemaining(addedAt) {
            const now = Date.now();
            const twentyFourHours = 24 * 60 * 60 * 1000;
            const timeRemaining = twentyFourHours - (now - addedAt);
            
            if (timeRemaining <= 0) return "Expired";
            
            const hours = Math.floor(timeRemaining / (60 * 60 * 1000));
            const minutes = Math.floor((timeRemaining % (60 * 60 * 1000)) / (60 * 1000));
            
            return `${hours}h ${minutes}m`;
        }
        
        // Calculate estimated ready time (15 minutes from now)
        function getEstimatedReadyTime() {
            const now = new Date();
            const readyTime = new Date(now.getTime() + 15 * 60000); // Add 15 minutes
            
            // Format as HH:MM AM/PM
            let hours = readyTime.getHours();
            let minutes = readyTime.getMinutes();
            const ampm = hours >= 12 ? 'PM' : 'AM';
            
            hours = hours % 12;
            hours = hours ? hours : 12; // 0 should be 12
            minutes = minutes < 10 ? '0' + minutes : minutes;
            
            return `${hours}:${minutes} ${ampm}`;
        }
        
        // Set up event listeners
        function setupEventListeners() {
            // Admin panel toggle
            adminToggle.addEventListener('click', toggleAdminPanel);
            
            // Category filters
            categoryBtns.forEach(btn => {
                btn.addEventListener('click', () => filterMenuItems(btn.dataset.category));
            });
            
            // Order modal
            closeOrderModal.addEventListener('click', () => orderModal.style.display = 'none');
            
            // Order form submission
            orderForm.addEventListener('submit', handleOrderSubmission);
            
            // Confirmation modal
            closeConfirmationModal.addEventListener('click', () => confirmationModal.style.display = 'none');
            cancelOrderFromConfirmation.addEventListener('click', () => {
                confirmationModal.style.display = 'none';
                cancelCurrentOrder();
            });
            
            // Payment method selection
            document.querySelectorAll('.payment-method').forEach(method => {
                method.addEventListener('click', () => {
                    document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('selected'));
                    method.classList.add('selected');
                    document.getElementById('paymentMethod').value = method.dataset.method;
                });
            });
            
            // Add item form submission
            addItemForm.addEventListener('submit', handleAddItem);
            
            // Image upload
            imageUpload.addEventListener('click', () => itemImage.click());
            itemImage.addEventListener('change', handleImageUpload);
            
            // Add sub-item
            addSubItemBtn.addEventListener('click', addSubItemInput);
            
            // Order history
            viewOrders.addEventListener('click', showOrderHistory);
            closeOrderHistory.addEventListener('click', () => orderHistory.style.display = 'none');
            
            // Cancel order
            cancelOrderBtn.addEventListener('click', () => cancelOrderModal.style.display = 'flex');
            closeCancelModal.addEventListener('click', () => cancelOrderModal.style.display = 'none');
            cancelOrderForm.addEventListener('submit', handleCancelOrder);
            closeCancellationModal.addEventListener('click', () => cancellationConfirmationModal.style.display = 'none');
            
            // Close modals when clicking outside
            window.addEventListener('click', (e) => {
                if (e.target === orderModal) orderModal.style.display = 'none';
                if (e.target === confirmationModal) confirmationModal.style.display = 'none';
                if (e.target === cancelOrderModal) cancelOrderModal.style.display = 'none';
                if (e.target === cancellationConfirmationModal) cancellationConfirmationModal.style.display = 'none';
            });
            
            // Prevent back button navigation
            window.addEventListener('popstate', function(event) {
                history.pushState(null, document.title, location.href);
            });
            
            // Initialize with no back history
            history.pushState(null, document.title, location.href);
        }
        
        // Toggle admin panel visibility
        function toggleAdminPanel() {
            adminPanel.style.display = adminPanel.style.display === 'none' ? 'block' : 'none';
            orderHistory.style.display = 'none';
        }
        
        // Show order history
        function showOrderHistory() {
            orderHistory.style.display = 'block';
            adminPanel.style.display = 'none';
            renderOrders();
        }
        
        // Render orders in the order history
        function renderOrders() {
            ordersList.innerHTML = '';
            
            if (orders.length === 0) {
                ordersList.innerHTML = '<p>No orders yet.</p>';
                return;
            }
            
            orders.forEach((order, index) => {
                const orderEl = document.createElement('div');
                orderEl.className = 'order-item';
                
                const totalPrice = order.item.price + 
                    (order.selectedSubItems ? order.selectedSubItems.reduce((sum, item) => sum + item.price, 0) : 0);
                
                const statusClass = order.status === 'cancelled' ? 'status-cancelled' : 'status-confirmed';
                const statusText = order.status === 'cancelled' ? 'Cancelled' : 'Confirmed';
                
                orderEl.innerHTML = `
                    <h3>Order #${index + 1} <span class="status-badge ${statusClass}">${statusText}</span></h3>
                    <p><strong>Token:</strong> ${order.token}</p>
                    <p><strong>Item:</strong> ${order.item.name}</p>
                    <p><strong>Customer:</strong> ${order.customerName} (${order.customerEmail})</p>
                    <p><strong>Total:</strong> ₹${totalPrice}</p>
                    <p><strong>Payment:</strong> ${order.paymentMethod}</p>
                    <p><strong>Estimated Ready Time:</strong> ${order.estimatedReadyTime}</p>
                    <p><strong>Time:</strong> ${new Date(order.timestamp).toLocaleString()}</p>
                    ${order.cancellationReason ? `<p><strong>Cancellation Reason:</strong> ${order.cancellationReason}</p>` : ''}
                    <div class="order-actions">
                        ${order.status !== 'cancelled' ? `<button class="cancel-btn" data-token="${order.token}"><i class="fas fa-times"></i> Cancel Order</button>` : ''}
                        <button class="delete-btn" data-index="${index}"><i class="fas fa-trash"></i> Delete Order</button>
                    </div>
                `;
                
                ordersList.appendChild(orderEl);
            });
            
            // Add event listeners to cancel and delete buttons
            document.querySelectorAll('.cancel-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const token = parseInt(e.target.closest('.cancel-btn').dataset.token);
                    cancelOrderByToken(token);
                });
            });
            
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const index = parseInt(e.target.closest('.delete-btn').dataset.index);
                    deleteOrder(index);
                });
            });
        }
        
        // Filter menu items by category
        function filterMenuItems(category) {
            // Update active category button
            categoryBtns.forEach(btn => {
                btn.classList.toggle('active', btn.dataset.category === category);
            });
            
            // Filter and render items
            const filteredItems = category === 'all' 
                ? menuItems 
                : menuItems.filter(item => item.category === category);
            
            renderMenuItems(filteredItems);
        }
        
        // Render menu items to the grid
        function renderMenuItems(items = menuItems) {
            menuGrid.innerHTML = '';
            
            if (items.length === 0) {
                menuGrid.innerHTML = '<p>No menu items available. Add some items in the admin panel.</p>';
                return;
            }
            
            items.forEach(item => {
                const timeRemaining = getTimeRemaining(item.addedAt);
                const isExpired = timeRemaining === "Expired";
                
                const card = document.createElement('div');
                card.className = `menu-card ${isExpired ? 'expired' : ''}`;
                card.innerHTML = `
                    <img src="${item.image}" alt="${item.name}">
                    ${!isExpired ? `<div class="expiry-badge">Expires in: ${timeRemaining}</div>` : '<div class="expiry-badge">Expired</div>'}
                    <div class="menu-card-content">
                        <h3>${item.name}</h3>
                        <p>${item.description}</p>
                        <div class="menu-card-price">₹${item.price}</div>
                        <button class="order-btn" data-id="${item.id}" ${isExpired ? 'disabled' : ''}>
                            <i class="fas fa-shopping-cart"></i> ${isExpired ? 'Expired' : 'Order Now'}
                        </button>
                    </div>
                `;
                
                if (!isExpired) {
                    card.querySelector('.order-btn').addEventListener('click', () => openOrderModal(item));
                }
                
                menuGrid.appendChild(card);
            });
        }
        
        // Open order modal with item details
        function openOrderModal(item) {
            currentOrderItem = item;
            
            // Populate item details
            document.getElementById('orderItemDetails').innerHTML = `
                <h3>${item.name}</h3>
                <p>${item.description}</p>
                <div class="menu-card-price">Base Price: ₹${item.price}</div>
            `;
            
            // Populate sub-items if available
            const subItemsContainer = document.getElementById('orderSubItems');
            subItemsContainer.innerHTML = '';
            
            if (item.subItems && item.subItems.length > 0) {
                subItemsContainer.innerHTML = '<h4>Add-ons (Optional)</h4>';
                
                item.subItems.forEach((subItem, index) => {
                    const subItemEl = document.createElement('div');
                    subItemEl.className = 'sub-item';
                    subItemEl.innerHTML = `
                        <input type="checkbox" id="subItem${index}" data-price="${subItem.price}">
                        <label for="subItem${index}">${subItem.name} (+₹${subItem.price})</label>
                    `;
                    subItemsContainer.appendChild(subItemEl);
                });
            }
            
            // Reset form
            orderForm.reset();
            document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('selected'));
            document.getElementById('paymentMethod').value = '';
            
            // Show modal
            orderModal.style.display = 'flex';
        }
        
        // Handle order form submission
        function handleOrderSubmission(e) {
            e.preventDefault();
            
            // Calculate total price
            let totalPrice = currentOrderItem.price;
            const selectedSubItems = [];
            const selectedSubItemsElements = document.querySelectorAll('#orderSubItems input[type="checkbox"]:checked');
            
            selectedSubItemsElements.forEach(item => {
                const price = parseFloat(item.dataset.price);
                totalPrice += price;
                selectedSubItems.push({
                    name: item.nextElementSibling.textContent.split(' (+')[0],
                    price: price
                });
            });
            
            // Get estimated ready time
            const readyTime = getEstimatedReadyTime();
            
            // Assign token
            const token = tokenCounter;
            tokenCounter++; // Increment for next order
            
            // Create order object
            const order = {
                token: token,
                item: currentOrderItem,
                customerName: document.getElementById('customerName').value,
                customerEmail: document.getElementById('customerEmail').value,
                customerPhone: document.getElementById('customerPhone').value,
                specialInstructions: document.getElementById('specialInstructions').value,
                paymentMethod: document.getElementById('paymentMethod').value,
                totalPrice: totalPrice,
                selectedSubItems: selectedSubItems.length > 0 ? selectedSubItems : null,
                estimatedReadyTime: readyTime,
                timestamp: Date.now(),
                status: 'confirmed'
            };
            
            // Add to orders array
            orders.push(order);
            saveDataToStorage();
            
            // Store current order for potential cancellation
            currentOrder = order;
            
            // Update confirmation modal with token and ready time
            confirmedToken.textContent = token;
            estimatedReadyTime.textContent = readyTime;
            
            // Send email notifications (simulated)
            sendEmailNotifications(order, 'confirmation');
            
            // Show confirmation modal
            orderModal.style.display = 'none';
            confirmationModal.style.display = 'flex';
            
            // Reset current order item
            currentOrderItem = null;
        }
        
        // Cancel current order (from confirmation modal)
        function cancelCurrentOrder() {
            if (currentOrder) {
                currentOrder.status = 'cancelled';
                currentOrder.cancelledAt = Date.now();
                saveDataToStorage();
                
                // Send cancellation emails
                sendEmailNotifications(currentOrder, 'cancellation');
                
                // Show cancellation confirmation
                cancellationConfirmationModal.style.display = 'flex';
                
                // Reset current order
                currentOrder = null;
            }
        }
        
        // Handle cancel order form submission
        function handleCancelOrder(e) {
            e.preventDefault();
            
            const token = parseInt(document.getElementById('cancelToken').value);
            const email = document.getElementById('cancelEmail').value;
            const reason = document.getElementById('cancelReason').value;
            
            cancelOrderByToken(token, email, reason);
        }
        
        // Cancel order by token and email
        function cancelOrderByToken(token, email, reason) {
            const orderIndex = orders.findIndex(order => 
                order.token === token && order.customerEmail === email
            );
            
            if (orderIndex !== -1) {
                orders[orderIndex].status = 'cancelled';
                orders[orderIndex].cancelledAt = Date.now();
                orders[orderIndex].cancellationReason = reason || 'No reason provided';
                saveDataToStorage();
                
                // Send cancellation emails
                sendEmailNotifications(orders[orderIndex], 'cancellation');
                
                // Show cancellation confirmation
                cancelOrderModal.style.display = 'none';
                cancellationConfirmationModal.style.display = 'flex';
                cancelOrderForm.reset();
                
                // Update order history if visible
                if (orderHistory.style.display === 'block') {
                    renderOrders();
                }
            } else {
                alert('Order not found. Please check your token number and email address.');
            }
        }
        
        // Delete order from history
        function deleteOrder(index) {
            if (confirm('Are you sure you want to delete this order?')) {
                orders.splice(index, 1);
                saveDataToStorage();
                renderOrders();
            }
        }
        
        // Simulate sending email notifications
        function sendEmailNotifications(order, type) {
            if (type === 'confirmation') {
                // Customer email
                const customerEmail = {
                    to: order.customerEmail,
                    subject: `Order Confirmation - Hotel Deli`,
                    body: `
                        Dear ${order.customerName},
                        
                        Thank you for your order at Hotel Deli!
                        
                        Order Details:
                        - Token Number: ${order.token}
                        - Item: ${order.item.name}
                        - Total: ₹${order.totalPrice}
                        - Payment Method: ${order.paymentMethod}
                        ${order.specialInstructions ? `- Special Instructions: ${order.specialInstructions}` : ''}
                        
                        Your food will be ready at approximately: ${order.estimatedReadyTime}
                        
                        If you need to cancel your order, please use the "Cancel Order" button on our website.
                        
                        Thank you for choosing Hotel Deli!
                    `
                };
                
                // Owner email
                const ownerEmail = {
                    to: "owner@hoteldeli.com",
                    subject: `New Order - Token #${order.token} - ${order.item.name}`,
                    body: `
                        New order received:
                        
                        Token: ${order.token}
                        Customer: ${order.customerName}
                        Email: ${order.customerEmail}
                        Phone: ${order.customerPhone}
                        
                        Order: ${order.item.name}
                        Total: ₹${order.totalPrice}
                        Payment: ${order.paymentMethod}
                        Estimated Ready Time: ${order.estimatedReadyTime}
                        ${order.specialInstructions ? `Special Instructions: ${order.specialInstructions}` : ''}
                        
                        Please prepare this order.
                    `
                };
                
                // In a real application, you would send these emails using a service
                console.log('Confirmation email sent to customer:', customerEmail);
                console.log('Notification email sent to owner:', ownerEmail);
            } else if (type === 'cancellation') {
                // Customer cancellation email
                const customerEmail = {
                    to: order.customerEmail,
                    subject: `Order Cancellation Confirmation - Hotel Deli`,
                    body: `
                        Dear ${order.customerName},
                        
                        Your order (Token #${order.token}) has been successfully cancelled.
                        
                        Order Details:
                        - Item: ${order.item.name}
                        - Total: ₹${order.totalPrice}
                        ${order.cancellationReason ? `- Cancellation Reason: ${order.cancellationReason}` : ''}
                        
                        We hope to serve you again in the future.
                        
                        Thank you,
                        Hotel Deli Team
                    `
                };
                
                // Owner cancellation email
                const ownerEmail = {
                    to: "owner@hoteldeli.com",
                    subject: `Order Cancelled - Token #${order.token} - ${order.item.name}`,
                    body: `
                        Order cancelled:
                        
                        Token: ${order.token}
                        Customer: ${order.customerName}
                        Email: ${order.customerEmail}
                        Phone: ${order.customerPhone}
                        
                        Order: ${order.item.name}
                        Total: ₹${order.totalPrice}
                        ${order.cancellationReason ? `Cancellation Reason: ${order.cancellationReason}` : 'No reason provided'}
                        
                        This order has been cancelled by the customer.
                    `
                };
                
                console.log('Cancellation email sent to customer:', customerEmail);
                console.log('Cancellation notification sent to owner:', ownerEmail);
            }
        }
        
        // Handle adding new menu item
        function handleAddItem(e) {
            e.preventDefault();
            
            // Get form values
            const name = document.getElementById('itemName').value;
            const description = document.getElementById('itemDescription').value;
            const price = parseFloat(document.getElementById('itemPrice').value);
            const category = document.getElementById('itemCategory').value;
            
            // Get sub-items
            const subItems = [];
            document.querySelectorAll('.sub-item-input').forEach(input => {
                const nameInput = input.querySelector('input[type="text"]');
                const priceInput = input.querySelector('input[type="number"]');
                
                if (nameInput.value && priceInput.value) {
                    subItems.push({
                        name: nameInput.value,
                        price: parseFloat(priceInput.value)
                    });
                }
            });
            
            // Create new item
            const newItem = {
                id: menuItems.length > 0 ? Math.max(...menuItems.map(item => item.id)) + 1 : 1,
                name,
                description,
                price,
                category,
                image: imagePreview.querySelector('img') ? imagePreview.querySelector('img').src : 'https://via.placeholder.com/300x200?text=No+Image',
                subItems: subItems.length > 0 ? subItems : undefined,
                addedAt: Date.now()
            };
            
            // Add to menu items array
            menuItems.push(newItem);
            saveDataToStorage();
            
            // Re-render menu
            renderMenuItems();
            
            // Reset form
            addItemForm.reset();
            imagePreview.innerHTML = '';
            subItemsContainer.innerHTML = `
                <div class="sub-item-input">
                    <input type="text" placeholder="Sub-item name">
                    <input type="number" placeholder="Price (₹)" min="0" step="0.01">
                    <button type="button" class="remove-sub-item"><i class="fas fa-trash"></i></button>
                </div>
            `;
            
            // Show success message
            successMessage.style.display = 'block';
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 3000);
            
            // Hide admin panel
            adminPanel.style.display = 'none';
        }
        
        // Handle image upload
        function handleImageUpload(e) {
            const file = e.target.files[0];
            if (!file) return;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.innerHTML = `<img src="${e.target.result}" style="max-width: 100%; max-height: 200px; margin-top: 1rem;">`;
            };
            reader.readAsDataURL(file);
        }
        
        // Add sub-item input field
        function addSubItemInput() {
            const newInput = document.createElement('div');
            newInput.className = 'sub-item-input';
            newInput.innerHTML = `
                <input type="text" placeholder="Sub-item name">
                <input type="number" placeholder="Price (₹)" min="0" step="0.01">
                <button type="button" class="remove-sub-item"><i class="fas fa-trash"></i></button>
            `;
            
            newInput.querySelector('.remove-sub-item').addEventListener('click', () => {
                newInput.remove();
            });
            
            subItemsContainer.appendChild(newInput);
        }
        
        // Initialize the application
        init();
    </script>
</body>
</html>