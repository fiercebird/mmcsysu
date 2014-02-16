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
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
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

        public function getPasswordSaltFromDb($username)
        {
        
                
        }

        

}
