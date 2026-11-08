<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sdc310_wk3pa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

/* ADD RECORD */
if(isset($_POST['add']))
{
    $fullName = $_POST['fullName'];
    $birthdate = $_POST['birthdate'];
    $favoriteColor = $_POST['favoriteColor'];
    $favoritePlace = $_POST['favoritePlace'];
    $nickname = $_POST['nickname'];

    $sql = "INSERT INTO personal_info
            (FullName, Birthdate, FavoriteColor, FavoritePlace, Nickname)
            VALUES
            ('$fullName','$birthdate','$favoriteColor',
             '$favoritePlace','$nickname')";

    $conn->query($sql);
}

/* UPDATE RECORD */
if(isset($_POST['update']))
{
    $userNo = $_POST['userNo'];

    $sql = "UPDATE personal_info SET
            FullName='{$_POST['fullName']}',
            Birthdate='{$_POST['birthdate']}',
            FavoriteColor='{$_POST['favoriteColor']}',
            FavoritePlace='{$_POST['favoritePlace']}',
            Nickname='{$_POST['nickname']}'
            WHERE UserNo=$userNo";

    $conn->query($sql);
}

/* DELETE RECORD */
if(isset($_GET['delete']))
{
    $userNo = $_GET['delete'];

    $sql = "DELETE FROM personal_info
            WHERE UserNo=$userNo";

    $conn->query($sql);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tyler Follis Wk 3 Performance Assessment</title>
</head>
<body>

<h1>Tyler Follis Wk 3 Performance Assessment</h1>

<h2>Add Personal Information</h2>

<form method="post">

    <p>
        Full Name:
        <input type="text" name="fullName" required>
    </p>

    <p>
        Birthdate:
        <input type="text" name="birthdate" required>
    </p>

    <p>
        Favorite Color:
        <input type="text" name="favoriteColor" required>
    </p>

    <p>
        Favorite Place:
        <input type="text" name="favoritePlace" required>
    </p>

    <p>
        Nickname:
        <input type="text" name="nickname" required>
    </p>

    <input type="submit" name="add" value="Add Record">

</form>

<hr>

<h2>Stored Information</h2>

<table border="1">

<tr>
    <th>User No</th>
    <th>Full Name</th>
    <th>Birthdate</th>
    <th>Favorite Color</th>
    <th>Favorite Place</th>
    <th>Nickname</th>
    <th>Actions</th>
</tr>

<?php

$result = $conn->query("SELECT * FROM personal_info");

while($row = $result->fetch_assoc())
{
?>

<tr>

<form method="post">

<td>
    <?php echo $row['UserNo']; ?>
    <input type="hidden"
           name="userNo"
           value="<?php echo $row['UserNo']; ?>">
</td>

<td>
<input type="text"
       name="fullName"
       value="<?php echo $row['FullName']; ?>">
</td>

<td>
<input type="text"
       name="birthdate"
       value="<?php echo $row['Birthdate']; ?>">
</td>

<td>
<input type="text"
       name="favoriteColor"
       value="<?php echo $row['FavoriteColor']; ?>">
</td>

<td>
<input type="text"
       name="favoritePlace"
       value="<?php echo $row['FavoritePlace']; ?>">
</td>

<td>
<input type="text"
       name="nickname"
       value="<?php echo $row['Nickname']; ?>">
</td>

<td>

<input type="submit"
       name="update"
       value="Update">

<a href="?delete=<?php echo $row['UserNo']; ?>">
Delete
</a>

</td>

</form>

</tr>

<?php
}
?>

</table>

</body>
</html>