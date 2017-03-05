<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    private $_id;


	public function authenticate()
	{

        $member = Member::model()->findByAttributes(array('email'=>$this->username));


		if($member == null) {
            return array("email" => "No user found for this address.");
        }

        if (!CPasswordHelper::verifyPassword($this->password, $member->password)) {
            //return array("password" => "Incorrect password.");
        }

        $this->_id = $member->id;
        $this->username = $member->username;


        if ($member->account == "admin") {
            $this->setState("admin",true);
        } else {
            $this->setState("admin",false);
        }

        return true;

	}

    public function getId() {
        return $this->_id;
    }



}
