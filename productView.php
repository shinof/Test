<!-- ▼処理 -->
<?php
	//セッションスタート
	session_start();
	//セッションにIDが格納されてなければindexに戻す
	if( !isset( $_SESSION["id"] ) ){
		header( "Location: index.index" );
		exit;
	}

	//商品ファイル読み込み
	//ファイル設定
	$product_file = file( "data/product.txt" );

?>
<!-- ▲処理 -->

<!-- ▼表示 -->
<!-- HTML5 -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta charset="utf-8">
	<!-- CSS -->
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<style type="text/css">
	th,td{
		border: solid 1px #000;
		padding: 5px;
	}
	p a{
        	margin: 10px;
    	}
	img{
		width: 100px;
	}
	</style>
	<!-- /CSS -->
</head>

<body>
	<h1>商品一覧</h1>
	<table>
		<tr>
			<th>商品名</th><th>単価</th><th>画像</th><th>カートへ追加</th>
		</tr>
<?php
	//一行ずつ読み込み
	foreach( $product_file as $line ){
		//改行削除
		$line = trim( $line );
		//カンマで区切ったデータを配列に格納
		$line_array = explode( ",", $line );
		echo "<tr>";
		echo "<td>" . $line_array[1] . "</td><td>" . $line_array[2] . "</td><td><img src='data/" . $line_array[3] . "'></td><td><a href='addCart.php?product_id=" . $line_array[0] . "'>カートへ追加</a></td>";
		echo "</tr>";
	}
?>
	</table>
    <p><a href="cartView.php">カート確認</a><a href="logout.php">ログアウト</a></p>

</body>
</html>
<!-- ▲表示 -->