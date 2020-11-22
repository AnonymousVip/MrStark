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
		if ($files == '
		') {
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
		if ($files2 == '1') {
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
