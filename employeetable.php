<?php
session_start();

// Redirect to login if not logged in
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
<nav>
    <div>
        <h1>
            <span style='color: #a0bf39;'><?= $greeting ?>,</span>
            <span style='color: #4b556b;'><?= ucfirst($_SESSION['username']) ?></span>
        </h1>
    </div>
    <div>
        <a id='create' href='create.php'><i class="fa-solid fa-plus"></i> Add Employee</a>
        <a id="manage" href="manage.php"><i class="fa-solid fa-user"></i> Account</a>
        <a id="logout" href='logout.php' onclick="return confirmLogout()"><i class="fa-solid fa-power-off"></i>
            Logout</a>
    </div>
</nav>


<div class="table">
    <input type='text' id='searchInput' onkeyup='searchTable()' placeholder='Search for anything in the table...'>
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

<div class="pagination">
    <?php
    $previous = $page - 1;
    $next = $page + 1;
    $pagination_value = $_SESSION['pagination-value'];

    if ($page > 1) {
        echo "<a href='employeetable.php?page=$previous&pagination-value=$pagination_value'>Previous</a>";
    } else {
        echo "<a href='#'>Previous</a>";
    }

    for ($i = 1; $i <= $pages; $i++) {
        if ($i == $page) {
            echo "<a href='employeetable.php?page=$i&pagination-value=$pagination_value' class='active'>$i</a> ";
        } else {
            echo "<a href='employeetable.php?page=$i&pagination-value=$pagination_value'>$i</a> ";
        }
    }

    if ($page < $pages) {
        echo "<a href='employeetable.php?page=$next&pagination-value=$pagination_value'>Next</a>";
    } else {
        echo "<a href='#'>Next</a>";
    }
    ?>
    <form action="employeetable.php" method="get">
        <select name="pagination-value" id="pagination-value">
            <?php
            foreach ([10, 20, 30, 40, 50] as $value) {
                $selected = ($value == $pagination_value) ? "selected" : "";
                echo "<option value='" . $value . "' $selected>" . $value . " Rows</option>";
            }
            ?>
        </select>
        <noscript><input type="submit" value="Apply"></noscript>
    </form>
</div>


<div class="footer">
    <p class="footer-text">&copy; Justin Leideritz</p>
</div>

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

    const allRecords = <?= json_encode($allRecords) ?>;

    function searchTable() {
        let input = document.getElementById("searchInput").value.toUpperCase();
        let table = document.getElementById("employeeTable");
        let tbody = table.getElementsByTagName("tbody")[0];
        tbody.innerHTML = '';

        allRecords.forEach(record => {
            let showRow = false;
            for (let key in record) {
                if (record[key].toString().toUpperCase().includes(input)) {
                    showRow = true;
                    break;
                }
            }
            if (showRow) {
                let row = tbody.insertRow();
                row.insertCell(0).innerText = record.EMP_ID;
                row.insertCell(1).innerText = record.EMP_Firstname;
                row.insertCell(2).innerText = record.EMP_Lastname;
                row.insertCell(3).innerText = record.EMP_Email;
                row.insertCell(4).innerText = record.EMP_Phone;
                row.insertCell(5).innerText = record.EMP_Address;
                row.insertCell(6).innerText = record.EMP_Birthdate;
                row.insertCell(7).innerText = record.EMP_Description;
                row.insertCell(8).innerHTML = `<a href='update.php?id=${record.EMP_ID}'><i id='edit' class='fa-solid fa-pen-to-square'></i></a>`;
                row.insertCell(9).innerHTML = `<a href='delete.php?id=${record.EMP_ID}' onclick='return confirmDelete()'><i id='delete' class='fa-solid fa-trash'></i></a>`;
                row.insertCell(10).innerText = record.EMP_DateAdded;
            }
        });
    }

    document.getElementById('pagination-value').addEventListener('change', function () {
        this.form.submit();
    });
</script>
</body>

</html>
