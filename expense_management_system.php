<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "db_expense";
$conn = new mysqli($server, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Management</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    <style>
    /* General styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #f0f8ea; /* Light green background */
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #4CAF50;
        text-align: center;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"] {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    button[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }
</style>

    
    
<body>
<body>
    <div class="container">
        <h1>Expense Management System</h1>
        <form method="POST">
            <input type="text" name="description" placeholder="Expense name" required>
            <input type="number" name="amount" placeholder="Price" required>
            <input type="date" name="date" required>

            <button type="submit" name="add">Add Expense</button>
        </form>
    </div>

        <h2>Expenses</h2>
        <div id="expenses">
           <?php
            if (isset($_POST['add'])) {
                $description = $_POST['description'];
                $amount = $_POST['amount'];
                $date= $_POST['date'];
                $sql = "INSERT INTO expense_tbl (description, amount, date) VALUES ('$description', '$amount' ,'$date')";
                $conn->query($sql);
            }

            if (isset($_POST['update'])) {
                $id = $_POST['id'];
                $description = $_POST['description'];
                $amount = $_POST['amount'];
                $date= $_POST['date'];
                $sql = "UPDATE expense_tbl SET description='$description', amount='$amount' , date='$date' WHERE id=$id";
                $conn->query($sql);
            }

            if (isset($_POST['delete'])) {
                $id = $_POST['id'];
                $sql = "DELETE FROM expense_tbl WHERE id=$id";
                $conn->query($sql);
            }


            $sql = "SELECT * FROM expense_tbl";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='expense'>";
echo "<p>{$row['description']} - {$row['amount']}</p>";
echo "<form method='POST'>";
echo "<input type='hidden' name='id' value='{$row['id']}'>"; 
echo "<input type='text' name='description' value='{$row['description']}'>";
echo "<input type='number' name='amount' value='{$row['amount']}'>";
echo "<input type='date' name='date' value='{$row['date']}'>";
echo "<button type='submit' name='update'>Update</button>";
echo "<button type='submit' name='delete'>Delete</button>";
echo "</form>";
echo "</div>";

                    echo "</div>";
                }
            } else {
                echo "No expenses yet.";
            }
            ?>
        </div>
    </div>
</body>
</html>
