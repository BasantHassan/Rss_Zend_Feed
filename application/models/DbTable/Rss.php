<?php

class Application_Model_DbTable_Rss extends Zend_Db_Table_Abstract
{

    protected $_name = 'rss';
    function listLink(){
		return $this->fetchAll()->toArray();
	}
	
    function addLink($link){
	
		$row = $this->createRow();
		$row->link = $link['link'];

		return $row->save();
	}




}

