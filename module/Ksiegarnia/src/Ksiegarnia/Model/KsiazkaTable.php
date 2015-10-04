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