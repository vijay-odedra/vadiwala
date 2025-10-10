<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name    = $_POST['Name'];
    $email   = $_POST['Email'];
    $phone   = $_POST['Phone'];
    $instructions = $_POST['special'];
    $payment = $_POST['payment'];

    // Generate random token number
    $token = rand(1000, 9999);

    // Owner email
    $owner_email = "your-email@example.com"; // <-- change to your email
    $subject_owner = "New Order Received (Token: $token)";
    $message_owner = "
    New Order Received!
    ------------------------
    Name: $name
    Email: $email
    Phone: $phone
    Payment Method: $payment
    Special Instructions: $instructions
    Token Number: $token
    ";
    $headers_owner = "From: noreply@yourdomain.com";

    // Send email to owner
    mail($owner_email, $subject_owner, $message_owner, $headers_owner);

    // Customer confirmation email
    $subject_customer = "Your Order Confirmation (Token: $token)";
    $message_customer = "
    Hi $name,

    Thank you for your order at Vadiwala!
    Your order has been received successfully.

    Your Token Number: $token

    We’ll contact you shortly.
    Regards,
    Vadiwala Team
    ";
    $headers_customer = "From: noreply@yourdomain.com";

    // Send email to customer
    mail($email, $subject_customer, $message_customer, $headers_customer);

    // Redirect or show confirmation
    echo "✅ Your order has been placed! A confirmation email has been sent.";
}
?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Deli - Menu Management</title>
    
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
        
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
                <a href="menu4.php" class="order-button">
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
            <button id="adminToggle"><i class="fas fa-user-cog"></i> Admin Panel</button>
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
            <form id="orderForm" action="https://api.web3forms.com/submit">
                <div id="orderItemDetails">
                    <!-- Order item details will be populated here -->
                </div>
                
                <div class="sub-items" id="orderSubItems">
                    <!-- Sub-items will be populated here -->
                </div>
                
                <div class="form-group">
                    <label for="customerName">Your Name</label>
                    <input type="text" id="customerName" name="Name" required>
                </div>
                
                <div class="form-group">
                    <label for="customerEmail">Email</label>
                    <input type="email" id="customerEmail" name="Email" required>
                </div>
                
                <div class="form-group">
                    <label for="customerPhone">Phone Number</label>
                    <input type="tel" id="customerPhone" name="Phone" required>
                </div>
                
                <div class="form-group">
                    <label for="specialInstructions">Special Instructions</label>
                    <textarea id="specialInstructions" rows="3" name="special"></textarea>
                </div>
                
                <div class="form-group">
                    <label>Payment Method</label>
                    <div class="payment-methods">
                        <div class="payment-method" data-method="credit"><i class="fas fa-credit-card"></i> Credit Card</div>
                        <div class="payment-method" data-method="debit"><i class="fas fa-credit-card"></i> Debit Card</div>
                        <div class="payment-method" data-method="upi"><i class="fas fa-mobile-alt"></i> UPI</div>
                        <div class="payment-method" data-method="cash"><i class="fas fa-money-bill-wave"></i> Cash</div>
                    </div>
                    <input type="hidden" id="paymentMethod" name="payment" required>
                </div>
                
                <button type="submit"><i class="fas fa-paper-plane" ></i> Place Order</button>
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