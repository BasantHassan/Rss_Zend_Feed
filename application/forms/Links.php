<?php

class Application_Form_Links extends Zend_Form
{

    public function init()
    {
    	$this->setName('link');
       // $id=new Zend_Form_Element_Hidden('id');
       // $id->addFilter('Int');
         $link=new Zend_Form_Element_Text('link');
         $link->setLabel('Link')
    			   ->setRequired('true')
    			   ->addFilter('stringTrim')
    			   ->addValidator('NotEmpty')
                   ->setAttrib("class", "col-xs-4 col-md-2")
                   ->addValidator(new Zend_Validate_Db_NoRecordExists(
                array(
            'table' => 'rss',
            'field' => 'link',
                )
        ));


    	$submit=new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id','submitbutton btn btn-primary');

    	$this->addElements(array($link,$submit)); 

        /* Form Elements & Other Definitions Here ... */
    }


}

