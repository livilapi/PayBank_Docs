<?php
 header("Content-type: text/html; charset=utf-8");  
 $appKey = "k7309ba5b11124e04903df781b80bf045";
 $appSecret = ""; //
 $userID=$_POST['userID'];
 $currencyType = 2;  //(1: CNY 2: USD 3: KWR)
 $itemName = $_POST['itemName'];   //name
 $orderNum = $userID."_".time();  //orderNum
 $price = $_POST['price'];  //money
 $qrcodetype = "1";
 $time = time();

  /*	
  $sql = "SELECT * FROM table_name where ename = '".$userID."'";
  $result = mysql_query($sql); 
  $row = mysql_fetch_array($result);
  if($row['ename']){
  */

      
 $sign = md5("AMOUNT=".$price."&APPKEY=".$appKey."&CURRENCYTYPE=".$currencyType."&GOODSNAME=".$itemName."&MERCHANTORDERNUM=".$orderNum."&QRCODETYPE=".$qrcodetype."&TS=".$time."&APPSECRET=".$appSecret); 
 $sign = strtolower($sign);

 $value = array(
            "amount" => $price,
            "appKey" => $appKey,
            "currencyType" => $currencyType,
            "goodsName" => $itemName,
            "merchantOrderNum" => $orderNum,
            "qrCodeType" => $qrcodetype,
            "ts" => $time,
            "sign" => $sign
        );

 echo $value = json_encode($value, JSON_UNESCAPED_UNICODE);
 /*
 $sql = "INSERT INTO table_name ( userID, orderNum, currencyType, sign, time ) VALUES ( '".$userID."', '".$orderNum."','".$currencyType."','".$sign."','".$time."' )";
 mysql_query($sql);

  }else{
 $value = array(
            "reten" => "fail"
        );
 echo $value = json_encode($value, JSON_UNESCAPED_UNICODE); 
}
*/
?>
