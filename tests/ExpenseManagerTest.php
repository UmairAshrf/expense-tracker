<?php
use PHPUnit\Framework\TestCase;
use ExpenseTracker\ExpenseManager;

class ExpenseManagerTest extends TestCase
{
    private $dbManager;

    protected function setUp(): void
    {
        $this->dbManager = new ExpenseManager(new PDO('mysql:host=localhost;dbname=test_expense_tracker', 'root', ''));
        // Clean up the expenses table before each test
        $this->dbManager->query('DELETE FROM expenses');
    }

    public function testAddExpense()
    {
        $lastId = $this->dbManager->addExpense(100, 'Food', '2024-10-01', 'Lunch with colleagues');
        $this->assertGreaterThan(0, $lastId);

        $result = $this->dbManager->getAllExpenses();
        $this->assertCount(1, $result);
        $this->assertEquals('Food', $result[0]['category']);
    }

    public function testGetAllExpenses()
    {
        $this->dbManager->addExpense(50, 'Transport', '2024-10-02', 'Bus ticket');
        $this->dbManager->addExpense(30, 'Food', '2024-10-03', 'Coffee');

        $expenses = $this->dbManager->getAllExpenses();
        $this->assertCount(2, $expenses);
    }

    public function testGetFilteredExpenses()
    {
        $this->dbManager->addExpense(20, 'Books', '2024-10-05', 'Tech Book');
        $this->dbManager->addExpense(100, 'Food', '2024-10-06', 'Restaurant');

        $filteredExpenses = $this->dbManager->getFilteredExpenses('Food', '2024-10-01', '2024-10-07', 1, 10);
        $this->assertCount(1, $filteredExpenses);
        $this->assertEquals(100, $filteredExpenses[0]['amount']);
    }

    public function testGetTotalExpensesPerCategory()
    {
        $this->dbManager->addExpense(100, 'Food', '2024-10-06', 'Restaurant');
        $this->dbManager->addExpense(40, 'Food', '2024-10-07', 'Fast Food');

        $totals = $this->dbManager->getTotalExpensesPerCategory();
        $this->assertEquals(140, $totals[0]['total_amount']);
    }
}