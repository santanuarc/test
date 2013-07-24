<?php

class Customview_Customview_Block_Adminhtml_Customview_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('customview_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('customview')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('customview')->__('Item Information'),
          'title'     => Mage::helper('customview')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('customview/adminhtml_customview_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}