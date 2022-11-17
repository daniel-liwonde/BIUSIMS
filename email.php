<?php
$row = mysqli_fetch_array($query);
									$pass=$row['password'];
									$message = 
"Here are your password details ...\n
User Email: $mail \n
Passwd: $pass \n

Thank You

Administrator
______________________________________________________
THIS IS AN AUTOMATED RESPONSE. 
***DO NOT RESPOND TO THIS EMAIL****
";

	mail($mail, "Password", $message,
    "From: \"User Registration\" <auto-replyBIU SIMS>\r\n" .
     "X-Mailer: PHP/" . phpversion());	
	 ?>					 			 
<div class="alert alert-info">Your password has been sent to your email address.</div>
						 						