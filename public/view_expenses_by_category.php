<?php
require_once __DIR__ . '/../vendor/autoload.php';
use ExpenseTracker\ExpenseManager;
$expenseManager = new ExpenseManager();
$totalsPerCategory = $expenseManager->getTotalExpensesPerCategory();
?>

<h2>Total Expenses by Category</h2>
<?php if ($totalsPerCategory): ?>

<div style="width: 400px; height: 400px;">
    <canvas id="expensesChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('expensesChart').getContext('2d');
    var categories = <?= json_encode(array_column($totalsPerCategory, 'category')) ?>;
    var totals = <?= json_encode(array_column($totalsPerCategory, 'total_amount')) ?>;
</script>
<script src="/expense-tracker/assets/js/expense-chart.js"></script>
<?php else: ?>
<p>No expenses recorded yet.</p>
<?php endif; ?>