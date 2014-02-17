<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
                $user = Users::model()->findByAttributes(array('username' => $this->username));
                $token = self::getLoginToken();
                if(!isset($user))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
                elseif(hash('sha256', $user->password . $token)!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
                /*
                $users=array(
			// username => password
			'demo'=>'1237731905566108b221e32b450f3438fb05cbdb4376a9b8e918abd66ab870f6191',
			'admin'=>'admin',
		);
		if($token && !isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif(hash('sha256', $users[$this->username] . $token)!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
                        i*/
		return !$this->errorCode;
	}


        // get a new salt - 8 hexadecimal characters long
        // on dechex( mt_rand() )
        public static function getNewPasswordSalt()
        {
                return substr( str_pad( dechex( mt_rand() ), 8, '0', STR_PAD_LEFT ), -8 );
        }

        // calculate the hash from a salt and a password
        public static function getPasswordHash( $salt, $password )
        {
                return $salt . ( hash( 'sha256', $salt . $password ) );
        }

        // compare a password to a hash
        public static function comparePassword( $password, $hash )
        {
                $salt = substr( $hash, 0, 8 );
                return $hash == self::getPasswordHash( $salt, $password );
        }

        public static function createLoginToken()
        {
                if(Yii::app()->user->IsGuest)
                        $token = md5(Yii::app()->session->sessionID . mt_rand());
                else
                        $token = md5(Yii::app()->user->id . Yii::app()->user->name . Yii::app()->session->sessionId . mt_rand()); 
                Yii::app()->session['loginFormToken'] = $token;
                return $token;
        }

        public static function getLoginToken() 
        {
                $token = Yii::app()->session['loginFormToken'];
                if(!isset($token) || empty($token) )
                   return false;
                else{   
                   unset(Yii::app()->session['loginFormToken']);
                   return $token;
                }
        }

        public function getPasswordSaltFromDb($username)
        {
        
                
        }

                

}
