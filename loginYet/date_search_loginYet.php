<?php

/*******************************/
session_start();

require_once ('../child_classes/instagram.php');

/*
//ログインされているか判断
$result = Instagram::checkLogin();

if(!$result){
	$_SESSION['login_err'] = 'ユーザー登録をして、ログインをして下さい。';
	header('Location: ../login/public/login_form.php');
	return;
}

$login_user = $_SESSION['login_user'];
*/

/*******************************/

//ヘッダーを表示
require_once ('../header_loginYet.php');

//送信された値を受け取る
$instagrams = $_POST;

//クラスを使う
$instagram = new Instagram();

$year = $instagrams['year'];
$month = $instagrams['month'];

$date = "$year"."$month";

//検索
$post = $instagram->dataSearch($date);//$instagram->titleSearch($instagrams['searchWord']);
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/9f2e7499ce.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<title>udastagram</title>
</head>
<body>
<section id="title_searchphp">

<h2 class="search-word">検索日付：<?php echo $year."年".$month."月"?></h2>


<!--投稿があるか確認する-->
<?php 
$post_all = [];
foreach($post as $publish){
	if($publish['publish_status'] == 1){
		$post_all[] = $publish;
	}
}
?>
<?php if(empty($post_all)):?>
	<div class="spacer_50"></div>
	<p>検索された日付の投稿はありません。</p>
<?php endif;?>



<!--最新の投稿を一番上に表示するためのソート-->
<?php arsort($post);?>

<section class="insta-list-all">

<!--全ての投稿を表示-->
<?php require_once ('post_display_loginYet.php');?>

</section>

<!--いいねボタンテスト-->
<script src="../js/good_btn.js"></script>
<!--いいねボタンテスト-->

<!--スライドテスト-->
<script src="../js/slide.js"></script>
<!--スライドテスト-->

<section class="spacer_50"></section>
<div class="return-btn"><a href="./index_loginYet.php?year=<?php echo date("Y")?>&month=<?php echo date("m")?>">トップへ戻る</a></div>
<section class="spacer_50"></section>
</section>
</body>
</html>