<?php
require './dbcon.php';
// Fetch all records for client-side search
$sqlQueryAll = "SELECT * FROM employee";
$stmtAll = $conn->query($sqlQueryAll);
$allRecords = $stmtAll->fetchAll(PDO::FETCH_ASSOC);

?>

<!--STYLING-->
<style>
    input[type="text"] {
        margin: 20px 0px;
        display: inline-block;
        text-decoration: none;
        width: 40%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        border-color: #4b556b;
        border-width: 2px;
        box-shadow: 8px 8px 5px rgba(0, 0, 0, 0.1);
    }
</style>

<!--HTML-->
<input type='text' id='searchInput' onkeyup='searchTable()' placeholder='Search for anything in the table...'>

<!--JAVASCRIPT-->
<script>

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
</script>