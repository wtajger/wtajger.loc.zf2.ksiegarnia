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
        // pobranie adaptera
        $sm = $this->getServiceLocator();
        $this->adapter = $sm->get('Zend\Db\Adapter\Adapter');
        
        // zapytanie
        $sql = "SELECT * FROM `ksiazki`";
        // przygotowanie zapytania
        $statement = $this->adapter -> query($sql);
        // wykonanie zapytania
        $results = $statement -> execute();
        
        echo "<pre>";
        print_r($results);
        echo "</pre>";
        
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
    
    
    public function restoreAction() 
    {
        $sm = $this->getServiceLocator();
        $this->adapter = $sm->get('Zend\Db\Adapter\Adapter');
        
        // zapytanie
        $sql = "TRUNCATE TABLE `ksiazki`";
        // przygotowanie zapytania
        $statement = $this->adapter -> query($sql);
        // wykonanie zapytania
        $results = $statement -> execute();
        echo "<pre>";
        print_r($results);
        echo "</pre>";
        
        // zapytanie
        $sql = "INSERT INTO `ksiazki` (isbn, autor, tytul, cena) VALUES
        ('9788324633647', 'David Flanagan', 'jQuery. Leksykon kieszonkowy', 24.90),
        ('9788324608218', 'Luke Welling, Laura Thomson', 'PHP i MySQL Tworzenie stron WWW Vademecum profesjonalisty', 109.00),
        ('9788328305519', 'Lorna Jane Mitchell', 'API nowoczesnej strony WWW. Usługi sieciowe w PHP', 32.90 ),
        ('9788324661381', 'Adam Trachtenberg, David Sklar', 'PHP. Receptury', 99.00),
        ('9788324658442', 'Łukasz Pasternak', 'CSS3. Tworzenie nowoczesnych stron WWW', 59.00),
        ('9788324655649', 'Włodzimierz Gajda', 'Git. Rozproszony system kontroli wersji', 54.90),
        ('9788324622047', 'Tom Negrino, Dori Smith', 'Po prostu JavaScript i Ajax', 69.00),
        ('9788324611762', 'Marcin Lis', 'AJAX i PHP. Ćwiczenia praktyczne', 18.99),
        ('9788324606440', 'Cristian Darie, Bogdan Brinzarea, Filip Cherecheş-Toşa, Mihai Bucica', 'AJAX i PHP. Tworzenie interaktywnych aplikacji internetowych', 47.00)
        ;";
        // przygotowanie zapytania
        $statement = $this->adapter -> query($sql);
        // wykonanie zapytania
        $results = $statement -> execute();
        echo "<pre>";
        print_r($results);
        echo "</pre>";
        
        return new ViewModel();
    }
    
    
    public function usunAction()
    {
        // pobranie adaptera
        $sm = $this->getServiceLocator();
        $this->adapter = $sm->get('Zend\Db\Adapter\Adapter');
        
        $isbn = $this->params()->fromQuery('isbn', null);
        if($isbn===null) {
           $msg = "Brak argumentu";
        }
        else {
           $sql = "DELETE FROM `ksiazki` WHERE isbn = ?";
           $statement = $this->adapter -> query($sql);
           $results = $statement -> execute(array($isbn));
           $msg = "Udało się albo nie";
        }
        return new ViewModel(array("msg"=>$msg));
    }
    
    public function edytujAction() 
    {
        $isbn = $this->params()->fromQuery('isbn', null);
        if($isbn===null) {
           $msg = "Brak argumentu";
        }
        else {
           $msg = "Przekazano ISBN = " . $isbn;
        }
        return new ViewModel(array("info"=>$msg));
    }
    
    public function wstawAction() 
    {
        return new ViewModel();
    }
    
    public function szukajAction() 
    {
        return new ViewModel();
    }
    
    public function znalezioneAction() 
    {
        var_dump($_POST);
    
        if (isset($_POST['submit']) && isset($_POST['szukane']) ) {
            $szukane = $_POST['szukane'];
            // pobranie adaptera
     		$sm = $this->getServiceLocator();
            $this->adapter = $sm->get('Zend\Db\Adapter\Adapter');
        
            // zapytanie
            //$sql = "SELECT * FROM `ksiazki` WHERE tytul COLLATE UTF8_GENERAL_CI LIKE '%?%'";
            //$sql = "SELECT * FROM `ksiazki` WHERE tytul COLLATE UTF8_GENERAL_CI LIKE ?";
            //
            // Znajduje tylko dla
            // dla "PHP. Receptury" i "SELECT * FROM `ksiazki` WHERE tytul COLLATE UTF8_GENERAL_CI LIKE ?";
            //
            // Brak wynikow 
            // dla "PHP" i "SELECT * FROM `ksiazki` WHERE tytul COLLATE UTF8_GENERAL_CI LIKE ?";
            // dla "PHP. Receptury" i "SELECT * FROM `ksiazki` WHERE tytul COLLATE UTF8_GENERAL_CI LIKE '%?%'";
            // gdy execute(array($szukane))
            //
            // Zaczyna dzialac dopiero, gdy dostawiam % nie w $sql, ale w przekazuwanej tablicy
            // gdy execute(array('%' . $szukane . '%' ))
            $sql = "SELECT * FROM `ksiazki` WHERE tytul COLLATE UTF8_GENERAL_CI LIKE :szu";// dla 
            echo $sql;
            
            // przygotowanie zapytania
            $statement = $this->adapter -> query($sql);
            
            // wykonanie zapytania
            //$results = $statement -> execute(array($szukane)); // nie dziala!
            $results = $statement -> execute(array('szu' => '%' . $szukane . '%' ));
        
            echo "<pre>";
            print_r($results);
            echo "</pre>";
            
            // przetworzenie wynikow na tablice
            $rows = array();
            foreach ($results as $result) {
                $rows[] = $result;
            }
            
            //var_dump($rows);
            
            // tablice do wyslania
            $arrData = array(
                'info' => 'Szukanie "' . $szukane . '" w tytule',
                'rows' => $rows
            );
            
        }
        return new ViewModel($arrData);
    }

}
