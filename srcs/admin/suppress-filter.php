<?php
session_start();

include '../../functions/admin-filters.php';

if ($_SESSION['groupe'] != 'admin')
{
	echo "<meta http-equiv='refresh' content='0,url=../account/my-account.php'>";
}
	suppress_filter($_GET['id']);

echo "<meta http-equiv='refresh' content='0,url=filters-management.php'>";

 ?>
