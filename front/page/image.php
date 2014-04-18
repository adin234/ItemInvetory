<?php //-->
/*
 * This file is part a custom application package.
 */

/**
 * Default logic to output a page
 */
class Front_Page_Image extends Front_Page {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_title = 'Create Item';
	protected $_class = 'item-create';
	protected $_template = '/items.phtml';
	
	/* Private Properties
	-------------------------------*/
	/* Magic
	-------------------------------*/
	/* Public Methods
	-------------------------------*/
	public function render() {
		$database 	= front()->database();
		$id 		= front()->registry()->get('request', 'variables', 1);
		$type		= front()->registry()->get('request', 'variables', 0);
		$uploadsDir = front()->registry()->get('path', 'uploads');
		$item 		= $database->search($type)->addFilter($type.'_id='.$id)->getRow();
		$ext 		= explode('.', $item[$type.'_image']);
		$ext 		= $ext[count($ext)-1];
		header('Content-type: image/'.$ext);
		die(file_get_contents($uploadsDir.'/'.$item[$type.'_image']));
		exit;
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}
