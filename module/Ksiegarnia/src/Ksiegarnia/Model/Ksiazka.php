<?php
namespace Ksiegarnia\Model;
 
 class Ksiazka
 {
     public $isbn;
     public $autor;
     public $tytul;
	 public $cena;
 
     public function exchangeArray($data)
     {
         $this->autor     = (!empty($data['autor'])) ? $data['autor'] : null;
		 $this->isbn    = (!empty($data['isbn'])) ? $data['isbn'] : null;
		 $this->tytul    = (!empty($data['tytul'])) ? $data['tytul'] : null;
		 $this->cena     = (!empty($data['cena'])) ? $data['cena'] : null;
 
     }
 }