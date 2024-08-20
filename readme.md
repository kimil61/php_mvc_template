
# PHP MVC Minimal Template

This is a minimal PHP application built on an MVC structure, enhanced with routing capabilities. The views are rendered using the Twig templating engine. This setup is designed to be lightweight and efficient, focusing on simplicity and maintainability.

## 1. Environment Configuration

To set up the application, you need to create a `.env` file in the root directory of your project. The `.env` file should contain the following environment variables:

```plaintext
DB_HOST=localhost
DB_PORT=3306
DB_NAME=mydb
DB_USER=myuser
DB_PASS=myuser
```

These variables configure the database connection settings. Ensure you replace the placeholders with your actual database details.

## 2. Composer Dependencies

This project relies on several PHP packages managed via Composer. To install these dependencies, run the following command in the root directory of the project:

```bash
composer install
```

The key dependencies include:

- `twig/twig`: Used for rendering views.
- `vlucas/phpdotenv`: Loads environment variables from the `.env` file.

## 3. Database Setup

The project requires a MySQL database. You can set it up by importing the `mydb.sql` file, which contains the necessary database schema and seed data. To import the SQL file, use the following command:

```bash
mysql -u [username] -p[password] mydb < path/to/mydb.sql
```

Replace `[username]` and `[password]` with your MySQL credentials. Ensure the `mydb` database exists or modify the SQL script to create the database.

## 4. Nginx Configuration

The application is designed to be served through Nginx. Configure your Nginx server block to point to the `public/index.php` file as the entry point. Below is a sample Nginx configuration:

```nginx
server {
    listen 80;
    server_name localhost;

    root /path/your/myweb/public; # 웹 파일이 위치한 디렉토리로 변경
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass   127.0.0.1:9000; # PHP-FPM address,port
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include        fastcgi_params;
    }
}

```

Make sure to adjust the paths and PHP version according to your setup.

## 5. Error Reporting Configuration

In `public/index.php`, the error reporting is currently set to display all errors, which is useful during development:

```php
ini_set('display_errors', 1);
```

Before deploying to production, it's recommended to turn off error display and log errors instead. You can do this by updating the `ini_set` function:

```php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error.log');
```

## 6. Additional Notes

- **Routing**: The `routes.php` file handles the routing of requests to the appropriate controllers. Make sure to review and customize it according to your application's needs.
- **Controllers and Models**: The `UserController.php` and `User.php` files in the `src` directory demonstrate basic MVC principles. Extend these to add more functionality.
- **Autoloading**: The project uses PSR-4 autoloading, as configured in `composer.json`, to automatically load classes from the `src` directory.

## 7. Testing

To test the setup, ensure your database is configured, and then visit the application in your web browser. If everything is set up correctly, you should see the application running.

---
