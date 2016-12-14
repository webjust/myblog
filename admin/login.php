<?php
header("Content-type: text/html; charset=utf-8");
require_once("../comm/config.php");
require_once("../comm/conn.php");
/*
登录的过程：
    获取登录用户提交的信息
    判断非法值
    判断验证码输入是否正确
    判断用户名是否存在数据库中
    判断密码是否正确
    登录成功：写入状态值$_SESSION

注销登录：
    删除状态值$_SESSION    

 */

// session初始化
session_start();

// var_dump($_POST);
// var_dump($_SESSION);

// unset($_SESSION);

// 获取用户提交的数据
$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$vcode = isset($_POST['vcode']) ? $_POST['vcode'] : "";
$sub = isset($_POST['sub']) ? $_POST['sub'] : "";
$action = isset($_GET['a']) ? $_GET['a'] : "";

// 注销登录
if ($action == "logout") {
    // 删除SESSION登录状态值
    unset($_SESSION['islogin']);
}

// 登录的判断：已经登录就直接跳转到首页
if(isset($_SESSION['islogin']) && $_SESSION['islogin'] == 1)
{
    echo "<script>window.location.href='./index.php';</script>";
    die;
}

if($sub)
{
    // 点击了登录按钮，执行下面的代码
    
    // 非法操作的判断
    if(strlen(trim($username)) == 0)
    {
        echo "用户名不能为空，1秒后跳转到登录页";
        echo "<meta http-equiv='refresh' content='1; url=./login.php' />";
        die;
    }

    if(strlen(trim($vcode)) == 0)
    {
        echo "验证码不能为空，1秒后跳转到登录页";
        echo "<meta http-equiv='refresh' content='1; url=./login.php' />";
        die;
    }

    // 判断验证码输入是否正确
    if($vcode != $_SESSION['vcode'])
    {
        echo "验证码输入错误，1秒后跳转到登录页";
        echo "<meta http-equiv='refresh' content='1; url=./login.php' />";
        die;
    }

    // 用户名判断：是否存在数据库当中
    $sql = "SELECT password FROM user WHERE username = '{$username}'";
    $result = mysql_query($sql, $res);

    if(mysql_affected_rows($res) == 1)
    {
        // 比较密码
        $pass = mysql_fetch_row($result);

        if($pass[0] == md5($password))
        {
            // 写入SESSION的登录状态值
            $_SESSION['islogin'] = 1;

            // 登录成功
            echo "登录成功，1秒后跳转到后台的首页";
            echo "<meta http-equiv='refresh' content='1; url=./index.php' />";
            die;
        } else{
            echo "密码错误，1秒后跳转到登录页";
            echo "<meta http-equiv='refresh' content='1; url=./login.php' />";
            die;
        }

    } else {
        echo "该用户不存在，1秒后跳转到登录页";
        echo "<meta http-equiv='refresh' content='1; url=./login.php' />";
        die;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>登录面板</title>
        <meta charset="utf-8">
        <link href="./style/style.css" rel='stylesheet' type='text/css' />
        <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
     <!-----start-main---->
     <div class="main">
        <div class="login-form">
            <h1>登录面板</h1>
                <form method="POST" action="./login.php">
                        <input type="text" name="username" value="" placeholder="输入用户名" />
                        <input type="password" name="password" value="" placeholder="输入密码" />
                        <input type="text" name="vcode" placeholder="验证码" style="width: 100px; float: left; margin-right: 10px;"> <img src="./yzm.php" onclick = "this.src = './yzm.php?c=' + Math.random(); " />
                        <div class="submit">
                            <input type="submit" name="sub" value="登录后台" />
                        </div>
                    <p><a href="#">忘记密码 ?</a></p>
                </form>
            </div>
            <!--//End-login-form-->
             <!-----start-copyright---->
                    <div class="copy-right">
                        <p>Copyright &copy; 2014.Company name All rights reserved.</p> 
                    </div>
                <!-----//end-copyright---->
        </div>
             <!-----//end-main---->
</body>
</html>