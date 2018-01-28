<?php

// $content = file_get_contents("php://input");
// $array = json_decode($content,true);
// $nonce = $array['nonce'];
// $json_error = json_last_error();
// $myfile = fopen("file.txt", "w") or die("Unable to open file!");
// fwrite($myfile, $nonce);
// fclose($myfile);
// $myfile = fopen("error.txt", "w") or die("Unable to open file!");
// fwrite($myfile, $json_error);
// fclose($myfile);

$dbname = 'onenet_db';   // 数据库名
$host = 'localhost';
$port = 3306;
$user = 'root';    //用户AK
$pwd = '211583'; //用户SK

/*接着调用mysql_connect()连接服务器*/
/*为了避免因MySQL数据库连接失败而导致程序异常中断，此处通过在mysql_connect()函数前添加@，来抑制错误信息，确保程序继续运行*/
$link = mysqli_connect("{$host}:{$port}",$user,$pwd);
if(!$link) {
    die("Connect Server Failed: " . mysqli_error());
}
/*连接成功后立即调用mysql_select_db()选中需要连接的数据库*/
if(!mysqli_select_db($link, $dbname)) {
    die("Select Database Failed: " . mysqli_error($link));
}

/*至此连接已完全建立，就可对当前数据库进行相应的操作了*/

require_once 'util.php';
$data = file_get_contents('php://input');
$sql = Util::receiveMsg($data);
$exec = mysqli_query($link, $sql);
if ($exec === false) {
    die("Create Table Failed: " . mysqli_error($link));
} else {
    echo "Create Table Succeed<br />";
}    

mysqli_close($link);
// $myfile = fopen("msg.txt", "w") or die("Unable to open file!");
// fwrite($myfile, $sql);
// fclose($myfile);

?>
