<?php
$orders = array();
$itemlist = array();

$conn = new mysqli('localhost', 'PcResting', 'tonidoll123', 'wildcat lounge');

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$query = "SELECT * FROM `order-history-unique`";
$res = mysqli_query($conn, $query);

if ($res) {
	while ($order = mysqli_fetch_assoc($res)) {
		$orders[$order["Order_ID"]] = $order;
	}
}

$query = "SELECT * FROM `order_history_single`";
$res = mysqli_query($conn, $query);
if ($res) {
	while ($order = mysqli_fetch_assoc($res)) {
		$orders[$order["Order_ID"]]["Order"][] = $order;
	}
}
/*
foreach ($orders as $key => $value) {
	foreach ($value as $k => $v) {
		echo $k . ":";
		print_r($v);
		echo "<br/>";
	}
}
*/

$query = "SELECT * FROM `item menu`";
$res = mysqli_query($conn, $query);
if ($res) {
	while ($item = mysqli_fetch_assoc($res)) {
		$itemlist[$item["Item_ID"]] = $item;
	}
}
//print_r($itemlist);
?>
<!DOCTYPE html>
<html>

<?php include('Templates/header.php') ?>
<div class="containerH">
	<?php foreach ($orders as $ikey => $val) { ?>
		<div class="OrderBoxHistory" id="<?php echo $ikey ?>">
			<div class="SingleOrder">
				<?php
				foreach ($val["Order"] as $key => $value) { ?>
					<div class='ItemBoxHistory'>
						<p>
							<?php echo $itemlist[$value["Item_ID"]]["Item Name"] ?>
						</p>
						<p>
							<?php echo $value["Amount"] ?>
						</p>
						<p>
							<?php echo $value["Total Price"] ?>
						</p>
					</div>
				<?php } ?>
			</div>
			<div class="OrderDetailHistory">
				<?php foreach ($val as $key => $value) {
					if ($key == "Order") {
						continue;
					}
					?>
					<p>
						<?php echo $key . ": " . $value ?>
					</p>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
</div>
<?php include('Templates/footer.php') ?>

</html>