<!DOCTYPE html>
<html>
<?php
require_once './app/model/ModelUser.php';
?>
<head>
    <title>test</title>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link type='text/css' rel='stylesheet' href='public/css/bootstrap.css'>
</head>
<body>
<?php
ModelUser::readAllUser();
//Sql::insert();
?>


//下面这种办法可以
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "LO07";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM utilisateur";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 输出每行数据
    while($row = $result->fetch_assoc()) {
        echo "<br> nom: ". $row["nom"]. " - prenom: ". $row["prenom"];
    }
} else {
    echo "0 results";
}
$conn->close();
?>



</body>
</html>



