<?php
class Customview_Customview_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/customview?id=15 
    	 *  or
    	 * http://site.com/customview/id/15 	
    	 */
    	/* 
		$customview_id = $this->getRequest()->getParam('id');

  		if($customview_id != null && $customview_id != '')	{
			$customview = Mage::getModel('customview/customview')->load($customview_id)->getData();
		} else {
			$customview = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($customview == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$customviewTable = $resource->getTableName('customview');
			
			$select = $read->select()
			   ->from($customviewTable,array('customview_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$customview = $read->fetchRow($select);
		}
		Mage::register('customview', $customview);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}