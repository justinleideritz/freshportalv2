<?php

// Set greeting based on time
$current_hour = date('H');
if ($current_hour > 5 && $current_hour < 12) {
    $greeting = "Good morning";
} elseif ($current_hour >= 12 && $current_hour < 18) {
    $greeting = "Good afternoon";
} else {
    $greeting = "Good evening";
}
?>

<!--STYLING-->
<style>
    #create,
    #manage {
        text-decoration: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-weight: bold;
        background-color: #4b556b;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #create:hover,
    #manage:hover {
        background-color: #6b7280;
        color: #fff;
    }

    #logout {
        text-decoration: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-weight: bold;
        background-color: #b32104;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #logout:hover {
        background-color: #ec2700;
        color: #fff;
    }
</style>

<!--HTML FOR NAVBAR-->
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