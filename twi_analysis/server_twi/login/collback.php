<?php
session_start();

define("Consumer_Key", "vfQ2SASQcoLdl1cqdwmMOD2yJ");
define("Consumer_Secret", "zspEuzKLR1QgraXnqaZOXxBBgTSSa0dOwyWpUYHLWnvjND7eqa");

//ライブラリを読み込む
include '../DBManager.php';
require "twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

//oauth_tokenとoauth_verifierを取得
if($_SESSION['oauth_token'] == $_GET['oauth_token'] and $_GET['oauth_verifier']){

	//Twitterからアクセストークンを取得する
	$connection = new TwitterOAuth(Consumer_Key, Consumer_Secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	$access_token = $connection->oauth('oauth/access_token', array('oauth_verifier' => $_GET['oauth_verifier'], 'oauth_token'=> $_GET['oauth_token']));

	//取得したアクセストークンでユーザ情報を取得
	$user_connection = new TwitterOAuth(Consumer_Key, Consumer_Secret, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	$user_info = $user_connection->get('account/verify_credentials');

	// ユーザ情報の展開
	//var_dump($user_info);

	//適当にユーザ情報を取得
	$id = $user_info->id;
	$name = $user_info->name;
	$screen_name = $user_info->screen_name;
	$profile_image_url_https = $user_info->profile_image_url_https;
	$text = $user_info->status->text;

	//各値をセッションに入れる
	$_SESSION['access_token'] = $access_token;
	$_SESSION['access_token_secret'] = $access_token['oauth_token_secret'];
	$_SESSION['id'] = $id;
	$_SESSION['name'] = $name;
	$_SESSION['screen_name'] = $screen_name;
	$_SESSION['text'] = $text;
	$_SESSION['profile_image_url_https'] = $profile_image_url_https;

//DBへユーザー情報追加----------------
// 	$mongo = new MongoClient("35.162.58.174:27017");
// 	$db = $mongo->selectDB("twi_analysis");
// 	$collection = $db->selectCollection("user_data");

//既に登録されているuser_idがあるか
	$con = array('user_id' => $_SESSION['id']);
	$select = user_search($con);
// 	$select = $collection->find($con);
	foreach ($select as $doc) {
		$res=($doc);
	}
if($res == null){

	//件数をidにする----
	$auto_no = user_count();
// 	$auto_no = $collection->count();  //件数取得
	//インサート
	$collection->insert(array("user_id" => $_SESSION['id'], "user_name" => $_SESSION['name'], "screen_id" => $_SESSION['screen_name'], "profile_image" => $_SESSION['profile_image_url_https']));
//DB追加終了
}

	header('Location: ../main/main.php');
	exit();
}else{
	header('Location: ../main/main.php');
	exit();
}


