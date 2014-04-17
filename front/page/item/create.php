<?php //-->
/*
 * This file is part a custom application package.
 */

/**
 * Default logic to output a page
 */
class Front_Page_Item_Create extends Front_Page {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_title = 'Create Item';
	protected $_class = 'item-create';
	protected $_template = '/item/create.phtml';
	
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
			$_POST['item_created'] 	= $date;
			$_POST['item_updated'] 	= $date;
			
			if($_FILES['item_photo']['size']) {
				$filename = uniqid().$_FILES['item_photo']['name'];
				move_uploaded_file($_FILES['item_photo']['tmp_name'], $uploadsDir.'/'.$filename);
				$_POST['item_image']	= $filename;
			}

			$database->model($_POST)->save('item');
			
			header('Location: /item/create');
			exit;
		}

		return $this->_page();
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}
