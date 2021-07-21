<?php
	function process($json_data,$result){
		if($result == 1){
			$sign = md5("APPKEY=".$json_data['appKey']."&TS=".$json_data['ts']."&APPSECRET=".$json_data['appSecret']);
			$sign = strtolower($sign);
			$send_data = array(
				"appKey" => $json_data['appKey'],
				"sign" => $sign,
				"ts" => $json_data['ts']
			);
			$send_data = json_encode($send_data, JSON_UNESCAPED_UNICODE);
			$return_data = post("https://openapi.payurl.app/pay/order/coin/list",$send_data);
		}else if($result == 2){
			$sign = md5("AMOUNT=".$json_data['amount']."&APPKEY=".$json_data['appKey']."&CREATETYPE=".$json_data['createType']."&CURRENCYTYPE=".$json_data['currencyType']."&GOODSNAME=".$json_data['goodsName']."&MERCHANTORDERNUM=".$json_data['merchantOrderNum']."&TS=".$json_data['ts']."&APPSECRET=".$json_data['appSecret']."");
			$sign = strtolower($sign);
			$send_data = array(
				"createType" => $json_data['createType'],
				"currencyType" => $json_data['currencyType'],
				"amount" => $json_data['amount'],
				"merchantOrderNum" => $json_data['merchantOrderNum'],
				"goodsName" => $json_data['goodsName'],
				"appKey" => $json_data['appKey'],
				"sign" => $sign,
				"ts" => $json_data['ts']
			);
			$send_data = json_encode($send_data, JSON_UNESCAPED_UNICODE);
			$return_data = post("https://openapi.payurl.app/pay/order/create",$send_data);
		}
		return $return_data;
	}

	function post($url, $fields){
		$herder = array("Content-Type: application/json","Accept-Language: en-US");
		$ch=curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		//header값 셋팅(없을시 삭제해도 무방함)
		curl_setopt($ch, CURLOPT_HTTPHEADER, $herder); 
		//POST방식
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
		curl_setopt($ch, CURLOPT_POST, true); 
		//POST방식으로 넘길 데이터(JSON데이터)
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 3); 
		$response = curl_exec($ch);
		curl_close ($ch);
		return $response;
	}
?>