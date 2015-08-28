<?php
namespace Ksiegarnia\Model;

 use Zend\Db\TableGateway\TableGateway;

 /* reprezentacja obiektu fizycznego do tabeli */
 class KsiazkaTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getKsiazka($isbn)
     {
         //$isbn  =  $isbn;// było rzutowanie na int, bo w oryginale byl 
         $rowset = $this->tableGateway->select(array('isbn' => $isbn));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $isbn");
         }
         return $row;
     }

     public function saveKsiazka(Ksiazka $k)
     {
         $data = array(
             'autor' => $k->autor,
             'tytul'  => $k->tytul,
			 'isbn' => $k->isbn,
             'cena'  => $k->cena,
         );

         $isbn =  $k->isbn;
         if ($isbn == "") {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getKsiazka($isbn)) {
                 $this->tableGateway->update($data, array('isbn' => $isbn));
             } else {
                 throw new \Exception('ksiazka isbn does not exist');
             }
         }
     }

     public function deleteKsiazka($id)
     {
         $this->tableGateway->delete(array('isbn' => $isbn));
     }
 }
 
 /*
 <?php
namespace Album\Model;
 
 use Zend\Db\TableGateway\TableGateway;
 
 class AlbumTable
 {
     protected $tableGateway;
 
     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }
 
     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }
 
     public function getAlbum($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }
 
     public function saveAlbum(Album $album)
     {
         $data = array(
             'artist' => $album->artist,
             'title'  => $album->title,
         );
 
         $id = (int) $album->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getAlbum($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Album id does not exist');
             }
         }
     }
 
     public function deleteAlbum($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }
 */
 
 /*
 
 Setting environment for using XAMPP for Windows.
www.zpci.pl@WWWZPCIPL-HP c:\xampp
# mysql -u root -p
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 30
Server version: 5.6.25 MySQL Community Server (GPL)

Copyright (c) 2000, 2015, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> show databases;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| cdcol              |
| mysql              |
| performance_schema |
| phpmyadmin         |
| test               |
| webauth            |
| zf2locdb           |
+--------------------+
8 rows in set (0.05 sec)

mysql> use zf2locdb;
Database changed
mysql> show tables;
+--------------------+
| Tables_in_zf2locdb |
+--------------------+
| klienci            |
| ksiazki            |
+--------------------+
2 rows in set (0.00 sec)

mysql> rename table ksiazki to ksiazka;
Query OK, 0 rows affected (0.05 sec)

mysql> show tables;
+--------------------+
| Tables_in_zf2locdb |
+--------------------+
| klienci            |
| ksiazka            |
+--------------------+
2 rows in set (0.00 sec)

mysql>





































































































































































































































*/
