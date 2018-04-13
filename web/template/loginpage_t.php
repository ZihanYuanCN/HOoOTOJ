<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>登陆</title>
    <link rel="stylesheet" type="text/css" href="css/loginpage.css" />
</head>

<body>
<?php
session_start();
$username = $password = $vcode = "";
$username_error = $password_error = $vcode_error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $vcode = trim($_POST['vcode']);
    $flag = 1;
    if (empty($username)) {
        $username_error = "用户名不能为空";
        $flag = 0;
    }
    if (empty($password)) {
        $password_error = "密码不能为空";
        $flag = 0;
    }
    if (strcasecmp($_SESSION["vcode"], $vcode) || $vcode == "" || $vcode == null) {
//    $vcode_error=$_SESSION["vcode"];
        $_SESSION["vcode"] = null;
        $vcode_error = "验证码错误";
        $flag = 0;
    }
    if ($flag==1)
    {
        require_once("login.php");
        check_login($username,$password);
    }
}
//

?>

        <div id="C1">
            <?php require_once("header.php"); ?>
            <div id="main">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <center>
                        <table id="input_table" style="font-size:20px">
                            <tr>
                                <td width=220></td>
                                <td width=220> 用户名:</td>
                                <td width=220>
                                    <input name="username" type="text" size=20 value="<?php echo $username ?>"></td>
                                <td width=220>
                                    <span class="error">
                                       <?php echo $username_error; ?>
                                   </span>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td> 密码:</td>
                                <td>
                                    <input name="password" type="password" size=20></td>
                                <td>
                                    <span class="error">
                                       <?php echo $password_error; ?>
                                   </span>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td> 验证码:</td>
                                <td>
                                    <input name="vcode" size="5" type="text">&nbsp;<img alt="点击刷新" src="vcode.php" onclick="this.src='vcode.php?'+Math.random()">
                                </td>
                                <td>
                                    <span class="error">
                                       <?php echo $vcode_error; ?>
                                   </span>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width=220>
                                    <input name="submit" class="S" type="submit" value="登陆"></td>
                                <td><a href="forgetpage.php">忘记密码</a> <a href="registerpage.php">注册新用户</a></td>
                                <td></td>
                            </tr>
                        </table>
                    </center>
                </form>
            </div>
        </div>
</body>

</html>