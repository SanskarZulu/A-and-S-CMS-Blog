<?php
include('database.inc.php');
$msg="";
if(isset($_POST['Username']) && isset($_POST['Email']) && isset($_POST['Password'])){
	$Username=mysqli_real_escape_string($con,$_POST['Username']);
	$Email=mysqli_real_escape_string($con,$_POST['Email']);
	$Password=mysqli_real_escape_string($con,$_POST['Password']);
	
	mysqli_query($con,"insert into notify_user(Username,Email,Password) values('$Username','$Email','$Password')");
	$msg="Email is sent to the User";
	
	$html="<table><tr>Your request to join the blog has been approved</tr>
				<tr>These are your temporary password please change it.</tr>
				<tr><td>Email :</td><td>$Email</td></tr>
				<tr><td>Username :</td><td>$Username</td></tr>
				<tr><td>Password :</td><td>$Password</td></tr>
				</table>";
	
	include('smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="renolilawerence@gmail.com";
	$mail->Password="tempphppassword";
	$mail->SetFrom("renolilawerence@gmail.com");
	$mail->addAddress("renolilawerence@gmail.com");
	$mail->IsHTML(true);
	$mail->Subject="Request Approved";
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
		//echo "Mail send";
	}else{
		//echo "Error occur";
	}
	echo $msg;
}
?>