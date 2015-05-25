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
        $role = mysqli_real_escape_string($dbc,trim($_POST['role']));
        $email = mysqli_real_escape_string($dbc,trim($_POST['email']));
        $tel = mysqli_real_escape_string($dbc,trim($_POST['tel']));
        $comment = mysqli_real_escape_string($dbc,trim($_POST['comment']));
        
        if(!empty($user_username)&&!empty($user_password)&&!empty($email)&&!empty($tel)){
            //MySql中的SHA()函数用于对字符串进行单向加密
            $query = "SELECT `user_id`, `username` FROM `lab_user` WHERE `username` = '$user_username'";
            mysqli_query($dbc,"SET NAMES utf8");
            $data = mysqli_query($dbc,$query);
            if(mysqli_num_rows($data)==1){
                $error_msg = "Sorry, username:'$user_username' has been taken.Please input another one.";
                echo "
                    <div class='alert alert-block alert-danger' onclick='this.style.display=\"none\";'>
                    <strong>$error_msg</strong>
                    </div>
                    ";
            }
            else
            {
                if(empty($comment)) $comment="";
                $query = "INSERT INTO `lab_user`(`username`, `password`, `role`, `email`, `tel`, `comment`) VALUES ('$user_username', SHA('$user_password'),'$role','$email','$tel','$comment')";
                // $query = "INSERT INTO `lab_user`(`username`, `password`, `role`, `comment`) VALUES ('$user_username', '$user_password','admin','')";
                //用用户名和密码进行查询
                $data = mysqli_query($dbc,$query);
                $home_url = 'login.php';
                header('Location: '.$home_url);
            }
        }else{
            $error_msg = 'Sorry, you must enter a valid username and password to sign in.';
            echo "
                <div class='alert alert-block alert-danger' onclick='this.style.display=\"none\";'>
                <strong>$error_msg</strong>
                </div>
                ";
        }
    }
}
else{   
    $home_url = 'logged.php';
    header('Location: '.$home_url);
}
?>
<html>
    <head>
        <title>实验室预约系统 - 注册</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
        
        <link href="css/prettify.css" rel="stylesheet" />
        <link href="css/bootstrap.2.1.0.css" rel="stylesheet">
        <link href="css/demosignin.css" rel="stylesheet" />
        <script Charset="UTF-8" src="libs/jquery-2.1.3.js" type="text/javascript"></script>
        <script Charset="UTF-8" src="libs/prettify.js" type="text/javascript"></script>
        <script Charset="UTF-8" src="js/dialogProcess.js" type="text/javascript"></script>
        <script Charset="UTF-8" src="js/fadeInFadeOut.js" type="text/javascript"></script>
    </head>
    
    <body>
        <!--通过$_SESSION['user_id']进行判断，如果用户未登录，则显示登录表单，让用户输入用户名和密码-->
        <?php
        if(!isset($_SESSION['user_id'])){
        //    echo '<p class="error">'.$error_msg.'</p>';
        ?>
        <!-- $_SERVER['PHP_SELF']代表用户提交表单时，调用自身php文件 -->
        <div style="position:absolute;top:10%;left:35%;" id="form">
            <form method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>"　>
                <div  class="well span6">
                    <fieldset>
                        <div style="text-align: center;">
                            <legend>
                                <h3 >实验室预约系统<br>
                                注　　册</h3>
                            </legend>
                        </div>
                        <div >
                            <div>
                                <label for="username">用户名:</label>
                                <!-- 如果用户已输过用户名，则回显用户名 -->
                                <input class="span6" type="text" id="username" name="username" placeholder="*必填..."
                                value="<?php if(!empty($user_username)) echo $user_username; ?>" />
                            </div>
                            <div>
                                <label for="password">密　码:</label>
                                <input class="span6" type="password" id="password" name="password" placeholder="*必填..."/>
                            </div>
                            <div>
                                <label for="role">用户类型:</label>
                                <div class="span6" >
                                    <a style="text-align: center;" class="span2"><input type="radio" class="span1" id="user" name="role" value="user" checked />普通用户</a>
                                </div>
                            </div>
                            <div>
                                <label for="email">邮　箱:</label>
                                <input class="span6" type="email" id="email" name="email" placeholder="*必填..."/>
                            </div>
                            <div>
                                <label for="tel">手机号:</label>
                                <input class="span6" type="tel" id="tel" name="tel" placeholder="*必填..."/>
                            </div>
                            <div>
                                <label for="comment">所属部门:</label>                                
                                <textarea id="comment" class="span6 area" name="comment" placeholder="输入信息..." ></textarea>
                            </div>
                            <div style="text-align: right;">
                                <input type="submit" class="btn btn-info" value="注　册" name="submit"/>
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