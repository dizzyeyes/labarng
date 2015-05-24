<?php
//插入连接数据库的相关信息
require_once 'dbconnect.php';

//开启一个会话
session_start();

$error_msg = "";
//如果用户未登录，即未设置$_SESSION['user_id']时，执行以下代码
if(!isset($_SESSION['user_id'])){
    if(isset($_POST['submit'])){//用户提交登录表单时执行如下代码
        $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        $user_username = mysqli_real_escape_string($dbc,trim($_POST['username']));
        $user_password = mysqli_real_escape_string($dbc,trim($_POST['password']));

        if(!empty($user_username)&&!empty($user_password)){
            //MySql中的SHA()函数用于对字符串进行单向加密
            $query = "SELECT `user_id`, `username` FROM `lab_user` WHERE `username` = '$user_username'";
            $data = mysqli_query($dbc,$query);
            if(mysqli_num_rows($data)==1){
                $error_msg = "Sorry, username:'$user_username' has been taken.Please input another one.";
            }
            else
            {
                $query = "INSERT INTO `lab_user`(`username`, `password`, `role`, `comment`) VALUES ('$user_username', SHA('$user_password'),'admin','')";
                // $query = "INSERT INTO `lab_user`(`username`, `password`, `role`, `comment`) VALUES ('$user_username', '$user_password','admin','')";
                //用用户名和密码进行查询
                $data = mysqli_query($dbc,$query);
                $home_url = 'login.php';
                header('Location: '.$home_url);
            }
        }else{
            $error_msg = 'Sorry, you must enter a valid username and password to sign in.';
        }
    }
}else{//如果用户已经登录，则直接跳转到已经登录页面
    $home_url = 'logged.php';
    header('Location: '.$home_url);
}
?>
<html>
    <head>
        <title>实验室预约系统 - 注册</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
        <style>
            body {
                font-family: Monospace;
                background-color: #f0f0f0;
                margin: 0px;
                overflow: hidden;
            }
            .acc{
                z-index:10;
            } 
        </style>
    </head>
    
    <body>
        <h3 style="top:20%;left:45%;position:absolute;">实验室预约系统 - 注册</h3>
        <!--通过$_SESSION['user_id']进行判断，如果用户未登录，则显示登录表单，让用户输入用户名和密码-->
        <?php
        if(!isset($_SESSION['user_id'])){
            echo '<p class="error">'.$error_msg.'</p>';
        ?>
        <!-- $_SERVER['PHP_SELF']代表用户提交表单时，调用自身php文件 -->
        <div style="position:absolute;top:30%;left:45%;">
            <form method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>"　>
                <div  style="text-align: center;">
                    <fieldset>
                        <legend>注　册</legend>

                        <label for="username">用户名:</label>
                        <!-- 如果用户已输过用户名，则回显用户名 -->
                        <input type="text" id="username" name="username"
                        value="<?php if(!empty($user_username)) echo $user_username; ?>" />

                        <br/>

                        <label for="password">密　码:</label>
                        <input type="password" id="password" name="password"/>

                    </fieldset>
                    <input type="submit" value="注　册" name="submit"/>
                </div>
            </form>
        </div>
        <?php
        }
        ?>
    </body>
</html>