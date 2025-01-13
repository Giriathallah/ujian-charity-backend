# How to Run the Project

Follow the steps below to set up and run the project:

### 1. Create the Database
- Open **MySQL** using your preferred tool (e.g., phpMyAdmin).
- Create a new database named `bantuin-laravel`.
- Ensure your **MySQL server** is running in **XAMPP**.

### 2. Run Database Migrations
Open your terminal in the project directory and run the following command:
```bash
php artisan migrate
```

### 3. Seed the Donations Table
To seed the donations table, run the command:
```bash
php artisan db:seed --class=DonationsSeeder
```

### 4. Seed Additional Data
If you need to seed all data defined in the `DatabaseSeeder`, run:
```bash
php artisan db:seed --class=DatabaseSeeder
```

### 5. Start the Development Server
Finally, start the development server by running:
```bash
php artisan serve
```

The project will be accessible at the URL displayed in the terminal (e.g., `http://127.0.0.1:8000`).

