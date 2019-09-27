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


$conn = mysqli_connect("localhost", "xxxxxx", "xxxxx", "test") or die('FAIL');
mysqli_query($conn,"set names utf8");


                    //test mysql
                          
                      $sql = "SELECT * FROM sys_member where mb_id = '".$userID."'";
                      $result = mysqli_query($conn, $sql);
                      $row = mysqli_fetch_array($result);
                  
                         
                if($row['ename']){
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

                   //test mysql
                     $sql = "INSERT INTO `member` (`no`, `mb_id`, `orderNum`, `currencyType`, `price`, `sign`, `type`, `time`) VALUES (NULL, '".$userID."', '".$orderNum."','".$currencyType."','".$price."','".$sign."','0','".$time."')";

                     $result = mysqli_query($conn, $sql);

                      }else{
                     $value = array(
                                "reten" => "fail"
                            );
                    }
                    
                    echo $value = json_encode($value, JSON_UNESCAPED_UNICODE); 
?>
