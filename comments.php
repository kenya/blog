<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ブログ記事の削除</title>
<link rel="stylesheet" href="css.css" type="text/css">
</head>
<body>
<h1>コメント投稿</h1>
<?php
	try {
		
			//PDOクラスのオブジェクトの作成
		$dbh = new PDO('sqlite:blog.db','','');
		if(isset($_POST["contents"])){
				//タイムゾーンの指定
			ini_set("date.timezone", "Asia/Tokyo");
				//$timeへ成形した年月日および時刻データを格納
			$time=date("Y.m.d-H:i");
				//実行するSQL文を$sqlに格納
			$sql='insert into comments(pid, contents, date)values(?, ?, ?)';
				//prepareメソッドでSQL文の準備
			$sth = $dbh->prepare($sql);
				//prepareした$sthを実行　SQL文の？部に格納する変数を指定
			$sth->execute(array($_POST["pid"], $_POST["contents"], $time));
			
			echo $_POST["contents"];
			if ($sth) {
				echo "コメントしました";
			} else {
				echo "コメントに失敗しました";
			}
		}
		
		$dbh = null;
		
	} Catch (PDOException $e) {
		print "エラー!: " . $e->getMessage() . "<br/>";
		die();
	}
	
	?>
<p>go to <a href="index.php">index.php</a></p>
<footer>
<hr>
<p>Copyright (C) 2014 g1244587. All Rights Reserved.</p>
</footer>
</body>
</html>