<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ブログ記事の削除</title>
<link rel="stylesheet" href="css.css" type="text/css">
</head>
<body>
<h1>ブログ記事の編集</h1>
<?php
	try {
		
			//PDOクラスのオブジェクトの作成
		$dbh = new PDO('sqlite:blog.db','','');
		if(isset($_POST["id"])){
			if (!isset($_POST["password"]) || $_POST["password"] != 'abcdef') {
				echo '<p>パスワードが違います</p>';
			}
			else {
				
					//実行するSQL文を$sqlに格納
				$sql='delete from posts where id=?';
					//prepareメソッドでSQL文の準備
				$sth = $dbh->prepare($sql);
					//prepareした$sthを実行　SQL文の？部に格納する変数を指定
				$sth->execute(array($_POST["id"]));
				
				if ($sth) {
					echo "記事１件を削除しました";
				} else {
					echo "記事１件の削除に失敗しました";
				}
				
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
