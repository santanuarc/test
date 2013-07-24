<?php
class Customview_Customview_Block_Adminhtml_Customview extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_customview';
    $this->_blockGroup = 'customview';
    $this->_headerText = Mage::helper('customview')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('customview')->__('Add Item');
    parent::__construct();
  }
}