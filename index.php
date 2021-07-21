<?php
	include './src/main.php';
	coin_list();  // 코인 리스트 확인하기
	// order_create();  // 결제 주문 생성

	// 코인 리스트 확인하기
	function coin_list(){
		$json_data = array(
			"appKey" => "kpecb34edd45cf4d2bb42229aac78f66c5",
			"ts" => time(),
			"appSecret" => "sbf54f0ae60704c69859b028c5cdb1fbd"
		);

		$return_data = process($json_data,1);
		echo $return_data;
	}

	// 결제 주문 생성
	function order_create(){
		$json_data = array(
			"amount" => 10000,                                  // 결제금액(법정화페)
			"appKey" => "kpecb34edd45cf4d2bb42229aac78f66c5",   // 가맹점 appKey
			"createType" => 1,                                  // 1.법정화페, 2.결제시 코인ID, 3.가맹점 코인ID
			"currencyType" => 3,                                // 1.CNY, 2.USD, 3.KRW
			"goodsName" => "test1111",                          // 상품이름
			"merchantOrderNum" => "test".time(),                // 사용자 주문번호 고유값
			"ts" => time(),                                     // 현재 유닉스 시간
			"appSecret" => "sbf54f0ae60704c69859b028c5cdb1fbd"  // 가맹점 appSecret
		);

		$return_data = process($json_data,2);
		echo $return_data;
	}
?>