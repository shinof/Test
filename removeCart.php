<?php
	//セッションスタート
	session_start();
	//セッションにIDが格納されてなければindexに戻す
	if( !isset( $_SESSION["id"] ) ){
		header( "Location: index.html" );
		exit;
	}

	//カート変数がセッションになかったら商品一覧に戻る
        if( !isset( $_SESSION["cart"] ) ){
            header( "Location: productView.php" );
            exit;
	}

	//削除するキーを取得
	$remove_key = $_GET["remove_key"];

	//カート配列の初期化
	$cart = array();

	//セッションからカート変数を読み込みカート配列に格納
	$cart = $_SESSION["cart"];

	//指定した配列のキーを削除
	unset( $cart[${remove_key}] );
	//葉抜けのキーの部分を詰める
	$cart = array_values($cart);

	//セッションのカート配列にカート配列を格納
	$_SESSION["cart"] = $cart;

	//カートに戻る
	header( "Location: cartView.php" );
	exit;
?>