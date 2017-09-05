<?php
session_start();

include '../../functions/admin-users.php';

if ($_SESSION['groupe'] != 'admin')
{
	echo "<meta http-equiv='refresh' content='0,url=../account/my-account.php'>";
}
	suppress_user($_GET['id']);

echo "<meta http-equiv='refresh' content='0,url=user-management.php'>";

 ?>
