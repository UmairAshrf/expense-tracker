<?php 
require_once __DIR__ . '/../vendor/autoload.php';
use ExpenseTracker\ExpenseManager;
$expenseManager = new ExpenseManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    $expenseManager->addExpense($amount, $category, $date, $description);
    header("Location: ../index.php?url=view_expenses"); // Redirect to view expenses page after adding
} else {
    header("Location: ../index.php?url=add_expense"); // Redirect back if not a POST request
}
?>