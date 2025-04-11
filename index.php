<?php

include './views/header.php'; 
$path = trim($_GET['url'] ?? '', '/');
$parts = explode('/', $path);

$page = $parts[0] ?? '';

//  basic routing implementation 
switch ($page) {
    case '':
    case 'home':
        // Showing the home page links
        ?>
        <div class="mt-4">
            <a href="?url=add_expense" class="btn btn-primary">Add New Expense</a>
            <a href="?url=view_expenses" class="btn btn-secondary">View Expenses</a>
            <a href="?url=view_expenses_by_category" class="btn btn-info">View Total Expenses by Category</a>
        </div>
        <?php
        break;
    case 'add_expense':
        include './public/add_expense.php';
        break;
    case 'view_expenses':
        include './public/view_expenses.php';
        break;
    case 'view_expenses_by_category':
        include './public/view_expenses_by_category.php';
        break;
    default:
        
        echo '<p>Page not found</p>';
        break;
}

include './views/footer.php'; 
?>