<!-- ▼処理 -->
<?php
	//セッションスタート
	session_start();
	//セッションにIDが格納されてなければindexに戻す
	if( !isset( $_SESSION["id"] ) ){
		header( "Location: index.html" );
		exit;
	}

	//商品IDの読み込み
	$product_id = $_GET["product_id"];


	//カート配列の初期化
	$cart = array();

	//セッションにカート配列があったらデータ追加
	if( isset( $_SESSION["cart"] ) ){
        $cart = $_SESSION["cart"];
		$cart[] = $product_id;
	}else{
		$cart[0] = $product_id;
	}

	//セッションのカート配列にカート配列を格納
	$_SESSION["cart"] = $cart;

	//商品一覧に戻る
	header( "Location: productView.php" );
	exit;
?>
<!-- ▲処理 -->