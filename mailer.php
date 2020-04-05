<?php
require("header.php");
if(isset($_POST['address']) and isset($_POST['recv']) and isset($_POST['msg']) and isset($_POST['sub']) and isset($_POST['reply']) )
{
	$from=filter_var($_POST['address'],FILTER_SANITIZE_EMAIL);
	$to=filter_var($_POST['recv'],FILTER_SANITIZE_EMAIL);
	$msg=filter_var($_POST['msg'],FILTER_SANITIZE_STRING);
	$sub=filter_var($_POST['sub'],FILTER_SANITIZE_STRING);
	$reply=filter_var($_POST['reply'],FILTER_SANITIZE_EMAIL);
	#extra security to validate the variables that they have only email addresses

		$header="From: ".$from;
		$header.="\r\nReply-To: ".$reply;
		$retval=mail($to,$sub,$msg,$header);
		if($retval==true)
		{
				echo'
				<h1 >MAIL SUCEESFULLY DELIVERED TO '.$to.' FROM '.$from.' </h1>';
		}else{
		echo'
		<h1 class="error">[!]THE EMAIL WASN\'T DELIVERED. CHECK THE INPUT BEFORE RETRYING</h1>';
	 }
}

else{
	?>
	<form method="post" class="mail_form" action="<?PHP echo $_SERVER['PHP_SELF'] ?>">
			<H1 style="">SPOOFY <h3>THE MAILER</h3></H1><br/>
			SPOOFED EMAIL:<br/><input type="text" name="address"/><br/>
			RECEIVER'S EMAIL:<br/><input type="text" name="recv"/><br/>
			EMAIL SUBJECT:<br/><input type="text" name="sub"/><br/>
			REPLY-TO EMAIL:<br/><input type="text" name="reply"/><br/>
			MESSAGE:<br/><textarea type="text" name="msg" rows="4" cols="10"></textarea><br/>
			<br/><input type="submit" value="Submit"/>
		</form><br/>

<?php
}
require("footer.php");
?>
