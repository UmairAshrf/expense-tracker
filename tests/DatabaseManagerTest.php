<?php
use PHPUnit\Framework\TestCase;


class DatabaseManagerTest extends TestCase
{
    private $db;

    protected function setUp(): void
    {
        $this->db = new PDO('mysql:host=localhost;dbname=test_expense_tracker', 'root', '');
    }

    public function testInsertExpense()
    {
        $stmt = $this->db->prepare("INSERT INTO expenses (amount, category, date, description) VALUES (?, ?, ?, ?)");
        $result = $stmt->execute([100, 'Food', '2025-04-01', 'Lunch']);
        $this->assertTrue($result);
    }
}