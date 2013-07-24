<?php

class Customview_Customview_Model_Mysql4_Customview extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the customview_id refers to the key field in your database table.
        $this->_init('customview/customview', 'customview_id');
    }
}