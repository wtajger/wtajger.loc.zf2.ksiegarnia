<?php
namespace Ksiegarnia\Form;

 use Zend\Form\Form;

 class KsiazkaForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the namepassed
         parent::__construct('ksiazka');
		 
		 // input hidden 

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
		 
		 // dwa pola tekstowe
         $this->add(array(
             'name' => 'tytul',
             'type' => 'Text',
             'options' => array(
                 'label' => 'tytul',
             ),
         ));
         $this->add(array(
             'name' => 'autor',
             'type' => 'Text',
             'options' => array(
                 'label' => 'autor',
             ),
         ));
		 
		 $this->add(array(
             'name' => 'isbn',
             'type' => 'Text',
			 'value' => '1111',
             'options' => array(
                 'label' => 'isbn',
             ),
         ));
		 
		 $this->add(array(
             'name' => 'cena',
             'type' => 'Text',
             'options' => array(
                 'label' => 'cena',
             ),
         ));
		 
		 //submit 
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }