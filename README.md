# Catering Marketplace Application

## Overview

The Catering Marketplace Application is a platform designed to connect customers with catering services. It supports different roles including Admin, Customer, and Merchant, each with specific functionalities.

## Roles

- **Admin**: Manages the overall application, including users, merchants, and settings.
- **Customer**: Browses and orders catering services.
- **Merchant**: Provides catering services and manages their own offerings.

## Features

- **Role-based access**: Different features and access levels for Admin, Customer, and Merchant.
- **Order management**: Customers can place orders and merchants can manage their offerings.
- **Payment methods**: Supports various payment methods for transactions.
- **File Upload**: Allows merchants to upload images for their offerings.

## Installation

### Prerequisites

- PHP 8.0 or higher
- Composer
- MySQL or MariaDB
- Node.js and npm
- Laravel 10

### Steps

1. **Clone the repository**

   ```bash
   git clone <repository-url>
   cd <repository-directory>

1.  **Install dependencies**

    `composer install
    npm install`

2.  **Set up environment file**

    Copy the `.env.example` file to `.env` and configure your environment settings:

    `cp .env.example .env`

    Update the `.env` file with your database and other settings.

3.  **Generate application key**

    `php artisan key:generate`

4.  **Run database migrations and seeders**

    `php artisan migrate
    php artisan db:seed`

5.  **Build frontend assets**

    `npm run dev`

6.  **Start the local development server**

    `php artisan serve`

Usage
-----

### Login Credentials

-   **Merchant**

    -   **Username**: merchant
    -   **Password**: password
-   **Customer**

    -   **Username**: customer
    -   **Password**: password

### Accessing the Application

Once the server is running, you can access the application via `http://localhost:8000` in your web browser.

### Navigating the Application

-   **Admin**: Log in with Admin credentials to manage users, merchants, and application settings.
-   **Customer**: Log in to browse and order catering services.
-   **Merchant**: Log in to manage your catering offerings and view orders.

Contributing
------------

If you would like to contribute to this project, please follow these steps:

1.  Fork the repository.
2.  Create a new branch (`git checkout -b feature-branch`).
3.  Make your changes.
4.  Commit your changes (`git commit -am 'Add new feature'`).
5.  Push to the branch (`git push origin feature-branch`).
6.  Create a new Pull Request.

License
-------

This project is licensed under the MIT License - see the LICENSE file for details.

Contact
-------

For any questions or issues, please contact your-email@example.com.

 `Anda dapat mengganti `<repository-url>`, `<repository-directory>`, dan `your-email@example.com``
