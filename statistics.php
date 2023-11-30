<?php
include("MyLib.php");

$ordersingle = array();
$itemlist = array();

$conn = new mysqli('localhost', 'PcResting', 'tonidoll123', 'wildcat lounge');

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$ordersingle = GetAllSingleOrder();
$itemlist = GetAllItems();


function PrintStats($StatList)
{
	global $itemlist;
	$str = "<div class='StatCount'>";
	foreach ($StatList["Count"] as $key => $value) {
		$str .= "<div class='IndivStat'><p class='ItemNameStat'>" . $itemlist[$key]["Item Name"] . "</p>";
		$str .= "<p class = 'ItemCountStat'>" . $value . "</p></div>";
	}
	$str .= "</div>";
	$str .= "<div class='TotalStat'><p>Total:" . $StatList["Profit"] . "</p></div>";
	return $str;
}

?>
<!DOCTYPE html>
<html>

<?php include('Templates/header.php') ?>
<div class="containerH">
	<div class="StatTop">
		<div class="statLeft statBox">
			<?php
			$Day = GetStatsTodayToN("0 day");
			//print_r($Day);
			?>
			<p class="statTitle">Today</p>
			<div class="LeftCont">
				<?php echo PrintStats($Day); ?>
			</div>
		</div>
		<div class="statMid statBox">
			<?php
			$Week = GetStatsTodayToN("7 day");
			//print_r($Week);
			?>
			<p class="statTitle">This Week</p>
			<div class="MidCont">
				<?php echo PrintStats($Week); ?>
			</div>
		</div>
		<div class="statRight statBox">
			<?php
			$OverAll = GetStatsTodayToN("365 day");
			//print_r($OverAll);
			?>
			<p class="statTitle">OverAll (365 Days)</p>
			<div class="RightCont">
				<?php echo PrintStats($OverAll); ?>
			</div>
		</div>
	</div>
	<div class="statBot">
		<form action=""></form>
		<div class="filterResult">

		</div>
	</div>
</div>
<?php include('Templates/footer.php') ?>

</html>