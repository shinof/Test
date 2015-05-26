<?php
	//入力されていたら入力値受け取り
	if( !isset($_POST["id"]) || !isset($_POST["password"]) ){
		header( "Location: index.html" );
		exit;
	}

	//入力値受け取り
	$id = $_POST["id"];
	$password = $_POST["password"];

	//ファイル設定
	$user_file = file( "data/user.txt" );
	//フラグ設定
	$flg = false;
	//一行ずつ($line)読み込み
	foreach( $user_file as $line ){
		//改行削除
		$line = trim( $line );
		//1行のidとPWをline_array配列に格納
		$line_array = explode( "," , $line );
		//IDとパスワードの一致比較
		if( ($line_array[0] == $id) && ($line_array[1]) == $password ){
			$flg = true;
			break;
		}
	}

	if( $flg ){
		//セッション開始
		session_start();
		//セッションにIDを格納
		$_SESSION[ "id" ] = $id;
		header( "Location: productView.php" );
	}else{
		header("Location: index.html");
	}
?>