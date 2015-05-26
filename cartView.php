<!-- ▼処理 -->
<?php
	//セッションスタート
	session_start();
	//セッションにIDが格納されてなければindexに戻す
	if( !isset( $_SESSION["id"] ) ){
		header( "Location: index.html" );
		exit;
	}

	//カート変数がセッションになかったら商品一覧に戻る（そういう仕様）
	if( !isset( $_SESSION["cart"] ) ){
		header( "Location: productView.php" );
		exit;
	}

	//セッションからカート変数を読み込みカート配列に格納
	$cart = $_SESSION["cart"];

	//商品ファイル読み込み
	//ファイル設定
	$product_file = file( "data/product.txt" );

    //合計変数初期化
    $num = 0;
    //配列キー初期化
    $key = 0;

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
	<h1>カート</h1>
	<table>
	<tr>
		<th>商品名</th><th>単価</th><th>画像</th><th>削除</th>
	</tr>
<?php
	//カート配列からIDを一つずつ取り出す
	foreach( $cart as $a ){
		//商品ファイルを一行ずつ読み込み
		foreach( $product_file as $product_line ){
			//改行削除
			$product_line = trim( $product_line );
			//カンマで区切ったデータを配列に格納
			$product_array = explode( ",", $product_line );
			//商品IDをカートの商品IDと一致するものを表示
			if( $a == $product_array[0] ){
				echo "<tr>";
				echo "<td>" . $product_array[1] . "</td><td>" . $product_array[2] . "</td><td><img src='data/" . $product_array[3] . "'></td><td><a href='removeCart.php?remove_key=" . $key . "'>削除</a></td>";
				echo "</tr>";
                //合計値計算
                $num += $product_array[2];
			}
		}
        //配列キーカウント
        $key = $key + 1;
	}
?>
        <tr><th>合計</th><td colspan="3" style="text-align: center;"><?php echo $num; ?>円</td></tr>
	</table>
    <p><a href="productView.php">商品一覧へ戻る</a><a href="logout.php">ログアウト</a></p>

</body>
</html>
<!-- ▲表示 -->