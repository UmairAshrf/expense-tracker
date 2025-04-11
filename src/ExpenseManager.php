<?php
namespace ExpenseTracker;
use PDO;

/**
 * Manages the operations related to expenses in the Expense Tracker application.
 *
 * This class extends the DatabaseManager to utilize its database handling capabilities
 * for performing operations related to expenses such as adding, retrieving, and filtering expenses.
 */
class ExpenseManager extends DatabaseManager {

    /**
     * Adds a new expense to the database.
     *
     * @param float $amount The amount of the expense.
     * @param string $category The category of the expense.
     * @param string $date The date of the expense in YYYY-MM-DD format.
     * @param string $description A description of the expense.
     * @return int Returns the ID of the newly added expense record.
     */

    public function addExpense($amount, $category, $date, $description) {
        $sql = "INSERT INTO expenses (amount, category, date, description) VALUES (?, ?, ?, ?)";
        $this->query($sql, [$amount, $category, $date, $description]);
        return $this->pdo->lastInsertId();
    }

    /**
     * Retrieves all expenses from the database ordered by date descending.
     *
     * @return array An array of all expenses fetched from the database.
     */
    public function getAllExpenses() {
        $sql = "SELECT * FROM expenses ORDER BY date DESC";
        $stmt = $this->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves a filtered list of expenses based on category, start date, and end date.
     *
     * @param string|null $category The category to filter by.
     * @param string|null $startDate The start date of the expense period.
     * @param string|null $endDate The end date of the expense period.
     * @param int $page The page number for pagination.
     * @param int $perPage The number of items per page.
     * @return array An array of filtered expenses.
     */
    public function getFilteredExpenses($category = null, $startDate = null, $endDate = null, $page = 1, $perPage = 10) {
        $sql = "SELECT * FROM expenses WHERE 1=1";
        $params = [];
        if ($category) {
            $sql .= " AND category = ?";
            $params[] = $category;
        }
        if ($startDate && $endDate) {
            $sql .= " AND date BETWEEN ? AND ?";
            $params[] = $startDate;
            $params[] = $endDate;
        }
    
        $start = ($page - 1) * $perPage;
        $sql .= " ORDER BY date DESC LIMIT $start, $perPage";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Counts the number of expenses that match the specified filters.
     *
     * @param string|null $category The category to filter by.
     * @param string|null $startDate The start date for filtering.
     * @param string|null $endDate The end date for filtering.
     * @return int The count of filtered expenses.
     */
    public function countFilteredExpenses($category = null, $startDate = null, $endDate = null) {
        $sql = "SELECT COUNT(*) FROM expenses WHERE 1=1";
        $params = [];
        if ($category) {
            $sql .= " AND category = ?";
            $params[] = $category;
        }
        if ($startDate && $endDate) {
            $sql .= " AND date BETWEEN ? AND ?";
            $params[] = $startDate;
            $params[] = $endDate;
        }
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    /**
     * Retrieves the total expenses per category, summed up and grouped by category.
     *
     * @return array An associative array where each key is a category and each value is the total amount spent in that category.
     */
    public function getTotalExpensesPerCategory() {
        $sql = "SELECT category, SUM(amount) AS total_amount FROM expenses GROUP BY category ORDER BY total_amount DESC";
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

}