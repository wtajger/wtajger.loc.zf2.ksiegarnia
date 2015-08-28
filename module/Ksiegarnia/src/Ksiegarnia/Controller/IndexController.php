<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Ksiegarnia\Controller;

use Ksiegarnia\Form\KsiazkaForm; //mw
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
	
	public function wstawAction() 
	{
		$form = new KsiazkaForm();
        $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
		 //var_dump($request);
		 //echo "<pre>"; print_r($request); echo "</pre>";
		 
         if ($request->isPost()) {
			 echo "jest post";
			 
			 
			 /*
             $album = new Album();
             $form->setInputFilter($album->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $album->exchangeArray($form->getData());
                 $this->getAlbumTable()->saveAlbum($album);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('album');
             }
			 */
         }
       		 else {
				 echo "NIE MA post";
			 }
		 //echo "<pre>"; print_r($request); echo "</pre>";
		 
         return array('form' => $form);
		
	    //return new ViewModel();
	}
}
