<?php 

	//htmlspecialchars
	
	function giveAlert($message){
		echo '<script>alert(\'Error in '.$message.'\') </script>';
	}

	$conn = mysqli_connect('localhost','PcResting','tonidoll123','wildcat lounge');

	if(!$conn){
		echo 'Connection Error'. mysqli_connection_error();
	}


	if (isset($_POST['submit'])) {
		$Vname = mysqli_real_escape_string($conn,$_POST['name']);		
		$Vprice = mysqli_real_escape_string($conn,$_POST['price']);
		$Vtags = mysqli_real_escape_string($conn,$_POST['tags']);
		$Vcat = mysqli_real_escape_string($conn,$_POST['category']);
		$querry = "INSERT INTO `item menu` (`Item_ID`, `Item Name`, `Price`, `Tags`,`Category`) VALUES (NULL, '$Vname', '$Vprice', '$Vtags','$Vcat');";
		echo $querry.'<br>';

		if(mysqli_query($conn,$querry)){
			echo 'Success!';
		}else{
			echo 'Something Went Wrong';
		}
	}

	$query = "SELECT * FROM `item menu`";
	$res = mysqli_query($conn,$query);
	$items = array();
	while($item = mysqli_fetch_assoc($res)){
		$items[] = $item;
	}


 ?>

<!DOCTYPE html>
<html>

<?php include('Templates/header.php') ?>
	<h1>Add New Item</h1>
	<form action="AddItem.php" method="POST" class="InputBox">
		<label>Name:</label>
		<input type="text" name="name">
		<label>Price:</label>
		<input type="number" name="price">
		<label>Tags:</label>
		<input type="text" name="tags">
		<label>Category:</label>
		<input type="text" name="category">
		<div>
			<input type="submit" name="submit" value="submit">
		</div>
	</form>
	<div class="MenuBox">
		<?php foreach ($items as $ikey => $val) { ?>
			<div class="menuitem">
				<?php foreach ($val as $key => $value) { ?>
					<p><?php echo "$value"; ?></p>
				<?php } ?>
			</div>
		<?php } ?>
	</div>

<?php include('Templates/footer.php') ?>

</html>