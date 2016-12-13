<?php
//数字を2ケタのString型に変換
function num_to_str($num){
	if(0 <= $num && $num <= 9){
		return "0". (string)$num;
	}
	else{
		return (string)$num;
	}
}
ini_set("max_execution_time",180);

//$n = 1; // 第n
//$w = "月"; // w曜日
//echo funcDesignatedDay($n, $w);先月の指定回目、指定日の日にちを取得します

function funcDesignatedDay($n, $w){
	$year_val = date("Y",strtotime("-1 month")); // 年を取得
	$month_val =date("m",strtotime("-1 month")); // 月を取得

	$arr_week = array("日", "土", "金", "木", "水", "火", "月");

	for($i = 0; $i <= count($arr_week)-1; $i++){
		if($w == $arr_week[$i]){
			$w_no = $i;
		}
	}

	// 曜日番号を取得(0:日曜日～6:土曜日)
	$week_no = date('w',strtotime("$year_val/$month_val/1"));

	$d = (7*$n)+1;
	if((8 - ($week_no + $w_no)) <= 0){
		$day = ($d - ($week_no + $w_no) + 7);
	}else{
		if($w_no == 0 && $week_no == 0){
			$day = ($d - ($week_no + $w_no) - 7);
		}else{
			$day = ($d - ($week_no + $w_no));
		}
	}
	return $day;
}


//現在日時を取得して検索条件に加える
$year=date('Y');
$tomonth=date('m');
$today=date('d');
$day_ago=date("d",strtotime("-1 day")); //１日前
$month_ago=(String)date("m",strtotime("-1 month")); //先月
$year_ago=(String)date("Y",strtotime("-1 month")); //先月の年
$count=0;
$sum=0;
$negapozi=0;
$name=(String)$_SESSION['id'];//stringに変換

//day<=7
$twenty_four_count=0;
$n = 1; // 第n
$w = "月"; // w曜日
$search_day=(String)funcDesignatedDay($n, $w);

while($twenty_four_count<24){
	$hour=num_to_str($twenty_four_count);
	$week1=tweets_search(array("user_id" =>$name, "year" => $year_ago, "month" => $month_ago,"day" => "0".$search_day,"hour"=>$hour));
	$tweet_count=$week1->count();
	if(!$tweet_count==0){
		foreach ($week1 as $res) {
			$sum=$sum + ($res['emotion_point']);
			$count=$count + 1;
		}

		$ave=$sum/$count;
		$negapozi=round($ave,3);
		$count=0;
		$sum=0;
	}
	else{$negapozi=0;}
	$twenty_four_count++;
	$mon_week1[]=$negapozi;
}
$con_mon_week1 = implode(",", $mon_week1);


//7<day<=14
$twenty_four_count=0;
$n = 2; // 第n
$w = "月"; // w曜日
$search_day=(String)funcDesignatedDay($n, $w);
while($twenty_four_count<24){
	$hour=num_to_str($twenty_four_count);
	$week2=tweets_search(array("user_id" =>$name, "year" => $year_ago, "month" => $month_ago,"day" => $search_day,"hour"=>$hour));


	$tweet_count=$week2->count();
	if(!$tweet_count==0){
		foreach ($week2 as $res) {
			$sum=$sum + ($res['emotion_point']);
			$count=$count + 1;
		}

		$ave=$sum/$count;
		$negapozi=round($ave,3);
		$count=0;
		$sum=0;
	}
	else{$negapozi=0;}
	$twenty_four_count++;
	$mon_week2[]=$negapozi;
}
$con_mon_week2 = implode(",", $mon_week2);


//14<day<=21
$twenty_four_count=0;
$n = 3; // 第n
$w = "月"; // w曜日
$search_day=(String)funcDesignatedDay($n, $w);
while($twenty_four_count<24){
	$hour=num_to_str($twenty_four_count);
	$week3=tweets_search(array("user_id" =>$name, "year" => $year_ago, "month" => $month_ago,"day" => $search_day,"hour"=>$hour));

	$tweet_count=$week3->count();
	if(!$tweet_count==0){
		foreach ($week3 as $res) {
			$sum=$sum + ($res['emotion_point']);
			$count=$count + 1;
		}

		$ave=$sum/$count;
		$negapozi=round($ave,3);
		$count=0;
		$sum=0;
	}
	else{$negapozi=0;}
	$twenty_four_count++;
	$mon_week3[]=$negapozi;
}
$con_mon_week3 = implode(",", $mon_week3);


//21<day<=28
$twenty_four_count=0;
$n = 4; // 第n
$w = "月"; // w曜日
$search_day=(String)funcDesignatedDay($n, $w);
while($twenty_four_count<24){
	$hour=num_to_str($twenty_four_count);
	$week4=tweets_search(array("user_id" =>$name, "year" => $year_ago, "month" => $month_ago,"day" => $search_day,"hour"=>$hour));

$tweet_count=$week4->count();

if(!$tweet_count==0){
	foreach ($week4 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi=0;}
$twenty_four_count++;
$mon_week4[]=$negapozi;
}
$con_mon_week4 = implode(",", $mon_week4);

//day>28
//先月の最終日を取得
$last_day=date('d', mktime(0, 0, 0, date('m'), 0, date('Y')));


$twenty_four_count=0;
$n = 5; // 第n
$w = "火"; // w曜日
$search_day=(String)funcDesignatedDay($n, $w);

if($last_day>=funcDesignatedDay($n, $w)){
while($twenty_four_count<24){
	$hour=num_to_str($twenty_four_count);
	$week5=tweets_search(array("user_id" =>$name, "year" => $year_ago, "month" => $month_ago,"day" => $search_day,"hour"=>$hour));


	$tweet_count=$week5->count();
	if(!$tweet_count==0){
		foreach ($week5 as $res) {
			$sum=$sum + ($res['emotion_point']);
			$count=$count + 1;
		}

		$ave=$sum/$count;
		$negapozi=round($ave,3);
		$count=0;
		$sum=0;
	}
	else{$negapozi=0;}
	$twenty_four_count++;
	$mon_week5[]=$negapozi;
}
$con_mon_week5 = implode(",", $mon_week5);

}
else{$con_mon_week5="0";}
 ?>