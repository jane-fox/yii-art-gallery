<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class WebUser extends CWebUser
{

    private $_model;


	public function isAdmin()
	{

        $user = $this->loadUser(Yii::app()->user->id);
        if ($user != null && $user->account == "admin") {
            return true;
        }

        return false;

    }

    // Load user model.
    protected function loadUser($id=null)
    {
        if($this->_model===null)
        {
            if($id!==null)
                $this->_model=Member::model()->findByPk($id);
        }
        return $this->_model;
    }



}
