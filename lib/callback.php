<?

         /* Json format

        {
                  "appKey":"k7309ba5b11124e04903df781b80bf045",
                  "sign":"xxxxxx",
                  "ts":1566570060,
                  "qrCodeType":1,
                  "merchantOrderNum":"demo_1566569491",
                  "payOrderNum":"P20190823221140000820",
                  "goodsName":"goodsName",
                  "currencyType":2,
                  "amount":10.00000000
                }
            */
            $conn = mysqli_connect("localhost", "root", "xxxx", "test") or die('FAIL');
            mysqli_query($conn,"set names utf8");

           
            $data = file_get_contents('php://input');      
            $jsonArr= json_decode($data,TRUE); 
            $appKey = "k7309ba5b11124e04903df781b80bf045";
            $appSecret = "xxxx";
            $sign=$jsonArr['sign'];      
            $ts=$jsonArr['ts'];
            $qrCodeType=$jsonArr['qrCodeType'];
            $merchantOrderNum=$jsonArr['merchantOrderNum'];
            $payOrderNum=$jsonArr['payOrderNum'];
            $goodsName=$jsonArr['goodsName'];
            $currencyType=$jsonArr['currencyType'];
            $amount=$jsonArr['amount'];
            $amount=floatval($amount);
            $time = time();


               
            $sql = "SELECT * FROM member where orderNum = '".$merchantOrderNum."' and type=0";
            $result = mysqli_query($conn, $sql);
            $myfile = fopen("log/newfile.txt", "w") or die("Unable to open file!");
                 $txt = file_get_contents("php://input");
                 fwrite($myfile, $sql);
                 fclose($myfile);
            $row = mysqli_fetch_array($result);
           
            if($row['mb_id']){

            $sign = md5("AMOUNT=".$amount."&APPKEY=".$appKey."&CURRENCYTYPE=".$currencyType."&GOODSNAME=".$goodsName."&MERCHANTORDERNUM=".$merchantOrderNum."&QRCODETYPE=".$qrCodeType."&TS=".$row['time']."&APPSECRET=".$appSecret); 
            $sign = strtolower($sign);
             
                if($sign == $row['sign'])
                {
                 $sql = "UPDATE `member` SET `type` = 1 WHERE mb_id='".$row['mb_id']."'";              
                 $result = mysqli_query($conn, $sql);
                 $sql = "UPDATE `sys_member` SET `money` = money+".$amount." WHERE mb_id='".$row['mb_id']."'";              
                 $result = mysqli_query($conn, $sql);
                 
                 echo 'SUCCESS';
                }
            }
            
    
        ?>
                  
