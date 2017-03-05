<?php

/**
 * This is the model class for table "member".
 *
 * The followings are the available columns in table 'member':
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $account
 */
class Member extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

    private $_identity;

	public function tableName()
	{
		return 'member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
        return array(

            array('email, username, password', 'required'),
            array('email, username, password, account', 'length', 'max'=>255),
            // The following rule is used by search().

            array('email, username, account', 'safe', 'on'=>'search'),

            array('email','email'),

            array('email','unique', 'on' => 'register'),
            array('username','unique', 'on' => 'register'),



            array('email','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
            array('username','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),


        );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
        return array(
            "comments"  => array(self::HAS_MANY, "Comment","user_id"),
            "favorites" => array(self::HAS_MANY, "Favorite", "member_id"),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'username' => 'Username',
			'password' => 'Password',
			'account' => 'Account',
		);
	}

    public function login() {

        //Create Identity
        $this->_identity = new UserIdentity($this->email, $this->password);

        //Check that login is valid
        $auth = $this->_identity->authenticate();

        if ($auth === true) {

            //Success! Log in
            $duration = 3600*24*30; // 30 days

            Yii::app()->user->login($this->_identity, $duration);

            return true;

        } else {
            //Fail. Identity comes back in the form of an error. Set it.
            $this->addErrors($auth);

        }

        return false;

    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('account',$this->account,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Member the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
