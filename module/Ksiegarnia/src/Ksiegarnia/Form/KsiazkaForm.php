<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Ksiegarnia\Form;

use Zend\Form\Form;

class KsiazkaForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('ksiazka');
        // Pola tekstowe
        $this->add(array(
            'name' => 'isbn',
            'type' => 'Text',
            'options' => array(
                'label' => 'ISBN',
            ),
        ));            
        $this->add(array(
            'name' => 'tytul',
            'type' => 'Text',
            'options' => array(
                'label' => 'Tytuł',
            ),
        ));
        $this->add(array(
            'name' => 'autor',
            'type' => 'Text',
            'options' => array(
                'label' => 'Autor',
            ),
        ));
        $this->add(array(
            'name' => 'cena',
            'type' => 'Text',
            'options' => array(
                'label' => 'Cena',
            ),
        ));
        // Submit        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Prześlij',
                'id' => 'submitbutton',
            ),
        ));
    }
}
