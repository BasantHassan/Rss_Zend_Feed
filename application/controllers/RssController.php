<?php

class RssController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->model = new Application_Model_DbTable_Rss();
    }

    public function indexAction()
    {
    	$link=$this->model->listLink();
    	//var_dump($link);
    	for($i=0;$i<count($link);$i++){
    		$l=$link[$i]["link"];
    		//var_dump($l);

    	
    	//var_dump($l["link"]);
    	$feed = Zend_Feed_Reader::import($l);
    	$data = array(
    		'title'        => $feed->getTitle(),
    		'link'         => $feed->getLink(),
    		'dateModified' => $feed->getDateModified(),
    		'description'  => $feed->getDescription(),
    		'language'     => $feed->getLanguage(),
    		'entries'      => array(),
    		);
    	foreach ($feed as $entry) {
    		$edata = array(
    			'title'        => $entry->getTitle(),
    			'description'  => $entry->getDescription(),
        		'dateModified' => $entry->getDateModified(),
        		'authors'       => $entry->getAuthors(),
        		'link'         => $entry->getLink(),
        		'content'      => $entry->getContent()
        		);
    		$data['entries'][] = $edata;

    	}
        $this->view->form=$data;

    }}

    public function addAction()
    {
          
		$form = new Application_Form_Links();
			if($this->getRequest()->isPost()){
				if($form->isValid($this->getRequest()->getParams())){
				    $data = $form->getValues();
				   // var_dump($data);


					$this->model->addLink($data);
					$this->redirect('Rss/index');	
					}
				}
		
		//$this->view->pass = "5";
		//$this->redirect('index/index');
		
	    
	    // $form->removeElement('submit');
		$this->view->form = $form;
    }
	// }
}



