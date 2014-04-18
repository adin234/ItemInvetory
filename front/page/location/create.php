<?php //-->
/*
 * This file is part a custom application package.
 */

/**
 * Default logic to output a page
 */
class Front_Page_Location_Create extends Front_Page {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_title = 'Create Location';
	protected $_class = 'location-create';
	protected $_template = '/location/create.phtml';
	
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
			$_POST['location_created'] 	= $date;
			$_POST['location_updated'] 	= $date;
			
			if($_FILES['location_image']['size']) {
				$filename = uniqid().$_FILES['location_image']['name'];
				move_uploaded_file($_FILES['location_image']['tmp_name'], $uploadsDir.'/'.$filename);
				$_POST['location_image']	= $filename;
			}

			$database->model($_POST)->save('location');
			
			header('Location: /location/create');
			exit;
		}

		return $this->_page();
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}
