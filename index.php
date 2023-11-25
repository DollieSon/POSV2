<?php 

	//htmlspecialchars
  //Categories [Coffee, Beverage , Snack ,Add-on]	

	$conn = new mysqli('localhost','PcResting','tonidoll123','wildcat lounge');

	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
	$size= 0;
	$querry = "SELECT * FROM `item menu`";
	$result = $conn->query($querry); 
	$items = array();
	if($result){
		while($items[] = $result->fetch_assoc()){
			$size++;
		}
		//ofset by 1
		unset($items["$size"]);
		//echo "Sucess";
	}else{
		echo "Something went wrong";
	}

  $allitem = array(
    "Coffee"=>array(),
    "Beverage"=>array(),
    "Snack"=>array(),
    "Add-on"=>array()
  );

  foreach ($allitem as $key => $value) {
    $querry = "SELECT * FROM `item menu` WHERE Category = '$key'";
    $res = $conn->query($querry);
    if($res){
      $size = 0;
      while($allitems["$key"][]=$res->fetch_assoc()){
        $size++;
      }
      unset($allitems["$key"]["$size"]);
      
    }else{
      echo "Semething went wrong with $key";
    }
  }

  if(isset($_POST['Money'])){
    echo "string";
  }

 ?>
<!DOCTYPE html>
<html>

<?php include('Templates/header.php') ?>

<div id="MainContent">
      <div id="MainTop">
        <div id="Left">
          <p>Choices:</p>
          <div class="container" id="cont">
            <?php foreach ($allitems as $key => $value) { 
                echo "<p> $key </p>";
              ?>
                <div id="<?php echo $key ?>" class="itembox" onclick="">
                    <?php foreach ($value as $ikey => $val) { ?>
                      <div class="Item" onclick="AddItem(<?php echo "$val[Item_ID]"; ?>)">
                        <?php echo "<p>".$val["Item Name"]."</p>";
                        echo "<p>".$val["Price"]."</p>"; ?>
                      </div>
                    <?php } ?>
                </div>

            <?php } ?>
          </div>
        </div>
        <div id="Mid">
          <p>Order Info</p>
          <div id="OrderBox"></div>
          <p id="Total">Total:</p>
          <button id="Clearbtn" onclick="ClearOrders()">Clear All</button>
        </div>
        <div id="Right">
          <p id="Changep">Change</p>
          <?php $Changes = array(1000,500,200,100,50,20);

            foreach ($Changes as $key => $value) { ?>
              <div class="Changecard" id="<?php echo "C$value"; ?>">
                <button onclick="PostOrder(<?php echo "$value"; ?>)"><?php echo "$value"; ?></button>
              </div>
          <?php }?>
          <div class="Changecard" id="Ccustom">
            <input type="number" id="Customin" />
            <button id="Custombtn">Set Custom</button>
          </div>
          <p id="CustomCost"></p>
        </div>
      </div>
      <div id="MainBot">
        <button id="ResetOutput">Reset Output</button>
        <p id="OutputP">Output:</p>
        
      </div>
</div>
<script >
	let some = {
		<?php foreach ($items as $key => $value) {
			echo "$value[Item_ID]:{";
			foreach ($value as $ikey => $val) {
				echo "'$ikey':'$val',";
			}
			echo "},";
		} ?>
	};

	//console.log(some);
</script>
<?php include('Templates/footer.php') ?>

</html>