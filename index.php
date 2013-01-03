<style type="text/css">
#markers {
	padding: 10px;
	margin: 10px;
	font-size: 12px;
	font-family: Arial;
}
#markers li {
	float: left;
	margin: 5px;
}
#markers li a {
	padding: 8px 12px;
	display: block;
	background: #CCC;
	color: #000;
	text-decoration: none;
}	
</style>

<?php
require "Pagination.php";

//current page
$current_page = ((isset($_GET['page']))?$_GET['page']:1);

//records per page
$records = 10;

//results total
$total = 3000;

$pagination = new Pagination($current_page,$records);

//total, paging type, total markers
//type markers ("google","yahoo","jumping","simple")
$pages = $pagination->CreatePages($total,"google",10);

//item used only in consultation with the bank, it is not mandatory to use it
$start = $pagination->_start;
//this used to mysql limit queries
echo $sql = "SELECT * FROM table LIMIT ".$start.",".$records."<br />";

//all pages return array
$all= $pagination->_arrayPages;
//markers
$markers = $pagination->_indexes;
$last = $pagination->_totalPages;
$prev = $pagination->_previousPage;
$next = $pagination->_nextPage;

$go = $pagination->Go(20);
$back = $pagination->Back(20);

?>

<ul id="markers">
<li><a href="?page=1">first</a></li>
<li><a href="?page=<?php echo $prev; ?>">prev</a></li>
<li><a href="?page=<?php echo $back; ?>">Back to 20</a></li>

<?php foreach($markers as $num) { ?>
	<li><a href="?page=<?php echo $num; ?>"><?php echo $num; ?></a></li>
<?php } ?>

<li><a href="?page=<?php echo $next; ?>">next</a></li>
<li><a href="?page=<?php echo $go; ?>">Go to 20</a></li>
<li><a href="?page=<?php echo $last; ?>">last</a></li>
</ul>