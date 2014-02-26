<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class CommentForm extends CFormModel
{
	public $author;
	public $email;
	public $content;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('author, email, content', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
                        'author'=>'称呼',
			'email'=>'邮箱',
                        'content'=>'内容',
                        'verifyCode'=>'验证码',
                        
		);
	}

        public function save()
        {
               $model = new Comment();
               $model->author = $this->author;
               $model->email = $this->email;
               $model->content = $this->content;
               $model->save();
        }
}
