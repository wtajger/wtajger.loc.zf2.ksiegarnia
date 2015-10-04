<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Ksiegarnia\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Ksiegarnia\Form\KsiazkaForm;

class IndexController extends AbstractActionController
{
    protected $ksiazkaTable;
    
    public function getKsiazkaTable()
    {
        if (!$this->ksiazkaTable) {
            $sm = $this->getServiceLocator();
            $this->ksiazkaTable = $sm->get('Ksiegarnia\Model\KsiazkaTable');
        }
        return $this->ksiazkaTable;
    }
   
    public function indexAction()
    {
        return new ViewModel( array(
            'ksiazki' => $this->getKsiazkaTable()->fetchAll()
        ));
    }  
    
    public function wstawAction()
    {
        $form = new KsiazkaForm();
        $form->get('submit')->setValue('Prześlij');
        $request = $this->getRequest();
        if ($request->isPost()) { // jezeli odebrano formularz
            echo "<pre>";
            print_r($request->getPost());
            echo "</pre>";
        }
        return array('form' => $form);
    }
}
