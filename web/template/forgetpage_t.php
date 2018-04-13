<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>忘记密码</title>
    <link rel="stylesheet" type="text/css" href="css/forgetpage.css" />
</head>

<body>
    <?php
    session_start();
    $user_id=$question=$answer=$vcode="";
    $user_id_error=$answer_error=$vcode_error="";
    //$vcode_error=$_SESSION["vcode"];
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $user_id = trim($_POST['user_id']);
    $question = trim($_POST['question']);
    switch($question){
        case "Mother":$question=1; break;
        case "Father":$question=2; break;
        case "Game":$question=3; break;
        default:;
    }
    $answer = trim($_POST['answer']);
    $vcode = trim($_POST['vcode']);
    $flag = 1;
        if (empty($user_id)) {
        $user_id_error = "用户名不能为空";
        $flag = 0;
    }
    if (empty($answer)) {
        $answer_error = "密保答案不能为空";
        $flag = 0;
    }
    if (strcasecmp($_SESSION["vcode"], $vcode) || $vcode == "" || $vcode == null) {
//    $vcode_error=$_SESSION["vcode"];
        $_SESSION["vcode"] = null;
        $vcode_error = "验证码错误";
        $flag = 0;
    }
    if($flag==1)
    {
        require_once ("forget.php");
        forget($user_id,$question,$answer);
    }
}
    ?>
        <div id="C1">
            <?php require_once("header.php"); ?>
            <div id="main">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <center>
                        <table id="input_table">
                            <tr>
                                <td width=220></td>
                                <td width=220> 用户名:</td>
                                <td width=220>
                                    <input name="user_id" type="text" size=20 value="<?php echo $user_id ?>"></td>
                                <td width=220> <span class="error">
                                        * <?php echo $user_id_error; ?></span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td> 密保问题:</td>
                                <td>
                                    <select name="question">
                                <option value="Mother"
                                        <?php if (!strcmp($question, "Mother")){ ?>selected="selected"<?php } ?> >您母亲的姓名是？</option>
                                <option value="Father"
                                        <?php if (!strcmp($question, "Father")){ ?>selected="selected"<?php } ?> >您父亲的姓名是？</option>
                                <option value="Game"
                                        <?php if (!strcmp($question, "Game")){ ?>selected="selected"<?php } ?> >您最爱的游戏是？</option>
                            </select>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td> 密保答案:</td>
                                <td>
                                    <input name="answer" type="text" size=20 value="<?php echo $answer ?>"></td>
                                <td> <span class="error">
                                        * <?php echo $answer_error; ?></span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td> 验证码:</td>
                                <td>
                                    <input name="vcode" size="5" type="text">&nbsp;<img alt="点击刷新" src="vcode.php" onclick="this.src='vcode.php?'+Math.random()">
                                </td>
                                <td> <span class="error">
                                        * <?php echo $vcode_error; ?></span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input id="submit" class="S" name="Submit" type="submit" value="确认"></td>
                                <td><a href="loginpage.php">返回登录</a></td>
                                <td></td>
                            </tr>
                        </table>
                    </center>
                </form>
            </div>
        </div>
</body>

</html>