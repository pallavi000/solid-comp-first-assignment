# Laravel Inertia Vue.js Project

This is a Laravel project configured with Inertia.js and Vue.js for the frontend, using SQLite as the database.

## Getting Started

Follow these instructions to get a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

Make sure you have the following installed on your system:

-   PHP
-   Composer
-   Node.js
-   npm

### Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/pallavi000/solid-comp-first-assignment.git
    ```

2. Navigate to the project directory:

    ```bash
    cd solid-comp-first-assignment
    ```

3. Install PHP dependencies:

    ```bash
    composer install
    ```

4. Install JavaScript dependencies:

    ```bash
    npm install
    ```

5. Compile assets:

    ```bash
    npm run build
    ```

6. Rename .env.example to .env

7. Generate application key:

    ```bash
    php artisan key:generate
    ```

8. Run database migrations:

    ```bash
    php artisan migrate
    ```

9. Start the development server:

    ```bash
    php artisan serve
    ```

    Your application should now be running at `http://127.0.0.1:8000`.

## Usage

### Authentication

The project includes authentication using Inertia.js and Vue.js frontend. You can register, login, and logout using the provided authentication pages.

### Middleware

#### IpRestriction

A middleware called `IpRestriction` has been created to intercept all requests to a route, such as `/restricted`. The middleware checks if the IP address of the request is allowed based on the `allowed_ip` column in the `users` table.

### Database Migration

A database migration has been implemented to add an `allowed_ip` column to the `users` table. This column holds the IP addresses that are allowed to access the `/restricted` route.

### Error Handling

If the IP address of the incoming request does not match any IP in the `allowed_ip` column, the middleware returns an error response with a 403 (forbidden) page. The error message states: "IP address not authorized".

### Success Page

If the inbound request's IP address features in the `allowed_ip` column, the request is successfully received by the controller function. The function initiates the return of a success page routed through Inertia.

## Built With

-   [Laravel](https://laravel.com/)
-   [Inertia.js](https://inertiajs.com/)
-   [Vue.js](https://vuejs.org/)
-   [SQLite](https://www.sqlite.org/index.html)

## Authors

-   [Bishnu Bhattarai](https://github.com/pallavi000)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
