<?php
error_reporting(0);
$tok = '1458344478:AAFEvxh1lrnEWQmgqNWMFwp64cYKT4G0_hI';

$update = file_get_contents('php://input');
$update = json_decode($update, true);

$update = file_get_contents('php://input');
$update = json_decode($update, true);


$mid = $update['message']['message_id'];
$cid = $update['message']['chat']['id'];
$uid = $update['message']['chat']['id'];
$cname = $update['message']['chat']['username'];
$fid = $update['message']['from']['id'];
$fname = $update['message']['from']['first_name'];
$lname = $update['message']['from']['last_name'];
$uname = $update['message']['from']['username'];
$typ = $update['message']['chat']['type'];
$text = $update['message']['text'];
$fullname = ''.$fname.' '.$lname.'';

##################NEW MEMBER DATA ################
$gname = $update['message']['chat']['title'];
$nid = $update['message']['new_chat_member']['id'];
$nfname = $update['message']['new_chat_member']['first_name'];
$nlname = $update['message']['new_chat_member']['last_name'];
$nuname = $update['message']['new_chat_member']['username'];
$nfullname = ''.$nfname.' '.$nlname.'';
#################################################
	$lfname = $update['message']['left_chat_member']['first_name'];
	$llname = $update['message']['left_chat_member']['last_name'];
$reply_message = $update['message']['reply_to_message'];
$reply_message_id = $update['message']['reply_to_message']['message_id'];
$reply_message_user_id = $update['message']['reply_to_message']['from']['id'];
$reply_message_text = $update['message']['reply_to_message']['text'];
$reply_message_user_fname = $update['message']['reply_to_message']['from']['first_name'];
$reply_message_user_lname = $update['message']['reply_to_message']['from']['last_name'];
$reply_message_user_uname = $update['message']['reply_to_message']['from']['username'];



$thugscripts_chat_id = '-1001291062558';
$chat_id = (string)$cid;
include 'default_welcome.php';

	$admin_json=[
		'chat_id'=>$thugscripts_chat_id
	];
	$curl232 = curl_init();
    curl_setopt($curl232, CURLOPT_URL,"https://api.telegram.org/bot$tok/getChatAdministrators?");
    curl_setopt($curl232, CURLOPT_POST, 1);
    curl_setopt($curl232, CURLOPT_POSTFIELDS, $admin_json);
    curl_setopt($curl232, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl232, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl232, CURLOPT_SSL_VERIFYPEER, 0);
 $resp22 = curl_exec($curl232);
    $adms = json_decode($resp22,true);
 $total = count($adms['result']);
 $array_admin = '';
    for ($i=0; $i < $total ; $i++) { 
    	$ddams = $adms['result'][$i]['user']['id'];
    	$admin_id_list =  "$ddams,";
    	$array_admin .= $admin_id_list;
    }
$admin_array = explode(',', $array_admin);
if (array_search($fid, $admin_array)) {
	$is_admin = true;
}
else{
	$is_admin = false;
}
function botaction($method, $data){
	global $tok;
	global $dadel;
	global $dueto;
    $url = "https://api.telegram.org/bot$tok/$method";
    $curld = curl_init();
    curl_setopt($curld, CURLOPT_POST, true);
    curl_setopt($curld, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curld, CURLOPT_URL, $url);
    curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($curld);
    curl_close($curld);
    $dadel = json_decode($output,true);
    $dueto = $dadel['description'];
    return $output;
}
function startsWith ($string, $startString) 
{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
}
if ($chat_id == $thugscripts_chat_id) {
	if (startsWith($text,'/setwelc')) {
		$custom_welcome_msg = str_replace('/setwelc', "", $text);
		$file = fopen('welcome.txt', 'r+');
		fwrite($file,$custom_welcome_msg);
		fclose($file); 
		$savewe=['chat_id'=>$cid,
		        'text' => 'Welcome Note Is Saved',
		        'reply_to_message_id'=>''.$mid.'',
	];
		botaction("sendMessage",$savewe);

	}

	if (startsWith($text,'/setgood')) {
		$custom_good_msg = str_replace('/setgood', "", $text);
		$file12 = fopen('goodbye.txt', 'r+');
		fwrite($file12,$custom_good_msg);
		fclose($file12); 
		$savewe12=['chat_id'=>$cid,
		        'text' => 'Welcome Note Is Saved',
		        'reply_to_message_id'=>''.$mid.'',
	];
		botaction("sendMessage",$savewe12);

	}


	if ($update['message']['new_chat_member'] == true) {
	if ($nid == '1458344478') {
		$mymes = "Hey $fullname ! Thank You For Adding Me In The Group. I Only Work For @Thugscripts2... I will Start My Work";

		$post3 = [
	        'chat_id' => ''.$cid.'',
	        'text' => ''.$mymes.'',
	        'reply_to_message_id'=>''.$mid.'',
	           ];
	    botaction("sendMessage",$post3);
	}
	else{
		$files = file_get_contents('welcome.txt');
		if ($files == '0') {
			$default_welcome_msg = $rand_welcome[mt_rand(0,count($rand_welcome)-1)];
			$default_wish_welcome = [
        'chat_id' => ''.$cid.'',
        'text' => ''.$default_welcome_msg.'',
        'reply_to_message_id'=>''.$mid.'',
            ];
            botaction("sendMessage",$default_wish_welcome);
		}
		else{
		$files = str_replace('{first}',$nfname, $files);
	    $files = str_replace('{first}',$nlname, $files);
	    $files = str_replace('{fullname}',$nfullname, $files);
	    $files = str_replace('{username}',$nuname, $files);
	    $files = str_replace('{id}',$nid, $files);
	    $files = str_replace('{chatname}',$gname, $files);

	    $wish_welcome = [
        'chat_id' => ''.$cid.'',
        'text' => ''.$files.'',
        'reply_to_message_id'=>''.$mid.'',
            ];
            botaction("sendMessage",$wish_welcome);


	}
  }
}
if ($update['message']['left_chat_member'] == true) {
		$files2 = file_get_contents('goodbye.txt');
		if ($files2 == '0') {
			$default_goodbye_msg = $rand_goodbye[mt_rand(0,count($rand_goodbye)-1)];
			$default_wish_goob = [
        'chat_id' => ''.$cid.'',
        'text' => ''.$default_goodbye_msg.'',
        'reply_to_message_id'=>''.$mid.'',
            ];
            botaction("sendMessage",$default_wish_goob);
		}
		else{
		$files2 = str_replace('{first}',$lfname, $files2);
	    $files2 = str_replace('{first}',$llname, $files2);
	    $files2 = str_replace('{fullname}',$lfullname, $files2);

	    $wish_good = [
        'chat_id' => ''.$cid.'',
        'text' => ''.$files2.'',
        'reply_to_message_id'=>''.$mid.'',
            ];
            botaction("sendMessage",$wish_good);


	}
  }
  if (startsWith($text,'/pun')) {
  	if ($reply_message == true) {
  	$pin_message = [
  		'chat_id'=>$cid,
  		'message_id'=>$reply_message_id
  	];
  	botaction('pinChatMessage',$pin_message);
  	print_r($dadel);
  	if ($dueto == 'Bad Request: not enough rights to manage pinned messages in the chat') {
  		$noam = [
  			'chat_id'=>$cid,
  		'reply_to_message_id'=>$mid,
  		'text'=>"I am Not Admin In This Group..! \nThis Is Sed.. \nAlexa Play Tera Baap aaya"
  	];
  	  		botaction("sendMessage",$noam);

  	}
  }
  else{
  	$rme = [
  		'chat_id'=>$cid,
  		'reply_to_message_id'=>$mid,
  		'text'=>"Reply To A Message To Pin It My Dear.."
  	];
  	botaction("sendMessage",$rme);
  }
}


  if (startsWith($text,'/unpun')) {
  	$unpin_message = [
  		'chat_id'=>$cid,
  	];
  	botaction('unpinChatMessage',$unpin_message);
  	print_r($dadel);
  	if ($dueto == 'Bad Request: not enough rights to manage pinned messages in the chat') {
  		$nowam = [
  			'chat_id'=>$cid,
  		'reply_to_message_id'=>$mid,
  		'text'=>"I am Not Admin In This Group..! \nThis Is Sed.. \nAlexa Play Tera Baap aaya"
  	];
  	  		botaction("sendMessage",$nowam);

  	}
}
  if (startsWith($text,'/unpunall')) {
  	$unpin_all_message = [
  		'chat_id'=>$cid,
  	];
  	botaction('unpinAllChatMessages',$unpin_all_message);
  	print_r($dadel);
  	if ($dueto == 'Bad Request: not enough rights to manage pinned messages in the chat') {
  		$noqwam = [
  			'chat_id'=>$cid,
  		'reply_to_message_id'=>$mid,
  		'text'=>"I am Not Admin In This Group..! \nThis Is Sed.. \nAlexa Play Tera Baap aaya"
  	];
  	  		botaction("sendMessage",$noqwam);

  	}
}
if (startsWith($text,'/delt')) {
	if ($reply_message == true) {
		$check = 'Yes';
if (array_search($fid, $admin_array)) {
		$del_message = [
			'chat_id'=>$cid,
			'message_id'=>$reply_message_id
		];
		$del_comm = [
			'chat_id'=>$cid,
			'message_id'=>$mid
		];
		botaction("deleteMessage",$del_message);
		botaction("deleteMessage",$del_comm);
	}
else{
	$ince = [
		'chat_id'=>$cid,
  		'reply_to_message_id'=>$mid,
  		'text'=>"Only Admins Can Execute This Command !!"
	];
	 botaction('sendMessage',$ince);
}
}
	else{
		$noams = [
			'chat_id'=>$cid,
  		'reply_to_message_id'=>$mid,
  		'text'=>"Reply To A Message Dude!"
  	];
  	botaction('sendMessage',$noams);
  	print_r($dadel);
	}
}
if (startsWith($text,'/promo')) {
	echo $reply_message_id;
	$promote_member = [
		'chat_id'=>$cid,
		'user_id'=>$reply_message_user_id,
		'can_change_info'=>'True',
        'can_edit_messages'=>'False',
        'can_delete_messages'=>'True',
        'can_invite_users'=>'True',
        'can_pin_messages'=>'True',
        'can_restrict_members'=>'True',
        'can_promote_members'=>'False',
        	];
botaction('promoteChatMember',$promote_member);
if ($dueto == true) {
	$cpm = [
		'chat_id'=>$cid,
		'text'=> "Can't Promote Member \nReason => $dueto",
		'reply_to_message_id'=>$mid
	];
	botaction("sendMessage",$cpm);
}
else{
	$mp = [
		'chat_id'=>$cid,
		'text'=> "Promoted Successfully",
		'reply_to_message_id'=>$mid
	];
		botaction("sendMessage",$mp);

}
}
	if (startsWith($text,'/past')) {
	if ($reply_message == true) {
$paste = [
'content'=> $reply_message_text
];
  $curl3 = curl_init();
    curl_setopt($curl3, CURLOPT_URL,"https://nekobin.com/api/documents");
    curl_setopt($curl3, CURLOPT_POST, 1);
    curl_setopt($curl3, CURLOPT_POSTFIELDS, $paste);
    curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl3, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl3, CURLOPT_SSL_VERIFYPEER, 0);
$response3 = curl_exec($curl3);
$json = json_decode($response3,true);

if ($json['ok']== '1') {
	$key = $json['result']['key'];
	$urrl = "https://nekobin.com/$key";
	$textt = "Pasted Successfully To *Nekobin*!! \nUrl : $urrl";
	$send_paste = [
		'chat_id'=>$cid,
		'text'=>$textt,
		'reply_to_message_id'=>$mid,
		'disable_web_page_preview'=>'True',
	];
	botaction("sendMessage",$send_paste);
}
else{
	$error_paste_text = $json['error'];
	$error_paste = [
		'chat_id'=>$cid,
		'text'=>$error_paste_text,
		'reply_to_message_id'=>$mid,
	];
	botaction("sendMessage",$error_paste);
	}
}
else{
	$reply_error = [
		'chat_id'=>$cid,
		'text'=>'Whadya Want To Paste????',
		'reply_to_message_id'=>$mid
	];
	botaction("sendMessage",$reply_error);
}
}

if(startsWith($text,'/id')){
	if ($reply_message == true) {
		$id_of_user = [
			'chat_id'=>$cid,
			'text' => "$reply_message_user_fname $reply_message_user_lname's Id is <code>$reply_message_user_id</code>",
			'parse_mode' => 'HTML',
			'reply_to_message_id'=>$mid,
		];
		botaction("sendMessage",$id_of_user);	
	}
	else{
		$id_of_group = [
			'chat_id'=>$cid,
			'text'=>"This Group's Id Is : <code>$cid</code>",
			'parse_mode' => 'HTML',
			'reply_to_message_id'=>$mid,
		];
		botaction("sendMessage",$id_of_group);

	}
}
$spam = '#help';
if (strrpos($text, $spam) || startsWith($text,'#help')) {
foreach ($admin_array as $admin_id) {
	$ia = [
		'chat_id'=>$admin_id,
		'text' => "<b>A Message Tagged With #help has been Found In @Thugscripts2.. Check It Master</b>",
		'parse_mode' => 'HTML',
	];
botaction("sendMessage",$ia);
	$sta=[
	'chat_id'=>$admin_id,
	'from_chat_id' => $cid,
	'message_id'=>$mid,
];
botaction("forwardMessage",$sta);
print_r($dadel);
}
	$sen = [
			'chat_id'=>$cid,
			'text' => "<b>Thank You Tagging This Message With #help.. It Will Be Forwarded to All The Admins In This Channel !!</b>",
			'parse_mode' => 'HTML',
			'reply_to_message_id'=>$mid,
		];
		botaction("sendMessage",$sen);	
}
if (startsWith($text,'/ping')) {
	$ping_message = [
		'chat_id'=>$cid,
		'text'=>'Pinging',
		'reply_to_message_id'=>$mid
	];
	$edit_id = (int)$mid+1;
	$start_time = microtime(true);
	// botaction("sendMessage",$ping_message);

	$url2 = "https://api.telegram.org/bot$tok/sendMessage";
    $curld2 = curl_init();
    curl_setopt($curld2, CURLOPT_POST, true);
    curl_setopt($curld2, CURLOPT_POSTFIELDS, $ping_message);
    curl_setopt($curld2, CURLOPT_URL, $url2);
    curl_setopt($curld2, CURLOPT_RETURNTRANSFER, true);
    $output2 = curl_exec($curld2);
    curl_close($curld2);
    $damn = json_decode($output2,true);
	$editing_id = $damn['result']['message_id'];
	$end_time = microtime(true); 
	$ping_time = ($end_time - $start_time)*1000; 
	$ping_time = number_format((float)$ping_time, 3, '.', '')." ms";
	$ping_message_to_send = "                              
█▀█ █▀█ █▄░█ █▀▀
█▀▀ █▄█ █░▀█ █▄█
<b>Time Taken</b> => <code>$ping_time</code>";
	$ping_edit_message=[
		'chat_id'=>$cid,
		'message_id'=>$editing_id,
		'text'=>"$ping_message_to_send",
		'parse_mode'=>'HTML'
	];
	botaction("editMessageText",$ping_edit_message);
 print_r($dadel);
}
if (startsWith($text,'/textart')) {
	if ($reply_message == true) {
		$dadel_text = urlencode($reply_message_text);
$ch1 = curl_init(); 
curl_setopt($ch1, CURLOPT_URL, "https://artii.herokuapp.com/make?text=$dadel_text"); 
curl_setopt($ch1, CURLOPT_POST, false); 
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1); 
$output1231 = curl_exec($ch1); 
$json1231 = json_decode($output1231,true);
curl_close($ch);
echo $output1231;
	$send_text_art2 = [
		'chat_id'=>$cid,
		'text'=> "<code>$output1231</code>",
		'parse_mode'=>'HTML',
	];
	botaction("sendMessage",$send_text_art2);

	}
	else{
	$text_art_text = urlencode(str_replace('/textart', "", $text));
	if ($text_art_text == "") {
		$null_message = [
			'chat_id'=> $cid,
			'text'=> "<b>I Wish The Text is All In Your Mind.. Not Beside The Command </b><i>\nSyntax</i> = > <code>/textart Your-Mesage</code>",
			'reply_to_message_id'=>$mid,
			'parse_mode'=>'HTML',
		];
		print_r($null_message);
		botaction("sendMessage",$null_message);
		print_r($dadel);
	}
	else{
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "https://artii.herokuapp.com/make?text=$text_art_text"); 
curl_setopt($ch, CURLOPT_POST, false); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$output123 = curl_exec($ch); 
$json123 = json_decode($output123,true);
curl_close($ch);
echo $output123;
	$send_text_art = [
		'chat_id'=>$cid,
		'text'=> "<code>$output123</code>",
		'parse_mode'=>'HTML',
	];
	botaction("sendMessage",$send_text_art);
}
}
}
}
else{
	echo "Hi";
	if ($typ == 'private') {
		echo "Hi";
	$leave = [
		'chat_id'=>''.$cid.'',
		'message_id'=>''.$mid.''];
	botaction("deleteMessage",$leave);
}
else{
	$leave2 = [
		'chat_id'=>''.$cid.'',
];
	botaction("leaveChat",$leave2);
}
}
?>
