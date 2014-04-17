<?php //-->
/*
 * This file is part a custom application package.
 */

/**
 * Default logic to output a page
 */
class Front_Page_User_Edit extends Front_Page {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_title = 'Edit User';
	protected $_class = 'user-edit';
	protected $_template = '/user/edit.phtml';
	
	/* Private Properties
	-------------------------------*/
	/* Magic
	-------------------------------*/
	/* Public Methods
	-------------------------------*/
	public function render() {
		$database = front()->database();
		$uploadsDir = front()->registry()->get('path', 'uploads');
		$id 		= front()->registry()->get('request', 'variables', 0);
		$date = date("Y-m-d H:i:s");

		$this->_body['user'] = $database->search('user')->filterByUserId($id)->getRow();

		if(!empty($_POST)) {
			$_POST['user_updated'] 	= $date;
			
			if($_FILES['user_photo']['size']) {
				$filename = uniqid().$_FILES['user_photo']['name'];
				move_uploaded_file($_FILES['user_photo']['tmp_name'], $uploadsDir.'/'.$filename);
				$_POST['user_photo']	= $filename;
			}

			$database->model($_POST)->save('user');
			
			header('Location: /user/edit/'.$id);
			exit;
		}

		return $this->_page();
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}
