<?php
class Customview_Customview_Block_Customview extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getCustomview()     
     { 
        if (!$this->hasData('customview')) {
            $this->setData('customview', Mage::registry('customview'));
        }
        return $this->getData('customview');
        
    }
}