// Email address validation function

function valid_email ($email) {
if (eregi("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$", $email, $check)) {
if ( getmxrr(substr(strstr($check[0], '@'), 1), $validate_email_temp) ) {
return TRUE;
}
}
return FALSE;
}
