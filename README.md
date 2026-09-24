# MediCare — Online Medicine Delivery & Inventory Tracking System

A web-based system built with Laravel that allows customers to order medicines online, upload prescriptions for restricted drugs, and track deliveries — while pharmacy admins manage stock, orders, and deliveries in real time.

Developed as a Software Development Project for the Department of MIT, Faculty of Management and Commerce, South Eastern University of Sri Lanka.

## Features

**Customer**
- Registration & login
- Browse and search medicines by name/category
- Cart (session-based) with quantity management
- Checkout with delivery address and prescription upload (for restricted medicines)
- Order history and order tracking

**Admin**
- Dashboard with key stats (total medicines, low stock, expiring soon, orders)
- Medicine catalog management (CRUD)
- Order management with status updates (pending → approved → packed → out for delivery → delivered)
- Prescription approval/rejection
- Delivery assignment and tracking
- Sales and inventory reports (top-selling medicines, low stock, expiring soon)

## Tech Stack

- **Backend:** Laravel 12 (PHP 8.2)
- **Frontend:** Blade templates, Tailwind CSS
- **Database:** MySQL
- **Auth:** Laravel Breeze with role-based access control (admin/customer)
- **Testing:** PHPUnit (39 feature/unit tests)

## Installation

1. Clone the repository: