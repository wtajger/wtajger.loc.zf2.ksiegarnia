<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
	
	public function testAction()
    {
        return new ViewModel(
		    array(
			   'msg' => 'Wiadomość'
			)
		);
    }
	
	public function selectAction()
    {
	    echo "uruchomiona metoda selectAction()";
		
		$sm = $this->getServiceLocator();

        $this->adapter = $sm->get('Zend\Db\Adapter\Adapter');
		
        $sql = "SELECT * FROM `ksiazki`";
        $statement = $this->adapter -> query($sql);
        $results = $statement -> execute();
        $returnArray = array();
        foreach ($results as $result) {
            $returnArray[] = $result;
        }
        echo "<pre>";
        print_r($returnArray);
        echo "</pre>";

        return new ViewModel();
    }
}
