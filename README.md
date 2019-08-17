# Request signature
Request signature, all parameter pairs are sorted in ascending order by dictionary (abcd ...), and the secret assigned by the platform is the key. First, all parameters except the signature itself need to be added in the format "KEY = value" and use the character "&". Add the exact order of the request, then use md5 to encrypt the generated string and then lowercase it. Note: The sign parameter does not participate in the signature; the null parameter does not participate in the signature.

JSON: Local generation

Parameters Description

<table>
<thead>
<tr>
<th>Parameter</th>
<th>Description</th>
<th>Type</th>
<th>Required</th>
</tr>
</thead>
<tbody>
<tr>
<td>amount</td>
<td>Legal currency amount (up to 2 decimal places)</td>
<td>BigDecimal</td>
<td>Yes</td>
</tr>
<tr>
<td>appKey</td>
<td>API(APP) Access Key appSecret</td>
<td>String</td>
<td>Yes</td>
</tr>
<tr>
<td>currencyType</td>
<td>French currency type (1: CNY 2: USD 3: KWR)</td>
<td>Int</td>
<td>Yes</td>
</tr>
<tr>
<td>goodsName</td>
<td>product name</td>
<td>String</td>
<td>Yes</td>
</tr>
<tr>
<td>merchantOrderNum</td>
<td>Merchant order number</td>
<td>String</td>
<td>Yes</td>
</tr>
<tr>
<td>qrCodeType</td>
<td>QR code type (fixed 1)</td>
<td>Int</td>
<td>Yes</td>
</tr>
<tr>
<td>ts</td>
<td>Current timestamp (seconds)</td>
<td>Long</td>
<td>Yes</td>
</tr>
<tr>
<td>sign</td>
<td>Used for integrity verification, Querystring('AMOUNT=99.88&APPKEY=appKey&
CURRENCYTYPE=1&GOODSNAME=testName&
MERCHANTORDERNUM=20190712001&QRCODETYPE=1&
TS='Date.parse(new Date())/1000'&APPSECRET=appSecret') string; 
Note: Enter the variables in md5 in alphabetical order, as shown in the 
example,Replace appSecret with the merchant's appSecret string

</td>
<td>String</td>
<td>Yes</td>
</tr>

</tbody>
</table>



# Callback description

The order payment was successful or cancelled for callback processing. If SUCCESS is returned, it means success. If it returns other results, it means failure. It will call back periodically within the specified time. If the callback result is still failed after the corresponding time and callback time, the callback will stop. If the callback is successful, the callback will not be processed.


<table>
<thead>
<tr>
<th>Parameter</th>
<th>Description</th>
<th>Type</th>
<th>Required</th>
</tr>
</thead>
<tbody>
<tr>
<td>qrCodeType</td>
<td>QR code type (fixed 1)</td>
<td>Int</td>
<td>Yes</td>
</tr>
<tr>
<td>payOrderNum</td>
<td>Platform order number</td>
<td>String</td>
<td>Yes</td>
</tr>
<tr>
<td>merchantOrderNum</td>
<td>Merchant order number</td>
<td>String</td>
<td>Yes</td>
</tr>
<tr>
<td>goodsName</td>
<td>product name</td>
<td>String</td>
<td>Yes</td>
</tr>
<tr>
<td>currencyType</td>
<td>French currency type (1:CNY 2:USD 3：KWR)</td>
<td>Int</td>
<td>Yes</td>
</tr>
<tr>
<td>amount</td>
<td>Legal currency amount (up to 2 decimal places)</td>
<td>BigDecimal</td>
<td>Yes</td>
</tr>
<tr>
<td>ts</td>
<td>Timestamp (seconds)</td>
<td>Long</td>
<td>Yes</td>
</tr>
<tr>
<td>appKey</td>
<td>User requested key</td>
<td>String</td>
<td>Yes</td>
</tr>
<tr>
<td>sign</td>
<td>Signature (data signature verification use) Example: 
md5(AMOUNT=99.88&APPKEY=appKey&CURRENCYTYPE=1&
GOODSNAME=testName&MERCHANTORDERNUM=20190712001&
PAYORDERNUM=20190712001&QRCODETYPE=1&
TS=Date.parse(new Date())/1000&APPSECRET=appSecret).toUpCase()

</td>
<td>String</td>
<td>Yes</td>
</tr>

</tbody>
</table>



# Error Code




<table>
<thead>
<tr>
<th>Code</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td>200</td>
<td>System Success.</td>
</tr>
<tr>
<td>201</td>
<td>System error. Please refer to the msg content and seek for technical support.</td>
</tr>
<tr>
<td>202</td>
<td>Business data exception</td>
</tr>
<tr>
<td>203</td>
<td>Signature verification failed</td>
</tr>
<tr>
<td>204</td>
<td>Insufficient user assets</td>
</tr>
<tr>
<td>205</td>
<td>Key failure</td>
</tr>
<tr>
<td>206</td>
<td>Access times exceed the limit and deny access</td>
</tr>
<tr>
<td>207</td>
<td>No authority</td>
</tr>
<tr>
<td>400</td>
<td>Request parameter error</td>
</tr>
<tr>
<td>401</td>
<td>ToKen expired</td>
</tr>
<tr>
<td>402</td>
<td>ToKen validation failed</td>
</tr>
<tr>
<td>403</td>
<td>ToKen user not logged in</td>
</tr>


</tbody>
</table>


# Sample Response



<pre><code>
&lt;html&gt;
&lt;head&gt;
&lt;script src="https://www.paybank.com/payserver/jquery.min.js"&gt;&lt;/script&gt;
&lt;script src="https://www.paybank.com/payserver/payment.min.js"&gt;&lt;/script&gt;
&lt;/head&gt;
&lt;body&gt;
 &lt;a href="#" onclick="paybank_pay();"&gt;PayBank&lt;/a&gt;
&lt;script type="text/javascript"&gt;
  document.writeln("&lt;livil id=\'paybank_window\'&gt;&lt;/livil&gt;"); // iframe div
  var post_data = "";
  var post_json = "";
  var api_server = "lib/config.php"; //setup
 
  function paybank_pay() {
 	
      post_json = {
            itemName:'test', //name
            price:'10.00',  // price
            userID:'demo'   //userid
 	}
  
    
    $.post(api_server,post_json,
        function(data,status){
          console.log(data);
          var obj = JSON.parse(data); 
          if(obj.sign)
           {       	
           action_pay(data);    //send data play
           }else{
           alert('fail');       //fail
           }
       });
    }
    
   function success_main()       // Payment Successful Return Code
   {
    alert('success and ok'); 
   }
  &lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;

</code></pre>


# Demo

          

Demo 1:https://demo.paybank.com/
Demo 2:https://demo.paybank.com/demo
