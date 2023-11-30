<?php
$conn = new mysqli('localhost', 'PcResting', 'tonidoll123', 'wildcat lounge');
function connectSingleUnique($single, $unique)
{
    $newSingle = array();
    foreach ($single as $key => $value) {
        $newSingle[$value["Order_ID"]] = $value;
    }
    //print_r($newSingle);
    foreach ($unique as $key => $value) {
        $unique[$value["Order_ID"]]["Order"][$newSingle[$value["Order_ID"]]["Item_ID"]] = $newSingle[$value["Order_ID"]];
    }
    return $unique;
}

function getStats($list)
{
    $stats = array(
        "Profit" => 0,
        "Count" => array(),
    );
    foreach ($list as $k => $val) {
        $stats["Profit"] += $val["Total"];
        foreach ($val["Order"] as $key => $value) {
            if (array_key_exists($key, $stats["Count"])) {
                $stats["Count"][$key] += $value["Amount"];
                //echo "$key exists adding" . $value["Amount"] . "<br>";
            } else {
                $stats["Count"][$key] = $value["Amount"];
                //echo "$key exists setting" . $value["Amount"] . "<br>";
            }
        }
    }
    return $stats;
}

function OffsetTodayDate($days)
{
    $datestr = date("Y-m-d");
    $currdate = date_create($datestr);
    $date = date_sub($currdate, date_interval_create_from_date_string($days));
    return $date;
}

function GetAllSingleOrder()
{
    global $conn;
    $ordersingle = array();
    $query = "SELECT * FROM `order_history_single`";
    $res = mysqli_query($conn, $query);
    if ($res) {
        while ($order = mysqli_fetch_assoc($res)) {
            $ordersingle[] = $order;
        }
    }
    return $ordersingle;
}

function GetAllItems()
{
    global $conn;
    $itemlist = array();
    $query = "SELECT * FROM `item menu`";
    $res = mysqli_query($conn, $query);
    if ($res) {
        while ($item = mysqli_fetch_assoc($res)) {
            $itemlist[$item["Item_ID"]] = $item;
        }
    }
    return $itemlist;
}

function GetStatsTodayToN($days)
{
    global $conn;
    $ordersingle = GetAllSingleOrder();
    $todayOrder = array();
    $query = "SELECT * FROM `order-history-unique` WHERE `Date` >= '" . OffsetTodayDate($days)->format("Y-m-d H:i:s") . "'";
    //echo $query . "<br/>";
    $res = mysqli_query($conn, $query);
    if ($res) {
        while ($item = mysqli_fetch_assoc($res)) {
            $todayOrder[$item["Order_ID"]] = $item;
        }
    }
    $todayOrder = connectSingleUnique($ordersingle, $todayOrder);
    $DayStats = getStats($todayOrder);
    //print_r($DayStats);
    return $DayStats;
}

?>