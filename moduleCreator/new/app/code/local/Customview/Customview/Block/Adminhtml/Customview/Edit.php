<?php

class Customview_Customview_Block_Adminhtml_Customview_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'customview';
        $this->_controller = 'adminhtml_customview';
        
        $this->_updateButton('save', 'label', Mage::helper('customview')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('customview')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('customview_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'customview_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'customview_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('customview_data') && Mage::registry('customview_data')->getId() ) {
            return Mage::helper('customview')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('customview_data')->getTitle()));
        } else {
            return Mage::helper('customview')->__('Add Item');
        }
    }
}