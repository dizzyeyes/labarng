<?php
/** WordPress 数据库的名称 */
define('DB_NAME', SAE_MYSQL_DB);

/** MySQL 数据库用户名 */
define('DB_USER', SAE_MYSQL_USER);

/** MySQL 数据库密码 */
define('DB_PASSWORD', SAE_MYSQL_PASS);

/** MySQL 主机 */
define('DB_HOST', SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT);

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8');

$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
?>