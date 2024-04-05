## ToDo Planning Case

This project will handle User Subscription Management with API and auto renew with command.

## Code Philosophy

In this project, I've focused on readability, cleanliness, and maintainability. The application follows the principles
of **SOLID**, **KISS (Keep It Simple, Stupid)** and **DRY (Don't Repeat Yourself)**. While the project is small, I've opted for
simplicity and a bit over-engineering.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing
purposes.

### Prerequisites

Before you begin, ensure you have the following requirements:

- [Composer](https://getcomposer.org/)
- [PHP 8.2](https://www.php.net/releases/8.2/en.php)
- [Node.js](https://nodejs.org/en/download/current)
- [Homebrew](https://brew.sh/)(optional)
- [Laravel Valet](https://laravel.com/docs/11.x/valet)(optional)

1. Clone Repository from Github:

    ```bash
    git clone https://github.com/bugrasercanseker/user-subscription.git user-subscription
    ```

2. Change into the project directory:

    ```bash
    cd user-subscription
    ```

3. Install PHP:

    ```bash
    composer install

4. Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env

5. Update database keys file to `.env`:

    ```bash
    DB_CONNECTION=mysql
    DB_DATABASE=user_subscription
    DB_USERNAME=<username>
    DB_PASSWORD=<password>
   ```

6. Generate the application key:

    ```bash
    php artisan key:generate
    ```

7. Run the database migrations and seeders:

    ```bash
    php artisan migrate --seed
    ```
8. Run Renew Subscription command:

    ```bash
    php artisan renew:subscription

9. Start the development server with Artisan or Valet:

    ```bash
    php artisan serve
    ```

or if you are using Valet

  ```bash
 valet link user-subscription
 ```
11. Visit [http://127.0.0.1:8000](http://127.0.0.1:8000) or [http://user-subscription.test](http://user-subscription.test) with
    your browser to make sure everything is up and running.

### Imagine the case
![CatIT](https://cdn.leonardo.ai/users/4087294c-abac-440c-8090-47e1123d5735/generations/dfa9d1b3-c2b6-4bef-9b95-772123f37034/Default_Stray_cat_sitting_and_using_computer_to_pay_her_bills_0.jpg)
ITCat managing subscriptions
