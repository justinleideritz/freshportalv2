<?php
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

<!--STYLING-->
<style>
    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom-style: solid;
        border-color: #4b556b;
        border-width: 2px;
        height: 50px;
    }

    nav div {
        margin: 0px 40px;
    }

    #logout {
        font-size: medium;
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

<!--HTML-->
<nav>
    <div>
        <?php
        echo "<h1><span style='color: #a0bf39;'>" . $greeting . ",</span> <span style='color: #4b556b;'>" . ucfirst($_SESSION['username']) . "</span></h1>";
        ?>
    </div>
    <div>
        <a onclick="return confirmLogout()" id="logout" href='logout.php'><i class="fa-solid fa-power-off"></i>
            Logout</a>
    </div>
</nav>

<!--JAVASCRIPT-->
<script>
    function confirmLogout() {
        return confirm("Are you sure you want to logout?");
    }
</script>