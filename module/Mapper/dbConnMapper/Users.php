<?php


namespace Mapper;
include __DIR__ . '/../../Mapper/abstracts/Connection.php';

use DateTime;
use PDO;
use PDOException;

class Users extends Connection
{
    /**
     * @var PDO
     */
    private $conn;

    private const SELECT = 'SELECT * from users';
    private const FIND = ' SELECT * FROM users where id = :id ';
    /**
     * Users constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->conn = parent::__construct($config);
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

    /**
     * @param $id
     * @return bool|mixed
     */
    public function find($id)
    {
        try {
            $stmt = $this->conn->prepare(self::FIND);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
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

    public function dataUsers($dataType, $idUsers)
    {
        try {
            $stmt = $this->conn->prepare(self::FIND);
            $stmt->bindParam(':id', $idUsers);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rows = [];
            foreach ($result as $row) {
                $format = 'd-m-Y';
                $rowCreated_at = $row['created_at'];
                $row['id'];
                $row['username'] ;
                $row['password'] ;
                $this->dateFormatCreated_at($rowCreated_at, $format);
                $rows[] = $row;
                switch ($dataType){
                    case 'id' :
                        return $row['id'];
                    case 'username' :
                        return $row['username'] ;
                    case 'password' :
                        return $row['password'];
                    case 'created_at' :
                        return  $this->dateFormatCreated_at($rowCreated_at, $format);
                    default :
                        return $rows;
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }
    /**
     * @return array|bool
     */
    public function fetchAllView()
    {
        try {
            $stmt = $this->conn->prepare(self::SELECT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rows = [];
            echo "<div class='container-fluid' style='padding-top: 50px'>";
            echo "<table class=\"table table-striped\" style='background: #fff'>";
            echo "<tr>";
            echo "<th>ID ACCOUNT</th>";
            echo "<th>USERNAME</th>";
            echo "<th>PASSWORD</th>";
            echo "<th>DATA CREAZIONE ACCOUNT</th>";
            echo "</tr>";
            foreach ($result as $row) {
                $format = 'd-m-Y';
                $rowCreated_at = $row['created_at'];
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $this->dateFormatCreated_at($rowCreated_at, $format) . "</td>";
                echo "</tr>";
                echo "</div>";
                $rows[] = $row;
            }
            return $rows;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

}