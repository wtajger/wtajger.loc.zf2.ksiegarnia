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

class KsiazkaController extends AbstractActionController
{
	public function selectAction()
    {
	    echo "Jestem w kontrilerze";
	    // pobranie adaptera
		$sm = $this->getServiceLocator();
        $this->adapter = $sm->get('Zend\Db\Adapter\Adapter');
		
		// zapytanie
        $sql = "SELECT * FROM `ksiazki`";
		// przygotowanie zapytania
        $statement = $this->adapter -> query($sql);
		// wykonanie zapytania
        $results = $statement -> execute();
		
		// przetworzenie wynikow na tablice
        $rows = array();
        foreach ($results as $result) {
            $rows[] = $result;
        }
		// tablice do wyslania
        $arrData = array(
		   'info' => 'zapytanie SELECT do tabeli ksiazki',
		   'rows' => $rows
		);

        return new ViewModel($arrData);
    }
}
