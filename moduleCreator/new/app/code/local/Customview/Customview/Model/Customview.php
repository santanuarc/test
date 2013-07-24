<?php

class Customview_Customview_Model_Customview extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('customview/customview');
    }
}