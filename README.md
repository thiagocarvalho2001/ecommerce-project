# E-commerce Project

This is a robust e-commerce application built with Laravel, designed to provide a comprehensive online shopping experience. It features product management, user authentication, a shopping cart system, and order processing capabilities.

## ✨ Features

* **User Authentication**: Secure user registration, login, and password management.
* **Product Management**: Add, edit, delete, and view products with details and images.
* **Product Catalog**: Browse products by categories and apply filters.
* **Shopping Cart**: Add, update, and remove items from the shopping cart.
* **Checkout Process**: Streamlined checkout flow for placing orders.
* **Order Management**: Track and manage user orders.
* **Responsive Design**: Built with Tailwind CSS for a mobile-first, responsive user interface.

## 🚀 Technologies Used

* **Backend**:
    * [Laravel](https://laravel.com/) (PHP Framework)
    * [PHP](https://www.php.net/)
    * [Composer](https://getcomposer.org/) (PHP Dependency Manager)
    * [Prisma](https://www.prisma.io/) (If used as ORM - *based on previous context, otherwise this might be Eloquent*)
    * [PostgreSQL](https://www.postgresql.org/) (Database - implied by typical Laravel setups and `postgres.config.js` if it existed, otherwise can be MySQL)
* **Frontend**:
    * [Blade](https://laravel.com/docs/blade) (Templating Engine)
    * [JavaScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
    * [Tailwind CSS](https://tailwindcss.com/) (CSS Framework)
    * [Vite](https://vitejs.dev/) (Frontend Build Tool)
    * [npm](https://www.npmjs.com/) / [Yarn](https://yarnpkg.com/) (JavaScript Package Manager)
* **Development Environment**:
    * [Laravel Sail](https://laravel.com/docs/sail) (Docker-based local development environment)
    * [Docker](https://www.docker.com/)

## ⚡️ Requirements

Before you begin, ensure you have the following installed on your machine:

* **Docker & Docker Compose**: Essential for using Laravel Sail.
* **Git**: For cloning the repository.

## 📦 Installation

Follow these steps to get your development environment up and running:

1.  **Clone the repository:**
    ```bash
    git clone [https://github.com/your-username/ecommerce-project.git](https://github.com/your-username/ecommerce-project.git)
    cd ecommerce-project
    ```
    (Replace `your-username/ecommerce-project.git` with your actual repository URL)

2.  **Install PHP dependencies using Composer via Sail:**
    ```bash
    ./vendor/bin/sail composer install
    ```
    If `vendor` directory is not present, run:
    ```bash
    docker run --rm \
        -v "$(pwd)":/opt \
        -w /opt \
        laravelsail/php8.2-composer:latest \
        composer install --ignore-platform-reqs
    ```

3.  **Copy the environment file:**
    ```bash
    cp .env.example .env
    ```

4.  **Configure your `.env` file:**
    * Open `.env` and set your database credentials. If using Sail, the default `DB_HOST` will be `mysql` or `pgsql` (depending on your Sail setup), `DB_DATABASE=laravel`, `DB_USERNAME=sail`, `DB_PASSWORD=password`.
    * Adjust other variables as needed (e.g., mail settings, API keys).

5.  **Generate application key:**
    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

6.  **Run database migrations:**
    ```bash
    ./vendor/bin/sail artisan migrate
    ```

7.  **Install Node.js dependencies:**
    ```bash
    ./vendor/bin/sail npm install
    # OR if you prefer yarn
    # ./vendor/bin/sail yarn
    ```

8.  **Build frontend assets:**
    ```bash
    ./vendor/bin/sail npm run build
    # OR for development with hot-reloading
    # ./vendor/bin/sail npm run dev
    ```

## ▶️ Running the Application

To start the development server using Laravel Sail:

```bash
./vendor/bin/sail up
