# JetStream - Travel & Tourism Booking Platform

A complete travel and tourism booking platform built with **Laravel 12**. Users can browse and book hotels, flights, restaurants, activities, vacation rentals, cruises, and rental cars. Includes a full admin dashboard for managing all services and users.

## Features

### For Users
- **Multi-Service Booking** - Book hotels, flights, restaurants, activities, vacation rentals, cruises, and rental cars
- **Search & Filter** - Global search across all services, filter flights by criteria, activities by category/location
- **Reservations** - Manage bookings with status tracking (pending/confirmed)
- **Reviews & Ratings** - Rate and review hotels, flights, activities, and more (polymorphic system)
- **User Profile** - Profile management with photo upload and settings
- **Two-Factor Authentication** - Secure 2FA login support
- **Forum** - Community discussion topics and posts
- **Notifications** - In-app notification system with read/unread tracking
- **Contact Form** - Direct email contact form

### For Admins
- **Admin Dashboard** - Overview with service stats, reservation count, user count, and recent activity
- **Hotels Management** - Full CRUD (create, read, update, delete) for hotels with star ratings and pricing
- **Flights Management** - Manage flights with airline, airports, times, duration, and pricing
- **Restaurants Management** - Manage restaurants with cuisine types, ratings, opening hours, and images
- **Activities Management** - Manage activities with categories, duration, pricing, and media
- **User Management** - Create, edit, and delete users with role assignment
- **Booking Management** - View and manage all user bookings

## Tech Stack

- **Framework**: Laravel 12
- **PHP**: 8.2+
- **Authentication**: Laravel Jetstream + Sanctum (with 2FA support)
- **Reactive Components**: Livewire 3
- **Database**: SQLite (default) / MySQL / PostgreSQL
- **ORM**: Eloquent with polymorphic relationships
- **Media**: Spatie Laravel Media Library for image handling
- **Frontend**: Blade Templates + Tailwind CSS 3 + Bootstrap 5
- **Charts**: Chart.js for dashboard analytics
- **Build Tool**: Vite 5
- **Icons**: Font Awesome 6

## Database Structure

### Core Tables
- **users** - User accounts with admin flag, role, 2FA fields, profile photo
- **hotels** - Hotel listings (name, city, country, star rating, price per night)
- **flights** - Flight listings (airline, airports, times, duration, price)
- **restaurants** - Restaurant listings (cuisine type, rating, opening hours, images)
- **activities** - Activity listings (category, location, duration, price)
- **vacation_rentals** - Rental properties (type, bedrooms, amenities, max guests)
- **cruises** - Cruise listings (cruise line, itinerary, dates, price)
- **rental_cars** - Car rental listings

### Booking & Social
- **reservations** - Polymorphic bookings for any service type (status: pending/confirmed)
- **bookings** - Activity-specific bookings
- **reviews** - Polymorphic reviews with ratings (1-5) for any service
- **forum_topics** - Community discussion topics
- **forum_posts** - Forum replies
- **notifications** - User notification system

## Getting Started

### Prerequisites

- PHP 8.2+
- Composer
- Node.js & NPM

### Installation

```bash
# Clone the repository
git clone https://github.com/KHADIJALAH/jetstream-app.git
cd jetstream-app

# Install PHP dependencies
composer install

# Install frontend dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Create SQLite database (or configure MySQL in .env)
touch database/database.sqlite

# Run migrations
php artisan migrate

# Seed the database with sample data
php artisan db:seed

# Build frontend assets
npm run build

# Start the development server
php artisan serve
```

Open [http://localhost:8000](http://localhost:8000) in your browser.

### Database Seeders

The project includes seeders for all services:
- Users, Hotels, Flights, Activities, Restaurants
- Vacation Rentals, Cruises, Rental Cars
- Forum Topics & Posts, Reservations, Reviews

### Admin Access

Register a user and set `is_admin = true` in the database, or use the seeded admin account.

## Project Structure

```
JetStream/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/                    # Admin CRUD controllers
│   │   │   ├── ActivityController.php
│   │   │   ├── BookingController.php
│   │   │   ├── FlightController.php
│   │   │   ├── HotelController.php
│   │   │   ├── RestaurantController.php
│   │   │   └── UserController.php
│   │   ├── HomeController.php        # Landing page
│   │   ├── AuthController.php        # Authentication
│   │   ├── HotelController.php       # Hotel browsing
│   │   ├── FlightController.php      # Flight search
│   │   ├── ActivityController.php    # Activity browsing
│   │   ├── RestaurantController.php  # Restaurant browsing
│   │   ├── ReservationController.php # User reservations
│   │   └── ...
│   ├── Models/
│   │   ├── User.php, Hotel.php, Flight.php
│   │   ├── Restaurant.php, Activity.php
│   │   ├── VacationRental.php, Cruise.php
│   │   ├── Reservation.php, Review.php
│   │   ├── ForumTopic.php, ForumPost.php
│   │   └── Notification.php
│   └── Livewire/                     # Livewire components
├── database/
│   ├── migrations/                   # 36 migration files
│   └── seeders/                      # 12 seeders for all models
├── resources/views/
│   ├── layouts/                      # App & admin layouts
│   ├── admin/                        # Admin panel views
│   ├── hotels/, flights/, activities/
│   ├── restaurants/, rentals/, cruises/
│   ├── reservations/, forum/, search/
│   ├── home.blade.php, about.blade.php
│   └── contact.blade.php
├── routes/web.php                    # All application routes
└── ...
```

## Routes Overview

| Section | Routes | Description |
|---------|--------|-------------|
| Public | `/`, `/hotels`, `/flights`, `/activities`, `/restaurants` | Browse services |
| Public | `/search`, `/about`, `/contact` | Search & info pages |
| Auth | `/login`, `/register`, `/logout` | User authentication |
| User | `/reservations`, `/notifications`, `/profile`, `/settings` | User dashboard |
| Admin | `/admin/dashboard` | Admin statistics overview |
| Admin | `/admin/hotels`, `/admin/flights`, `/admin/restaurants`, `/admin/activities` | Service CRUD |
| Admin | `/admin/users`, `/admin/bookings` | User & booking management |

## Author

**Khadija Lahlou** - [GitHub](https://github.com/KHADIJALAH)
