
<?php
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'basketballmanagementfeedback@gmail.com';
$password = 'Thomas123456';

/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

/* grab emails */
$emails = imap_search($inbox,'ALL');

/* if emails are returned, cycle through each... */
if($emails) {

	/* begin output var */
	$output = '';


	/* put the newest emails on top */
	rsort($emails);

	/* for every email... */
	foreach($emails as $email_number) {

		/* get information specific to this email */
		$overview = imap_fetch_overview($inbox,$email_number,0);
		$message = imap_fetchbody($inbox,$email_number,2);

		/* output the email header information */

		$output.="<tr>\n";
		$output.="<td>".$overview[0]->subject."</td>\n";

		$output.= "<td>".$overview[0]->from."</td>\n";
		$output.= "<td>".$overview[0]->date."</td>\n";
    $output.= "<td>".$message."</td>\n";
		$output.="</tr>\n";

		/* output the email body */
	}

  echo  $output;



}

/* close the connection */
imap_close($inbox);


?>
