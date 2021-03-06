<?php

$hidden_hash_var='your_password_here';

$LOGGED_IN=false;
//clear it out in case someone sets it in the URL or something
unset($LOGGED_IN);

/*

create table user (
user_id int not null auto_increment primary key,
user_name text,
real_name text,
email text,
password text,
remote_addr text,
confirm_hash text,
is_confirmed int not null default 0
);

*/

function user_isloggedin() {
	global $user_name,$id_hash,$hidden_hash_var,$LOGGED_IN;
	//have we already run the hash checks? 
	//If so, return the pre-set var
	if (isset($LOGGED_IN)) {
		return $LOGGED_IN;
	}
	if ($user_name && $id_hash) {
		$hash=md5($user_name.$hidden_hash_var);
		if ($hash == $id_hash) {
			$LOGGED_IN=true;
			return true;
		} else {
			$LOGGED_IN=false;
			return false;
		}
	} else {
		$LOGGED_IN=false;
		return false;
	}
}

function user_login($user_name,$password) {
	global $feedback;
	if (!$user_name || !$password) {
		$feedback .=  ' ERROR - Missing user name or password ';
		return false;
	} else {
		$user_name=strtolower($user_name);
		$password=strtolower($password);
		$sql="SELECT * FROM user WHERE user_name='$user_name' AND password='". md5($password) ."'";
		$result=db_query($sql);
		if (!$result || db_numrows($result) < 1){
			$feedback .=  ' ERROR - User not found or password incorrect ';
			return false;
		} else {
			if (db_result($result,0,'is_confirmed') == '1') {
				user_set_tokens($user_name);
				$feedback .=  ' SUCCESS - You Are Now Logged In ';
				return true;
			} else {
				$feedback .=  ' ERROR - You haven\'t Confirmed Your Account Yet ';
				return false;
			}
		}
	}
}

function user_logout() {
	setcookie('user_name','',(time()+2592000),'/','',0);
	setcookie('id_hash','',(time()+2592000),'/','',0);
}

function user_set_tokens($user_name_in) {
	global $hidden_hash_var,$user_name,$id_hash;
	if (!$user_name_in) {
		$feedback .=  ' ERROR - User Name Missing When Setting Tokens ';
		return false;
	}
	$user_name=strtolower($user_name_in);
	$id_hash= md5($user_name.$hidden_hash_var);

	setcookie('user_name',$user_name,(time()+2592000),'/','',0);
	setcookie('id_hash',$id_hash,(time()+2592000),'/','',0);
}

function user_confirm($hash,$email) {
	/*
		Call this function on the user confirmation page,
		which they arrive at when the click the link in the
		account confirmation email
	*/

	global $feedback,$hidden_hash_var;

	//verify that they didn't tamper with the email address
	$new_hash=md5($email.$hidden_hash_var);
	if ($new_hash && ($new_hash==$hash)) {
		//find this record in the db
		$sql="SELECT * FROM user WHERE confirm_hash='$hash'";
		$result=db_query($sql);
		if (!$result || db_numrows($result) < 1) {
			$feedback .= ' ERROR - Hash Not Found ';
			return false;
		} else {
			//confirm the email and set account to active
			$feedback .= ' User Account Updated - You Are Now Logged In ';
			user_set_tokens(db_result($result,0,'user_name'));
			$sql="UPDATE user SET email='$email',is_confirmed='1' WHERE confirm_hash='$hash'";
			$result=db_query($sql);
			return true;
		}
	} else {
		$feedback .= ' HASH INVALID - UPDATE FAILED ';
		return false;
	}
}

function user_change_password ($new_password1,$new_password2,$change_user_name,$old_password) {
	global $feedback;
	//new passwords present and match?
	if ($new_password1 && ($new_password1==$new_password2)) {
		//is this password long enough?
		if (account_pwvalid($new_password1)) {
			//all vars are present?
			if ($change_user_name && $old_password) {
				//lower case everything
				$change_user_name=strtolower($change_user_name);
				$old_password=strtolower($old_password);
				$new_password1=strtolower($new_password1);
				$sql="SELECT * FROM user WHERE user_name='$change_user_name' AND password='". md5($old_password) ."'";
				$result=db_query($sql);
				if (!$result || db_numrows($result) < 1) {
					$feedback .= ' User not found or bad password '.db_error();
					return false;
				} else {
					$sql="UPDATE user SET password='". md5($new_password1). "' ".
						"WHERE user_name='$change_user_name' AND password='". md5($old_password). "'";
					$result=db_query($sql);
					if (!$result || db_affected_rows($result) < 1) {
						$feedback .= ' NOTHING Changed '.db_error();
						return false;
					} else {
						$feedback .= ' Password Changed ';
						return true;
					}
				}
			} else {
				$feedback .= ' Must Provide User Name And Old Password ';
				return false;
			}
		} else {
			$feedback .= ' New Passwords Doesn\'t Meet Criteria ';
			return false;
		}
	} else {
		return false;
		$feedback .= ' New Passwords Must Match ';
	}
}

function user_lost_password ($email,$user_name) {
	global $feedback,$hidden_hash_var;
	if ($email && $user_name) {
		$user_name=strtolower($user_name);
		$sql="SELECT * FROM user WHERE user_name='$user_name' AND email='$email'";
		$result=db_query($sql);
		if (!$result || db_numrows($result) < 1) {
			//no matching user found
			$feedback .= ' ERROR - Incorrect User Name Or Email Address ';
			return false;
		} else {
			//create a secure, new password
			$new_pass=strtolower(substr(md5(time().$user_name.$hidden_hash_var),1,14));

			//update the database to include the new password
			$sql="UPDATE user SET password='". md5($new_pass) ."' WHERE user_name='$user_name'";
			$result=db_query($sql);

			//send a simple email with the new password
			mail ($email,'Password Reset','Your Password '.
				'has been reset to: '.$new_pass,'From: noreply@company.com');
			$feedback .= ' Your new password has been emailed to you. ';
			return true;
		}
	} else {
		$feedback .= ' ERROR - User Name and Email Address Are Required ';
		return false;
	}
}

function user_change_email ($password1,$new_email,$user_name) {
	global $feedback,$hidden_hash_var;
	if (validate_email($new_email)) {
		$hash=md5($new_email.$hidden_hash_var);
		//change the confirm hash in the db but not the email - 
		//send out a new confirm email with a new hash
		$user_name=strtolower($user_name);
		$password1=strtolower($password1);
		$sql="UPDATE user SET confirm_hash='$hash' WHERE user_name='$user_name' AND password='". md5($password1) ."'";
		$result=db_query($sql);
		if (!$result || db_affected_rows($result) < 1) {
			$feedback .= ' ERROR - Incorrect User Name Or Password ';
			return false;
		} else {
			$feedback .= ' Confirmation Sent ';
			user_send_confirm_email($new_email,$hash);
			return true;
		}
	} else {
		$feedback .= ' New Email Address Appears Invalid ';
		return false;
	}
}

function user_send_confirm_email($email,$hash) {
	/*
		Used in the initial registration function
		as well as the change email address function
	*/

	$message = "Thank You For Registering at PHPBuilder.com".
		"\nSimply follow this link to confirm your registration: ".
		"\n\nhttp://www.phpbuilder.com/account/confirm.php?hash=$hash&email=". urlencode($email).
		"\n\nOnce you confirm, you can use the services on PHPBuilder.";
	mail ($email,'PHPBuilder Registration Confirmation',$message,'From: noreply@phpbuilder.com');
}

function user_register($user_name,$password1,$password2,$email,$real_name) {
	global $feedback,$hidden_hash_var;
	//all vars present and passwords match?
	if ($user_name && $password1 && $password1==$password2 && $email && validate_email($email)) {
		//password and name are valid?
		if (account_namevalid($user_name) && account_pwvalid($password1)) {
			$user_name=strtolower($user_name);
			$password1=strtolower($password1);

			//does the name exist in the database?
			$sql="SELECT * FROM user WHERE user_name='$user_name'";
			$result=db_query($sql);
			if ($result && db_numrows($result) > 0) {
				$feedback .=  ' ERROR - USER NAME EXISTS ';
				return false;
			} else {
				//create a new hash to insert into the db and the confirmation email
				$hash=md5($email.$hidden_hash_var);
				$sql="INSERT INTO user (user_name,real_name,password,email,remote_addr,confirm_hash,is_confirmed) ".
					"VALUES ('$user_name','$real_name','". md5($password1) ."','$email','$GLOBALS[REMOTE_ADDR]','$hash','0')";
				$result=db_query($sql);
				if (!$result) {
					$feedback .= ' ERROR - '.db_error();
					return false;
				} else {
					//send the confirm email
					user_send_confirm_email($email,$hash);
					$feedback .= ' Successfully Registered. You Should Have a Confirmation Email Waiting ';
					return true;
				}
			}
		} else {
			$feedback .=  ' Account Name or Password Invalid ';
			return false;
		}
	} else {
		$feedback .=  ' ERROR - Must Fill In User Name, Matching Passwords, And Provide Valid Email Address ';
		return false;
	}
}

function user_getid() {
	global $G_USER_RESULT;
	//see if we have already fetched this user from the db, if not, fetch it
	if (!$G_USER_RESULT) {
		$G_USER_RESULT=db_query("SELECT * FROM user WHERE user_name='" . user_getname() . "'");
	}
	if ($G_USER_RESULT && db_numrows($G_USER_RESULT) > 0) {
		return db_result($G_USER_RESULT,0,'user_id');
	} else {
		return false;
	}
}

function user_getrealname() {
	global $G_USER_RESULT;
	//see if we have already fetched this user from the db, if not, fetch it
	if (!$G_USER_RESULT) {
		$G_USER_RESULT=db_query("SELECT * FROM user WHERE user_name='" . user_getname() . "'");
	}
	if ($G_USER_RESULT && db_numrows($G_USER_RESULT) > 0) {
		return db_result($G_USER_RESULT,0,'real_name');
	} else {
		return false;
	}
}

function user_getemail() {
	global $G_USER_RESULT;
	//see if we have already fetched this user from the db, if not, fetch it
	if (!$G_USER_RESULT) {
		$G_USER_RESULT=db_query("SELECT * FROM user WHERE user_name='" . user_getname() . "'");
	}
	if ($G_USER_RESULT && db_numrows($G_USER_RESULT) > 0) {
		return db_result($G_USER_RESULT,0,'email');
	} else {
		return false;
	}
}

function user_getname() {
	if (user_isloggedin()) {
		return $GLOBALS['user_name'];
	} else {
		//look up the user some day when we need it
		return ' ERROR - Not Logged In ';
	}
}

function account_pwvalid($pw) {
	global $feedback;
	if (strlen($pw) < 6) {
		$feedback .= " Password must be at least 6 characters. ";
		return false;
	}
	return true;
}

function account_namevalid($name) {
	global $feedback;
	// no spaces
	if (strrpos($name,' ') > 0) {
		$feedback .= " There cannot be any spaces in the login name. ";
		return false;
	}

	// must have at least one character
	if (strspn($name,"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ") == 0) {
		$feedback .= "There must be at least one character.";
		return false;
	}

	// must contain all legal characters
	if (strspn($name,"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_")
		!= strlen($name)) {
		$feedback .= " Illegal character in name. ";
		return false;
	}

	// min and max length
	if (strlen($name) < 5) {
		$feedback .= " Name is too short. It must be at least 5 characters. ";
		return false;
	}
	if (strlen($name) > 15) {
		$feedback .= "Name is too long. It must be less than 15 characters.";
		return false;
	}

	// illegal names
	if (eregi("^((root)|(bin)|(daemon)|(adm)|(lp)|(sync)|(shutdown)|(halt)|(mail)|(news)"
		. "|(uucp)|(operator)|(games)|(mysql)|(httpd)|(nobody)|(dummy)"
		. "|(www)|(cvs)|(shell)|(ftp)|(irc)|(debian)|(ns)|(download))$",$name)) {
		$feedback .= "Name is reserved.";
		return 0;
	}
	if (eregi("^(anoncvs_)",$name)) {
		$feedback .= "Name is reserved for CVS.";
		return false;
	}

	return true;
}

function validate_email ($address) {
	return (ereg('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'. '@'. '[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.' . '[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $address));
}

?>


