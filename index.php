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

#####################USER PERMISSION##################################################################
	  $ch12 = curl_init();
curl_setopt($ch12, CURLOPT_URL, "https://api.telegram.org/bot$tok/getChatMember?chat_id=$cid&user_id=$reply_message_user_id"); 
curl_setopt($ch12, CURLOPT_POST, false); 
curl_setopt($ch12, CURLOPT_RETURNTRANSFER, 1); 
    $output212 = curl_exec($ch12);
$json122 = json_decode($output212,true);
    curl_close($ch122);
$can_send_messages =  $json122['result']['can_send_messages'];
$can_send_media_messages = $json122['result']['can_send_media_messages'];
$can_send_other_messages = $json122['result']['can_send_other_messages'];
$can_add_web_page_previews = $json122['result']['can_add_web_page_previews'];
##########################################################################################

#####################################CHECK ADMIN #########################################
$admi = curl_init();
curl_setopt($admi, CURLOPT_URL, "https://api.telegram.org/bot$tok/getChatMember?chat_id=$cid&user_id=$fid"); 
curl_setopt($admi, CURLOPT_POST, false); 
curl_setopt($admi, CURLOPT_RETURNTRANSFER, 1); 
    $output2121 = curl_exec($admi);
$json1221 = json_decode($output2121,true);
    curl_close($admi);
$status = $json1221['result']['status'];
#########################################################################################

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
	if (startsWith($text,'/mean')) {
	$word_array = explode(' ', $text);
	$word = $word_array['1'];
echo "https://api.urbandictionary.com/v0/define?term=$word";
	  $ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, "https://api.urbandictionary.com/v0/define?term=$word"); 
curl_setopt($ch1, CURLOPT_POST, false); 
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1); 
    $output21 = curl_exec($ch1);
$json12 = json_decode($output21,true);
    curl_close($ch1);
    echo $output21;
    $list = $json12['list'];
	$des = $json12['list']['0']['definition'];
$damns = $json12['list']['0']['example'];
if ($des == true) {
$mean = "
<b>Meaning Of Word [$word] </b> =>
==========================
<b>$des
\n\n$damns</b>


==========================

<i>Extracted From => Stark Dictionary Services Pvt. Ltd.</i>";
$message_send_meaning = [
	'chat_id'=>$cid,
	'text' => $mean,
	'parse_mode'=>'HTML',
	'reply_to_message_id'=>$mid,
];

botaction("sendMessage",$message_send_meaning);
}
else{
    	$not_found = [
    'chat_id'=>$cid,
	'text' => '<b>Please Give Meaning full Words dude !</b>',
	'parse_mode'=>'HTML',
	'reply_to_message_id'=>$mid,
];
botaction("sendMessage",$not_found);
}
}
	if (startsWith($text,'/logo')) {
		########LINKSIND##########
	$font_genarate_text1 = str_replace('/logo', "", $text);
	$font_genarate_text = str_replace(' ', "", $font_genarate_text1);
	if ($font_genarate_text == '') {
		echo "hell";
		$send_error = [
			'chat_id'=>$cid,
			'reply_to_message_id'=>$mid,
			'parse_mode'=>'HTML',
			'text'=>"<b>Please Give Me Some Text For Generating Dude..</b>"
		];
		botaction("sendMessage",$send_error);
	}
	else{
$font_list = array("https://www.linksind.net/tigerzindahai/spyder.php?name=$font_genarate_text&back=style2.jpg","https://linksind.net/arjunreddy/spyder.php?name=$font_genarate_text&back=style1.jpg","https://www.linksind.net/robo/spyder.php?name=$font_genarate_text&back=5.jpg","https://linksind.net/maari/spyder.php?name=$font_genarate_text&back=style1.jpg","https://linksind.net/cskjersey/spyder.php?name=$font_genarate_text&back=style1.jpg","https://www.linksind.net/padmavati/spyder.php?name=$font_genarate_text&back=style6.jpg","http://moviefontgenerator.com/krack/spyder.php?name=$font_genarate_text&back=default.jpg","https://linksind.net/dhonicdp/spyder.php?name=$font_genarate_text&back=style1.jpg","https://linksind.net/radheshyam/spyder.php?name=$font_genarate_text&back=style1.jpg","https://linksind.net/kohlijersey/spyder.php?name=$font_genarate_text&back=style1.jpg","https://linksind.net/gangleader/spyder.php?name=$font_genarate_text&back=default.jpg","https://linksind.net/baitikochichusthey/spyder.php?name=$font_genarate_text&back=default.jpg","https://linksind.net/adipurush/spyder.php?name=$font_genarate_text&back=default.jpg","
https://linksind.net/rrr/spyder.php?name=$font_genarate_text&back=style1.jpg");

		$font = $font_list[mt_rand(0,13)];

		$send_photo = [
		'chat_id' => ''.$cid.'',
        'caption' => '<b>Your Logo Is Generated Successfully....</b>',
        'parse_mode' => 'HTML',
        'reply_to_message_id'=>''.$mid.'',
        'photo'=>"$font"
    ];
    botaction("sendPhoto",$send_photo);
	}
	}
	if(startsWith($text,'/m')){
if (!in_array('1458344478', $admin_array)) {
	$i_am_not = [
		'chat_id'=>$cid,
		'text'=>'I am Not Admin To Mute And Unmute Members !!',
		'reply_to_message_id'=>$mid
	];
	botaction("sendMessage",$i_am_not);
}
else{
	$res = str_replace("/m", "", $text);
	if ($res == '') {
		$mute  = "<b>Silence Now...🤫🤫\n<a href='t.me/$reply_message_user_uname'>$reply_message_user_fname</a> Is Muted...🤐🔇</b>";
	}
	else{
		$mute = "<b>Silence Now...\n<a href='t.me/$reply_message_user_uname'>$reply_message_user_fname</a> Is Muted...🤐🔇\nReason => <i>$res</i></b>";
	}
	if ($reply_message) {
		if (in_array($reply_message_user_id, $admin_array)) {
	$no_cant = [
		'chat_id'=>$cid,
		'reply_to_message_id'=>$mid,
		'parse_mode'=>'HTML',
		'text'=>"<b> How High Are You To Mute An Admin</b>"
	];
		botaction("sendMessage",$no_cant);
}
elseif($reply_message_user_id == '1458344478'){
	$no_cant_ever = [
		'chat_id'=>$cid,
		'reply_to_message_id'=>$mid,
		'parse_mode'=>'HTML',
		'text'=>"<b>Have U became So Big To Mute Me??? Just Be In Your Limits</b>"
	];
		botaction("sendMessage",$no_cant);
}
		elseif($status == 'creator' || $status == 'administrator'){
		if (is_null($can_send_messages) or $can_send_messages == '1') {	# code
			$muting_member = [
			'chat_id'=>$cid,
			'user_id'=>$reply_message_user_id,
			'can_send_messages'=>'False'
		];
		botaction("restrictChatMember",$muting_member);
		$mute_message = [
		'chat_id'=>$cid,
		'reply_to_message_id'=>$mid,
		'parse_mode'=>'HTML',
		'disable_web_page_preview'=>'True',
		'text'=>"$mute"
		];
		botaction("sendMessage",$mute_message);
}
		else{
			$user_is_muted = [
			'chat_id'=>$cid,
			'text' => "<b>There Is already a Cheese Burger 🍔 in his Mouth 😁.. \n[<i>User Is Already Muted</i>]</b>",
			'parse_mode'=>'HTML',
			'reply_to_message_id'=>$mid,
				];
			botaction("sendMessage",$user_is_muted);
						}

		}


		else{
		$who1 = [
			'chat_id'=>$cid,
			'reply_to_message_id'=>$mid,
			'caption'=>"<b>Who The Hell Are You !! Only Admins Are Allowed To Perform This Action..\nWant A Infinity Snap ??🤜</b>",
			'parse_mode'=>'HTML',
			'video'=>'https://s2.gifyu.com/images/ezgif.com-gif-maker93d51c6b80ca89ad.gif',
		];
		botaction("sendVideo",$who1);
		}	

}
else{
	$no_reply = [
			'chat_id'=>$cid,
			'reply_to_message_id'=>$mid,
			'parse_mode'=>'HTML',
			'text'=>"<b>Is He A user??? Reply To A User's Message To Mute Him</b>"
		];
		botaction("sendMessage",$no_reply);
}
}
}
if (startsWith($text,'/um')) {	
	if ($reply_message == true) {
		if($status == 'creator' || $status == 'adminstrator'){
		if(is_null($can_send_messages) and is_null($can_send_media_messages) and is_null($can_send_other_messages) and is_null($can_add_web_page_previews) or $can_send_messages == '1' and $can_send_media_messages == '1' and $can_send_other_messages == '1' and $can_add_web_page_previews == '1'){
			$user_already_unmuted = [
			'chat_id'=>$cid,
			'reply_to_message_id'=>$mid,
			'parse_mode'=>'HTML',
			'text'=>"<b>User Is Already Unmuted..</b>"
		];
		botaction("sendMessage",$user_already_unmuted);
		}
		else{
		$unmute_message = [
			'chat_id'=>$cid,
			'reply_to_message_id'=>$mid,
			'parse_mode'=>'HTML',
			'text'=>"<b>$reply_message_user_fname Is Free Now... User Unmuted</b>"
		];
		botaction("sendMessage",$unmute_message);
$unmuting_member = [
'chat_id'=>$cid,
'user_id'=>$reply_message_user_id,
'can_send_messages'=>'True',
'can_invite_users'=>'True',
'can_pin_messages'=>'True',
'can_send_polls'=>'True',
'can_change_info'=>'True',
'can_send_media_messages'=>'True',
'can_send_other_messages'=>'True',
'can_add_web_page_previews'=>'True',
];
		botaction("restrictChatMember",$unmuting_member);
		print_r($dadel);
}
	}
	else{
		$who = [
			'chat_id'=>$cid,
			'reply_to_message_id'=>$mid,
			'caption'=>"<b>Who The Hell Are You !! Only Admins Are Allowed To Perform This Action..\nWant A Infinity Snap ??🤜</b>",
			'parse_mode'=>'HTML',
			'video'=>'https://s2.gifyu.com/images/ezgif.com-gif-maker93d51c6b80ca89ad.gif',
		];
		botaction("sendVideo",$who);
	}
}
	else{
		$no_reply = [
			'chat_id'=>$cid,
			'reply_to_message_id'=>$mid,
			'parse_mode'=>'HTML',
			'text'=>"<b>Is He A user??? Reply To A User's Message To Un-Mute Him</b>"
		];
		botaction("sendMessage",$no_reply);
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
