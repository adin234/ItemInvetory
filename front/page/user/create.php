<?php //-->
/*
 * This file is part a custom application package.
 */

/**
 * Default logic to output a page
 */
class Front_Page_User_Create extends Front_Page {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_title = 'Create User';
	protected $_class = 'user-create';
	protected $_template = '/user/create.phtml';
	
	/* Private Properties
	-------------------------------*/
	/* Magic
	-------------------------------*/
	/* Public Methods
	-------------------------------*/
	public function render() {
		$database = front()->database();
		$uploadsDir = front()->registry()->get('path', 'uploads');
		$date = date("Y-m-d H:i:s");

		if(!empty($_POST)) {
			$_POST['user_created'] 	= $date;
			$_POST['user_updated'] 	= $date;
			
			if($_FILES['user_photo']['size']) {
				$filename = uniqid().$_FILES['user_photo']['name'];
				move_uploaded_file($_FILES['user_photo']['tmp_name'], $uploadsDir.'/'.$filename);
				$_POST['user_photo']	= $filename;
			}

			$database->model($_POST)->save('user');
			
			header('Location: /user/create');
			exit;
		}

		return $this->_page();
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}
