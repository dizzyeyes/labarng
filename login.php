<?php
header("Content-Type: text/html; charset=UTF-8");
//插入连接数据库的相关信息
require_once 'dbconnect.php';

//开启一个会话
session_start();

$error_msg = "";
//如果用户未登录，即未设置$_SESSION['user_id']时，执行以下代码
if(!isset($_SESSION['user_id'])){
    if(isset($_POST['submit'])){//用户提交登录表单时执行如下代码
        $user_username = mysqli_real_escape_string($dbc,trim($_POST['username']));
        $user_password = mysqli_real_escape_string($dbc,trim($_POST['password']));

        if(!empty($user_username)&&!empty($user_password)){
            //MySql中的SHA()函数用于对字符串进行单向加密
            $query = "SELECT `user_id`, `username`, `role` FROM `lab_user` WHERE `username` = '$user_username' AND "."`password` = SHA('$user_password') ";
            // $query = "SELECT `user_id`, `username` FROM `lab_user` WHERE `username` = '$user_username' AND "."`password` = '$user_password'";
            //用用户名和密码进行查询
            $data = mysqli_query($dbc,$query);
            //若查到的记录正好为一条，则设置SESSION，同时进行页面重定向
            if(mysqli_num_rows($data)==1){
                $row = mysqli_fetch_array($data);
                $_SESSION['user_id']=$row['user_id'];
                $_SESSION['role']=$row['role'];
                $_SESSION['username']=$row['username'];
                $home_url = 'index.php';
                header('Location: '.$home_url);
            }else{//若查到的记录不对，则设置错误信息
                $error_msg = 'Sorry, you must enter a valid username and password to log in.';
                echo "
                    <div class='alert alert-block alert-danger' onclick='this.style.display=\"none\";'>
                    <strong>$error_msg</strong>
                    </div>
                    ";
            }
        }else{
            $error_msg = 'Sorry, you must enter a valid username and password to log in.';
            echo "
                <div class='alert alert-block alert-danger' onclick='this.style.display=\"none\";'>
                <strong>$error_msg</strong>
                </div>
                ";
        }
    }
}else{//如果用户已经登录，则直接跳转到已经登录页面
    $home_url = 'index.php';
    header('Location: '.$home_url);
}
?>
<html>
    <head>
        <title>实验室预约系统 - 登入</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
        
        <link href="css/prettify.css" rel="stylesheet" />
        <link href="css/bootstrap.2.1.0.css" rel="stylesheet">
        <link href="css/demo.css" rel="stylesheet" />
        <script Charset="UTF-8" src="libs/jquery-2.1.3.js" type="text/javascript"></script>
        <script Charset="UTF-8" src="libs/prettify.js" type="text/javascript"></script>
        <script Charset="UTF-8" src="js/dialogProcess.js" type="text/javascript"></script>
        <script Charset="UTF-8" src="js/fadeInFadeOut.js" type="text/javascript"></script>
        <script Charset="UTF-8" src="js/event.js" type="text/javascript"></script>
    </head>
    
    <body>    
    <div class="background" id="background"></div>
    <script>setInterval(changePicture,2000);</script>
        <!--通过$_SESSION['user_id']进行判断，如果用户未登录，则显示登录表单，让用户输入用户名和密码-->
        <?php
        if(!isset($_SESSION['user_id'])){
        //    echo '<p class="error">'.$error_msg.'</p>';
        ?>
        <!-- $_SERVER['PHP_SELF']代表用户提交表单时，调用自身php文件 -->
        <div style="position:absolute;top:20%;left:40%;" id="form">
            <form method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>"　>
                <div  class="well span4">
                    <fieldset>
                        <div style="text-align: center;">
                            <legend>
                                <h3 >实验室预约系统<br>
                                登　　入</h3>
                            </legend>
                        </div>
                        <div >
                            <div>
                                <label for="username">用户名:</label>
                                <!-- 如果用户已输过用户名，则回显用户名 -->
                                <input class="span4" type="text" id="username" name="username" size="20"
                                value="<?php if(!empty($user_username)) echo $user_username; ?>" />
                            </div>
                            <div>
                                <label for="password">密　码:</label>
                                <input class="span4" type="password" id="password" name="password" size="20"/>
                            </div>
                            <div style="text-align: center;">
                                <label class="click" onclick="window.location.href='signup.php';" >去注册</label>
                                <input type="submit" class="btn btn-info" value="登　入" name="submit"/>
                                <!-- <input type="button" class="btn btn-info" value="去注册" onclick="window.location.href='signup.php';"/> -->
                            </div>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>       
        <script>
            MoveFloatLayer('form');
        </script>     
        
        <?php
        }
        ?>
    </body>
</html>