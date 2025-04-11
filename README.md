# Expense Tracker

Expense Tracker is a PHP-based application that enables users to manage their expenses effectively. The application allows users to add, view, filter, and categorize expenses. It also features automatic database and table creation, ensuring an easy setup.

## Features

- **Add Expenses**: Log expenses with details like amount, category, date, and description.
- **View Expenses**: Browse through recorded expenses.
- **Filter Expenses**: Apply filters based on category, date range, and more.
- **Expense Summaries**: View total expenses grouped by category.

## Requirements

- PHP 8.0.30 or higher
- MySQL 5.7 or higher
- Composer

## Installation

### 1. Clone the Repository

```bash
git clone git clone https://github.com/UmairAshrf/expense-tracker.git
cd expense-tracker
```

### 2. Install Dependencies
Run Composer to install the necessary dependencies:

```bash
composer install
```
### 3. Environment Configuration
Create a .env file from the .env.example provided

Edit the .env file with your database credentials and any other configurations:

```bash
DB_HOST=localhost
DB_NAME=expense_tracker
DB_USER=your_username
DB_PASSWORD=your_password
```

### 4. Access the Application
 The application initializes the database and table structure automatically when first run.

## Testing Environment Setup
For setting up a testing environment, create a separate test database called **test_expense_tracker**, and run the following SQL script to create an expenses table:

```sql
CREATE TABLE expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    amount DECIMAL(10,2) NOT NULL,
    category VARCHAR(50) NOT NULL,
    date DATE NOT NULL,
    description TEXT
);
``` 

Configure your test database details in the DatabaseManagerTest.php file.

Running Tests
Execute PHPUnit tests by navigating to the project root and running:

```bash

./vendor/bin/phpunit tests
```

Ensure all tests are correctly set up and executed.