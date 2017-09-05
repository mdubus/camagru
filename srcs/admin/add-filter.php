<?php
session_start();

include '../../functions/admin-filters.php';

if ($_SESSION['groupe'] != 'admin')
{
	echo "<meta http-equiv='refresh' content='0,url=../account/my-account.php'>";
}

if (isset($_POST['filter']) && $_POST['filter'] != NULL)
{
	add_filter($_POST['filter']);
	echo "<meta http-equiv='refresh' content='0,url=filters-management.php'>";
}
else {
	echo "<meta http-equiv='refresh' content='0,url=filters-management.php'>";

}
 ?>
