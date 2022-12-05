<?php

$email = htmlspecialchars($_POST["subscribe_email"]);

$refferer = getenv('HTTP_REFERER');
$boundary = md5(time());
$eol = "\r\n";
$msgToAdmin = "";

$date = date("d.m.y");
$time = date("H:i");

$myEmail = 'exemple@gamil.com';

$subjectToAdmin = "=?UTF-8?B?" . base64_encode("Oh!Oh! New Subscriber!") . "?= ";

// HTML-version
$msgHTMLToMyEmail = "<html><body>
subscribe-<br><br>
Email: $email<br>

Refferer (link): $refferer
</body></html>";

// TXT-version
$msgTXTToMyEmail = "
subscribe-
Email: $email

Refferer (link): $refferer
";

$msgToAdmin .= "Content-Type: multipart/alternative" . $eol . $eol;

$msgToAdmin .= "--" . $boundary . $eol;
$msgToAdmin .= "Content-Type: text/plain; charset=utf-8" . $eol;
$msgToAdmin .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
$msgToAdmin .= $msgTXTToMyEmail . $eol . $eol;

$msgToAdmin .= "--" . $boundary . $eol;
$msgToAdmin .= "Content-Type: text/html; charset=utf-8" . $eol;
$msgToAdmin .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
$msgToAdmin .= $msgHTMLToMyEmail . $eol . $eol;

$msgToAdmin .= "--" . $boundary . "--" . $eol . $eol;

$headersToAdmin = "From: CryptoCON <'" . $myEmail . "'>" . $eol . "Reply-To: CryptoCON <'" . $myEmail . "'>" . $eol . "Return-Path: CryptoCON <'" . $myEmail . "'>" . $eol . "MIME-Version: 1.0" . $eol . "Content-type: multipart/alternative; boundary=\"" . $boundary . "\"" . $eol . "Subject: " . $subjectToAdmin . $eol;

mail($myEmail, $subjectToAdmin, $msgToAdmin, $headersToAdmin);

/*-- Save To File All Subscribes --*/

$f = fopen("assets/php/leads.xls", "a+");
fwrite($f, " <tr>");
fwrite($f, " <td>Email: $email</td>");
fwrite($f, " <td>$refferer</td>");
fwrite($f, " </tr>");
fwrite($f, "\n ");
fclose($f);
