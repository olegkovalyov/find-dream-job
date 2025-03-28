# Find dream job - Laravel 12 Demo Project

## Overview
This project is a mini Upwork-like application built with Laravel 12. It serves as a demonstration of my Laravel skills, showcasing job publishing, application functionality, authentication, and API integrations.

## Features
- User authentication (Login, Logout, Registration)
- Users can publish jobs and apply to other users' jobs
- Search functionality for jobs
- Mapbox API integration for location-based job features

## Technical Features
This project demonstrates the following Laravel concepts:
- Dependency Injection (DI) container and service binding through interfaces
- Database migrations for schema management
- Request objects for clean input handling
- Validation for form submissions
- Database seeding for test data population
- Integration with Mapbox API for location services
- Cloud deployment using CI/CD pipeline

## Demo URL
The application is deployed and accessible at:
[Find Dream Job Demo](https://find-dream-job-main-75laxz.laravel.cloud/)

## Local Setup Instructions

### Prerequisites
Ensure you have the following installed:
- PHP >= 8.2
- Composer
- Laravel 12
- MySQL or PostgreSQL
- Node.js & NPM (for frontend dependencies)

### Steps
1. **Clone the repository**
   ```sh
   git clone https://github.com/yourusername/mini-upwork.git
   cd mini-upwork
   ```
2. **Install dependencies**
   ```sh
   composer install
   npm install
   ```
3. **Set up environment**
   ```sh
   cp .env.example .env
   ```
    - Configure database settings in `.env`
    - Generate application key:
      ```sh
      php artisan key:generate
      ```
4. **Run migrations and seed database**
   ```sh
   php artisan migrate --seed
   ```
5. **Serve the application**
   ```sh
   php artisan serve
   ```
   Open `http://127.0.0.1:8000` in your browser.

## License
This project is open-source and available under the MIT License.

