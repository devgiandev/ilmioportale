<?php

namespace Mapper;

include_once __DIR__ . '/../../Mapper/abstracts/Connection.php';
include_once __DIR__ . '/../../Mapper/Models/UsersModel.php';

use DateTime;
use PDO;
use PDOException;

class Users extends Connection
{
    /**
     * @var UsersModel
     */
    private $usersModel;

    /**
     * @var PDO
     */
    private $conn;

    private const SELECT = 'SELECT * FROM USERS';
    private const FIND = ' SELECT * FROM USERS WHERE ID = :id ';

    /**
     * Users constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->conn = parent::__construct($config);
        $this->usersModel = new UsersModel();
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function find($id)
    {
        try {
            $stmt = $this->conn->prepare(self::FIND);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    public function fetchAll()
    {
        try {
            $stmt = $this->conn->prepare(self::SELECT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    private function dateFormatCreated_at($rowCreated_at, $format)
    {
        try {
            $created_at = new DateTime($rowCreated_at);
            $created_at = date_format($created_at, $format);
            return $created_at;
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    public function fetchAllViewLayout()
    {
        try {
            $result = $this->fetchAll();
            $rows = [];
            foreach ($result as $row) {
                $format = 'd-m-Y';
                $rowCreated_at = $row[$this->usersModel->getCreatedAt()];
                echo "<tr>";
                echo "<td>" . strtoupper($row[$this->usersModel->getId()]) . "</td>";
                echo "<td>" . strtoupper($row[$this->usersModel->getUsername()]) . "</td>";
                echo "<td>" . strtoupper($row[$this->usersModel->getPassword()]) . "</td>";
                echo "<td>" . strtoupper($this->dateFormatCreated_at($rowCreated_at, $format)) . "</td>";
                echo "</tr>";
                $rows[] = $row;
            }
            return $rows;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    //Permette di selezionare o la riga intera dell'id interessato oppure un record specifico dell'id selezionato
    //dataType è facoltativo
    public function dataUsers( $idUsers, $dataType = [])
    {
        try {
            $stmt = $this->conn->prepare(self::FIND);
            $stmt->bindParam(':id', $idUsers);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rows = [];
            foreach ($result as $row) {
                    $format = 'd-m-Y';
                    $rowCreated_at = $row[$this->usersModel->getCreatedAt()];
                    $rows = $row;
                    switch ($dataType) {
                        case $this->usersModel->getId() :
                            return strtoupper($row[$this->usersModel->getId()]);
                        case $this->usersModel->getUsername() :
                            return strtoupper($row[$this->usersModel->getUsername()]);
                        case $this->usersModel->getPassword() :
                            return strtoupper($row[$this->usersModel->getPassword()]);
                        case $this->usersModel->getCreatedAt() :
                            return strtoupper($this->dateFormatCreated_at($rowCreated_at, $format));
                        default :
                            return
                            '<td>' . strtoupper($row[$this->usersModel->getId()]) . '</td>' .
                            '<td>' . strtoupper($row[$this->usersModel->getUsername()]) . '</td>' .
                            '<td>' . strtoupper($row[$this->usersModel->getPassword()]) . '</td>' .
                            '<td>' . strtoupper($this->dateFormatCreated_at($rowCreated_at, $format)) . '</td>';
                        /*return json_encode($rows);*/
                    }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

}