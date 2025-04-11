
<body class="container p-5">

    <h1 class="mb-4">Add New Expense</h1>
    <form action="public/add_expense_handler.php" method="post" class="mb-3">
        <div class="mb-3">
            <label for="amount" class="form-label">Amount:</label>
            <input type="number" step="0.01" name="amount" id="amount" required class="form-control">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category:</label>
            <input type="text" name="category" id="category" required class="form-control">
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date:</label>
            <input type="date" name="date" id="date" required class="form-control">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea name="description" id="description" required class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Expense</button>
    </form>
    <a href="index.php" class="btn btn-secondary">Back to Home</a>

</body>
</html>