<?php //-->
/*
 * This file is part a custom application package.
 */

/**
 * Default logic to output a page
 */
class Front_Page_Item_Edit extends Front_Page {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_title = 'Edit Item';
	protected $_class = 'item-edit';
	protected $_template = '/item/edit.phtml';
	
	/* Private Properties
	-------------------------------*/
	/* Magic
	-------------------------------*/
	/* Public Methods
	-------------------------------*/
	public function render() {
		$database 	= front()->database();
		$uploadsDir = front()->registry()->get('path', 'uploads');
		$id 		= front()->registry()->get('request', 'variables', 0);
		$date 		= date("Y-m-d H:i:s");

		$this->_body['item'] = $database->search('item')->filterByItemId($id)->getRow();

		if(!empty($_POST)) {
			$_POST['item_updated'] 	= $date;
			
			if($_FILES['item_photo']['size']) {
				$filename = uniqid().$_FILES['item_photo']['name'];
				move_uploaded_file($_FILES['item_photo']['tmp_name'], $uploadsDir.'/'.$filename);
				$_POST['item_image']	= $filename;
				$_POST['item_image_ext']= $size['mime'];
			}

			$database->model($_POST)->save('item');
			
			header('Location: /item/edit/'.$id);
			exit;
		}

		return $this->_page();
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}
