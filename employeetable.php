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
    session_start();

    // Hier wordt gekeken of er al was ingelogd anders wordt je gestuurd naar het login scherm
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: index.php");
        exit;
    }

    //Verschillende berichten worden weergegeven op basis van tijd
    $current_hour = date('H');
    if ($current_hour > 5 && $current_hour < 12) {
        $greeting = "Good morning";
    } elseif ($current_hour >= 12 && $current_hour < 18) {
        $greeting = "Good afternoon";
    } else {
        $greeting = "Good evening";
    }
    ?>

    <nav>
        <div>
            <?php
            echo "<h1><span style='color: #a0bf39;'>" . $greeting . ",</span> <span style='color: #4b556b;'>" . ucfirst($_SESSION['username']) . "</span></h1>";
            ?>
        </div>
        <div>
            <a id='create' href='create.php'>Add Employee</a>
            <a id="logout" href='logout.php'>Logout</a>
        </div>
    </nav>
    <?php
    require "dbcon.php";

    //Tabel wordt gemaakt
    echo '<div class="table">';
    echo "<table>";
    echo "<input type='text' id='searchInput' onkeyup='searchTable()' placeholder='Search for anything in the table...'>";
    echo "<table id='employeeTable'>";
    echo "<thead>";
    echo "<tr class='table-header'>";
    echo "<th>ID</th> <th>First name</th> <th>Last name</th> <th>Email</th> <th>Phone</th>  <th>Address</th> <th>Birthdate<br>(Y/M/D)</th> <th>Description</th> <th>Edit</th> <th>Delete</th> <th>Created at<br>(Y/M/D)</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($sqlTable as $row) {
        echo "<tr>";
        echo "<td>" . $row["EMP_ID"] . "</td>";
        echo "<td>" . $row["EMP_Firstname"] . "</td>";
        echo "<td>" . $row["EMP_Lastname"] . "</td>";
        echo "<td>" . $row["EMP_Email"] . "</td>";
        echo "<td>" . $row["EMP_Phone"] . "</td>";
        echo "<td>" . $row["EMP_Address"] . "</td>";
        echo "<td>" . $row["EMP_Birthdate"] . "</td>";
        echo "<td>" . $row["EMP_Description"] . "</td>";

        echo "<td><a href='update.php?id=" . $row["EMP_ID"] . "'><i id='edit' class='fa-solid fa-pen-to-square'></i></a></td>";
        echo "<td><a href='delete.php?id=" . $row["EMP_ID"] . "'onclick='return confirmDelete()'><i id='delete' class='fa-solid fa-trash'></i></a></td>";
        echo "<td>" . $row["EMP_DateAdded"] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</table>";
    ?>
    <div class="footer">
        <p class="footer-text">
            &copy; Justin Leideritz
        </p>
    </div>

    <script>
        //Bevestiging voor het verwijderen van een record
        function confirmDelete() {
            return confirm("Are you sure you want to delete this row?");
        }

        //Zoekbalk
        function searchTable() {
            let input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("employeeTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                for (var j = 0; j < td.length; j++) {
                    var cell = td[j];
                    if (cell) {
                        txtValue = cell.textContent || cell.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        }
    </script>

</body>

</html>