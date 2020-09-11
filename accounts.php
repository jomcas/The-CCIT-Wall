<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once "connections/connection.php";

$con = connection();

$id = $_SESSION['ID'];
$sql = "SELECT * FROM users ORDER BY userID";
$users = $con->query($sql) or die($con->error);
$row = $users->fetch_assoc();

if (!isset($_SESSION['UserLogin'])) {
    echo header("Location: login.php");
}

if (isset($_SESSION['UserLogin'])) {
    echo "<div class='float-right'> Welcome <b> " . $_SESSION['UserLogin'] . " </b> | Role: <b> " . $_SESSION['Access'] . "</b></div> <br>";
} else {
    echo "Welcome guest!";
}

?>

<!DOCTYPE html>
<html lang="en">

<<<<<<< HEAD
    <head>
        <title> CCIT Forum </title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
=======
<head>
    <title> CCIT Forum </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>

    <div class="container">

        <h1 class="text-center"> The CCIT Wall </h1>
        <h3 class="text-center"> Homepage </h3>

        <!-- Button Group -->
        <h1> Accounts </h1>
        <small> View All Users.</small>
        <div class="btn-group float-right" role="group" aria-label="">
            <a class="btn btn-primary float-left font-weight-bold" href="/ccitforum/home.php"> News Feed </a> &nbsp;
            <a class="btn btn-secondary float-left font-weight-bold" href="/ccitforum/myPosts.php"> My Posts </a> &nbsp;
            <a class="btn btn-success float-left font-weight-bold" href="/ccitforum/accounts.php"> Accounts </a> &nbsp;
            <a class="btn btn-danger float-left font-weight-bold" href="/ccitforum/logout.php"> Logout </a>
        </div>
        <br>
        <br>
        <hr>

        <div class="btn-group float-right" role="group" arial-label="">
            <!-- ADMIN Add Account Button -->
            <?php if ($_SESSION['Access'] == "admin") { ?>
                <a class="btn btn-link float-right text-decoration-none" href="/ccitforum/add.php"> Add New Account </a> <br> <br>
            <?php } ?>
>>>>>>> 087d82f2736edf70d7b105b972c8b8cdc26af303

            <!-- USER Edit Account Link -->
            <a id="loginBtn" class="btn btn-link float-right text-decoration-none" href="/ccitforum/update.php?ID=<?php echo $id ?>"> Edit My Account </a>

        </div>
        <!-- Search Bar -->
        <form action="result.php" method="get" accept-charset="utf-8">
            <div class="input-group mb-3">
                <input type="text" name="search" id="search" class="form-control" placeholder="Search for user's name or email" autocomplete="off">
                <div class="input-group-append float-right">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
            </div>
        </form>

        <!-- Users Table -->
        <table class="table table-striped">

            <thead>
                <tr class="tableHead bg-primary" style="color:white">

                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>

<<<<<<< HEAD
            <div class="btn-group flot-right" role="group" arial-label="">
            <!-- ADMIN Add Account Button -->
            <?php if($_SESSION['Access'] == "admin") { ?>
            <a class="btn btn-link float-right" href="/ccitforum/add.php"> Add New Account </a> <br> <br>
            <?php } ?>
            
            <!-- USER Edit Account Link -->
            <a id="loginBtn" class="btn btn-link float-right" href="/ccitforum/update.php?ID=<?php echo $id?>"> Edit My Account </a>
            
            </div>
            <!-- Search Bar -->
            <form action="result.php" method="get" accept-charset="utf-8">
                <div class="input-group mb-3">
                    <input type="text" name="search" id="search" class="form-control"
                        placeholder="Search for user's name or email" autocomplete="off">
                    <div class="input-group-append float-right">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </div>
                </div>
            </form>
            
            <!-- Users Table -->
            <table class="table table-striped">

                <thead>
                    <tr>
                        <th scope="col">View Profile</th>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>

                        <!-- ADMIN COLUMNS FIELDS -->
                        <?php if($_SESSION['Access'] == "admin") { ?>
=======

                    <!-- ADMIN COLUMNS FIELDS -->
                    <?php if ($_SESSION['Access'] == "admin") { ?>
>>>>>>> 087d82f2736edf70d7b105b972c8b8cdc26af303
                        <th scope="col">Password</th>
                        <th scope="col">Access</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    <?php } ?>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                <?php if ($users->num_rows > 0) { ?>
                    <?php do { ?>
                        <?php if ($row['userID'] != $_SESSION['ID']) { ?>
                            <tr>

                                <td> <b> <?php echo $row['userID']; ?> </b> </td>
                                <td> <?php echo $row['name']; ?> </td>
                                <td> <?php echo $row['email']; ?> </td>

                                <!-- ADMIN Rows -->
                                <?php if ($_SESSION['Access'] == "admin") { ?>
                                    <td> <?php echo $row['password']; ?> </td>
                                    <td> <?php echo $row['access']; ?> </td>

                                    <td>
                                        <a class="view btn btn-warning btn-sm" name="update" style="color:white" href="/ccitforum/update.php?ID=<?php echo $row['userID'] ?>"><b>Update</b></a>
                                    </td>
                                    <td>
                                        <form action="delete.php" onSubmit="return confirm('Do you really want to delete this user?')" method="post" accept-charset="utf-8">
                                            <button type="submit" class="view btn btn-danger btn-sm" name="deleteUser"><b>Delete</b></button>
                                            <input type="hidden" class="<style>hidden" name="ID" value="<?php echo $row['userID'] ?>">
                                        </form>
                                    </td>
                                <?php } ?>
                                <td>
                                    <a class="view btn btn-info btn-sm" name="view" href="/ccitforum/details.php?ID=<?php echo $row['userID'] ?>"><b>View Profile</b></a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } while ($row = $users->fetch_assoc()) ?>
<<<<<<< HEAD
                    <?php } else { echo "<div class='display-4'> No accounts yet! </div>"; } ?>
                </tbody>
            </table>
=======
                <?php } else {
                    echo "<div class='display-4'> No accounts yet! </div>";
                } ?>
            </tbody>


        </table>
>>>>>>> 087d82f2736edf70d7b105b972c8b8cdc26af303
        <div>

</body>
<html>