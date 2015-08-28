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
             'name' => 'title',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Title',
             ),
         ));
         $this->add(array(
             'name' => 'artist',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Artist',
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