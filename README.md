### Project Features:
## User Roles:
    Implemented two user roles (admin, customer) using the Spatie package for role management.
## Customer Features:
   1. Browsing the menu .
   2. Managing his profile.
   3. Adding meals to his cart and placing orders.
   4. Seamless checkout experience with Stripe payment integration.
   5. Order tracking functionality for customer to monitor his order status.

## Admin Features:
   1. Full menu management capabilities (add, edit, delete).
   2. Order management (change order status).
   3. Real-time notifications for new orders using a WebSocket server.
   4. System statistics display for better insights into restaurant performance(total number of orders each month, number of new users weekly, number of meals added to the site, total number of users).

## Technologies Used:
1. Backend: developed using Laravel framework.
2. Frontend: designed and implemented using HTML, CSS, Bootstrap, and JavaScript.
3. Payment Processing: integrated secure payment processing using the Stripe API, ensuring a smooth checkout experience for customers.
4. Notifications: implemented WebSocket server to enable real-time notifications for admin upon receiving new orders.

### Run Project:
Execute the following commands:
1. php artisan migrate
2. php artisan db:seed
3. php artisan serve
4. php artisan websockets:serve
