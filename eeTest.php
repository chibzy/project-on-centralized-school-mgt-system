<?php
if(!isset($_SESSION)){
   session_start();
}
function decrypt($encrypted_string) { 
    $dirty = array("+", "/", "=");
    $clean = array("_PLUS_", "_SLASH_", "_EQUALS_");

    $string = base64_decode(str_replace($clean, $dirty, $encrypted_string));

    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $_SESSION['encryption-key'],$string, MCRYPT_MODE_ECB, $_SESSION['iv']);
    return $decrypted_string;
}
$data = ($_GET['data']);
$hash=($_GET['hash']);


if (hash_hmac('sha256', $data, $_SESSION['encryption-key'])== $hash) {
  //no tampering detected, proceed with other processing
	echo "The original text was <br><br>".decrypt($data);
	
} else {
  //tampering of data detected
	echo "data tampered with.";
	
}
