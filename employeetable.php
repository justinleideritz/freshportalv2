<?php
global $conn;
session_start();

// Redirect to log in if not logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

// Set greeting based on time
$current_hour = date('H');
if ($current_hour > 5 && $current_hour < 12) {
    $greeting = "Good morning";
} elseif ($current_hour >= 12 && $current_hour < 18) {
    $greeting = "Good afternoon";
} else {
    $greeting = "Good evening";
}

// Set pagination value
if (isset($_GET['pagination-value'])) {
    $_SESSION['pagination-value'] = $_GET['pagination-value'];
} elseif (!isset($_SESSION['pagination-value'])) {
    $_SESSION['pagination-value'] = 10; // Default value
}
$limit = $_SESSION['pagination-value'];
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$start = ($page - 1) * $limit;

require "dbcon.php";

// Fetch the records
$sqlQuery = "SELECT * FROM employee LIMIT :start, :limit";
$stmt = $conn->prepare($sqlQuery);
$stmt->bindParam(':start', $start, PDO::PARAM_INT);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch the total number of records
$sqlCountQuery = "SELECT count(EMP_ID) AS id FROM employee";
$countStmt = $conn->query($sqlCountQuery);
$total = $countStmt->fetch(PDO::FETCH_ASSOC)['id'];
$pages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freshportal | Table</title>
    <link rel="stylesheet" href="./styles/employeetable.css">
    <script src="https://kit.fontawesome.com/56f09bada5.js" crossorigin="anonymous"></script>
</head>

<body>
<?php
require 'components/main-navbar.php'
?>

<div class="table">
    <table id='employeeTable'>
        <thead>
        <tr class='table-header'>
            <th>ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Birthdate<br>(Y/M/D)</th>
            <th>Description</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Created at<br>(Y/M/D)</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($records as $row) {
            echo "<tr>";
            echo "<td>{$row['EMP_ID']}</td>";
            echo "<td>{$row['EMP_Firstname']}</td>";
            echo "<td>{$row['EMP_Lastname']}</td>";
            echo "<td>{$row['EMP_Email']}</td>";
            echo "<td>{$row['EMP_Phone']}</td>";
            echo "<td>{$row['EMP_Address']}</td>";
            echo "<td>{$row['EMP_Birthdate']}</td>";
            echo "<td>{$row['EMP_Description']}</td>";
            echo "<td><a href='update.php?id={$row['EMP_ID']}'><i id='edit' class='fa-solid fa-pen-to-square'></i></a></td>";
            echo "<td><a href='delete.php?id={$row['EMP_ID']}' onclick='return confirmDelete()'><i id='delete' class='fa-solid fa-trash'></i></a></td>";
            echo "<td>{$row['EMP_DateAdded']}</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php
require 'components/footer.php';
?>

<?php
// Fetch all records for client-side search
$sqlQueryAll = "SELECT * FROM employee";
$stmtAll = $conn->query($sqlQueryAll);
$allRecords = $stmtAll->fetchAll(PDO::FETCH_ASSOC);
?>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this row?");
    }

    function confirmLogout() {
        return confirm("Are you sure you want to logout?");
    }

    document.getElementById('pagination-value').addEventListener('change', function () {
        this.form.submit();
    });
</script>
</body>

</html>
