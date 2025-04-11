<?php 
require_once __DIR__ . '/../vendor/autoload.php';
use ExpenseTracker\ExpenseManager;

$expenseManager = new ExpenseManager();
$category = $_GET['category'] ?? null;
$startDate = $_GET['start_date'] ?? null;
$endDate = $_GET['end_date'] ?? null;
$currentPage = $_GET['page'] ?? 1;
$perPage = 10;

$totalExpenses = $expenseManager->countFilteredExpenses($category, $startDate, $endDate);
$totalPages = ceil($totalExpenses / $perPage);

$expenses = $expenseManager->getFilteredExpenses($category, $startDate, $endDate, $currentPage, $perPage);

?>

<!-- Filters  -->
<form action="index.php" method="get" class="mt-4">
    <div class="row">
        <input name="url" type="hidden" value="view_expenses"/>
        <!-- Category Filter -->
        <div class="col-md-3">
            <label for="category" class="form-label">Filter by Category:</label>
            <input type="text" name="category" id="category" class="form-control" value="<?= htmlspecialchars($category) ?>">
        </div>

        <!-- Start Date Filter -->
        <div class="col-md-3">
            <label for="start_date" class="form-label">Start Date:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="<?= $startDate ?>">
        </div>

        <!-- End Date Filter -->
        <div class="col-md-3">
            <label for="end_date" class="form-label">End Date:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="<?= $endDate ?>">
        </div>

        <!-- Submit Button -->
        <div class="col-md-3 d-flex justify-content-start align-items-end "> 
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="?url=add_expense" class="btn btn-primary ms-2">Add New Expense</a>
            
        </div>
        
    </div>
</form>

<!-- Expenses Table -->
<table class="table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Category</th>
            <th>Amount</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($expenses as $expense): ?>
            <tr>
                <td><?= $expense['date'] ?></td>
                <td><?= $expense['category'] ?></td>
                <td>£<?= $expense['amount'] ?></td>
                <td><?= $expense['description'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Pagination -->
<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"><?= $i ?></a>
        </li>
        <?php endfor; ?>
    </ul>
</nav>