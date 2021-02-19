<?php

namespace Mapper;

include_once __DIR__ . '/../../Mapper/abstracts/Connection.php';

include_once __DIR__ . '/../../Mapper/Models/VehiclesModel.php';

use DateTime;
use Exception;
use PDO;
use PDOException;

class Vehicles extends Connection
{
    /**
     * @var PDO
     */
    private $conn;

    /**
     * @var VehiclesModel
     */
    private $vehiclesModel;

    private const SELECT = 'SELECT * FROM VEHICLES';
    private const FIND = 'SELECT * FROM VEHICLES WHERE ID = :id ';
    private const INSERT = 'INSERT INTO 
                            vehicles(CLASSE, TARGA, MODELLO, SCAD_ASSICURAZIONE, SCAD_BOLLO, SCAD_REVISIONE, KM_ULT_REV) 
                            VALUES (:classe, :targa, :modello, :scad_assicurazione, :scad_bollo, :scad_revisione, :km_ult_rev)';
    private const UPDATE = 'UPDATE vehicles SET CLASSE = :classe, TARGA = :targa, MODELLO = :modello, SCAD_ASSICURAZIONE = :scad_assicurazione, 
                            SCAD_BOLLO = :scad_bollo, SCAD_REVISIONE = :scad_revisione, KM_ULT_REV = :km_ult_rev 
                            WHERE ID = :id';
    private const DELETE = 'DELETE FROM vehicles WHERE ID = :id';
    private const  FIND_TARGA_BY_ID = 'SELECT targa FROM vehicles where ID = :id';
    private const  FIND_MODELLO_BY_ID = 'SELECT modello FROM vehicles where ID = :id';
    private const  FIND_SCAD_ASSICURAZIONE_BY_ID = 'SELECT scad_assicurazione FROM vehicles where ID = :id';
    private const  FIND_SCAD_BOLLO_BY_ID = 'SELECT scad_bollo FROM vehicles where ID = :id';
    private const  FIND_SCAD_REVISIONE_BY_ID = 'SELECT scad_revisione FROM vehicles where ID = :id';
    private const  FIND_KM_BY_ID = 'SELECT km_ult_rev FROM vehicles where ID = :id';

    /*
     * UPDATE vehicles SET classe='MOTOVEIVOLO',modello = 'SUZUKI RRS23'
WHERE id = 7;
     * */

    /**
     * Vehicles constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->conn = parent::__construct($config);
        $this->vehiclesModel = new VehiclesModel();
    }

    public function find($id)
    {
        try {
            $stmt = $this->conn->prepare(self::FIND);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    public function storicoRecord($id, $record)
    {
        try {
            switch ($record) {
                case $this->vehiclesModel->getTarga():
                    $stmt = $this->conn->prepare(self::FIND_TARGA_BY_ID);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        return $row[$this->vehiclesModel->getTarga()];
                    }
                    break;
                case $this->vehiclesModel->getModello():
                    $stmt = $this->conn->prepare(self::FIND_MODELLO_BY_ID);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        return $row[$this->vehiclesModel->getModello()];
                    }
                    break;
                case $this->vehiclesModel->getScadAssicurazione():
                    $stmt = $this->conn->prepare(self::FIND_SCAD_ASSICURAZIONE_BY_ID);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        return $row[$this->vehiclesModel->getScadAssicurazione()];
                    }
                    break;
                case $this->vehiclesModel->getScadBollo():
                    $stmt = $this->conn->prepare(self::FIND_SCAD_BOLLO_BY_ID);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        return $row[$this->vehiclesModel->getScadBollo()];
                    }
                    break;
                case $this->vehiclesModel->getScadRevisione():
                    $stmt = $this->conn->prepare(self::FIND_SCAD_REVISIONE_BY_ID);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        return $row[$this->vehiclesModel->getScadRevisione()];
                    }
                    break;
                case $this->vehiclesModel->getKmUltRev():
                    $stmt = $this->conn->prepare(self::FIND_KM_BY_ID);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        return $row[$this->vehiclesModel->getKmUltRev()];
                    }
                    break;
            }

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    /**
     * @return array|bool
     */
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

    private function dateFormat($rowExpireDate, $format)
    {
        try {
            if ($rowExpireDate == $this->vehiclesModel->getScadAssicurazione()) {
                $scadAssicurazione = new DateTime($rowExpireDate);
                $scadAssicurazione = date_format($scadAssicurazione, $format);
                return $scadAssicurazione;
            } else if ($rowExpireDate == $this->vehiclesModel->getScadBollo()) {
                $scadBollo = new DateTime($rowExpireDate);
                $scadBollo = date_format($scadBollo, $format);
                return $scadBollo;
            } else {
                $scadRevisione = new DateTime($rowExpireDate);
                $scadRevisione = date_format($scadRevisione, $format);
                return $scadRevisione;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    public function fetchAllViewTable()
    {
        try {
            $result = $this->fetchAll();
            $rows = [];
            foreach ($result as $row) {
                $format = 'd-m-Y';
                $rowScadAssicurazione = $row[$this->vehiclesModel->getScadAssicurazione()];
                $rowScadBollo = $row[$this->vehiclesModel->getScadBollo()];
                $rowScadRevisione = $row[$this->vehiclesModel->getScadRevisione()];
                echo "<tr>";
                echo "<td>" . strtoupper($row[$this->vehiclesModel->getId()]) . "</td>";
                echo "<td>" . strtoupper($row[$this->vehiclesModel->getClasse()]) . "</td>";
                echo "<td>" . strtoupper($row[$this->vehiclesModel->getTarga()]) . "</td>";
                echo "<td>" . strtoupper($row[$this->vehiclesModel->getModello()]) . "</td>";
                echo "<td>" . strtoupper($this->dateFormat($rowScadAssicurazione, $format)) . "</td>";
                echo "<td>" . strtoupper($this->dateFormat($rowScadBollo, $format)) . "</td>";
                echo "<td>" . strtoupper($this->dateFormat($rowScadRevisione, $format)) . "</td>";
                echo "<td>" . strtoupper($row[$this->vehiclesModel->getKmUltRev()]) . "</td>";
                echo "</tr>";
                $rows[] = $row;
            }
            return $rows;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    public function dataVehicles($idVehicles, $dataType = [])
    {
        try {
            $stmt = $this->conn->prepare(self::FIND);
            $stmt->bindParam(':id', $idVehicles, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rows = [];
            foreach ($result as $row) {
                $format = 'd-m-Y';
                $rowScadAssicurazione = $row[$this->vehiclesModel->getScadAssicurazione()];
                $rowScadBollo = $row[$this->vehiclesModel->getScadBollo()];
                $rowScadRevisione = $row[$this->vehiclesModel->getScadRevisione()];
                $rows[] = $row;
                switch ($dataType) {
                    case $this->vehiclesModel->getId() :
                        return strtoupper($row[$this->vehiclesModel->getId()]);
                    case $this->vehiclesModel->getClasse() :
                        return strtoupper($row[$this->vehiclesModel->getClasse()]);
                    case $this->vehiclesModel->getTarga() :
                        return strtoupper($row[$this->vehiclesModel->getTarga()]);
                    case $this->vehiclesModel->getModello() :
                        return strtoupper($row[$this->vehiclesModel->getModello()]);
                    case $this->vehiclesModel->getScadAssicurazione() :
                        return strtoupper($this->dateFormat($rowScadAssicurazione, $format));
                    case $this->vehiclesModel->getScadBollo() :
                        return strtoupper($this->dateFormat($rowScadBollo, $format));
                    case $this->vehiclesModel->getScadRevisione() :
                        return strtoupper($this->dateFormat($rowScadRevisione, $format));
                    case $this->vehiclesModel->getKmUltRev() :
                        return strtoupper($row[$this->vehiclesModel->getKmUltRev()]);
                    default :
                        return
                            '<td>' . strtoupper($row[$this->vehiclesModel->getId()]) . '</td>' .
                            '<td>' . strtoupper($row[$this->vehiclesModel->getClasse()]) . '</td>' .
                            '<td>' . strtoupper($row[$this->vehiclesModel->getTarga()]) . '</td>' .
                            '<td>' . strtoupper($row[$this->vehiclesModel->getModello()]) . '</td>' .
                            '<td>' . strtoupper($this->dateFormat($rowScadAssicurazione, $format)) . '</td>' .
                            '<td>' . strtoupper($this->dateFormat($rowScadBollo, $format)) . '</td>' .
                            '<td>' . strtoupper($this->dateFormat($rowScadRevisione, $format)) . '</td>' .
                            '<td>' . strtoupper($row[$this->vehiclesModel->getKmUltRev()]) . '</td>';
                    /*return json_encode($rows);*/
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    public function insert($classe, $targa, $modello, $scad_assicurazione, $scad_bollo, $scad_revisione, $km_ult_rev)
    {
        try {
            $stmt = $this->conn->prepare(self::INSERT);
            $stmt->bindParam(':classe', $classe);
            $stmt->bindParam(':targa', $targa);
            $stmt->bindParam(':modello', $modello);
            $stmt->bindParam(':scad_assicurazione', $scad_assicurazione);
            $stmt->bindParam(':scad_bollo', $scad_bollo);
            $stmt->bindParam(':scad_revisione', $scad_revisione);
            $stmt->bindParam(':km_ult_rev', $km_ult_rev);
            $stmt->execute();
            return TRUE;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    public function update($classe, $targa, $modello, $scad_assicurazione, $scad_bollo, $scad_revisione, $km_ult_rev, $id)
    {
        try {
            $stmt = $this->conn->prepare(self::UPDATE);
            $stmt->bindParam(':classe', $classe);
            $stmt->bindParam(':targa', $targa);
            $stmt->bindParam(':modello', $modello);
            $stmt->bindParam(':scad_assicurazione', $scad_assicurazione);
            $stmt->bindParam(':scad_bollo', $scad_bollo);
            $stmt->bindParam(':scad_revisione', $scad_revisione);
            $stmt->bindParam(':km_ult_rev', $km_ult_rev);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return TRUE;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    public function delete($id)
    {
        try {
            $stmt = $this->conn->prepare(self::DELETE);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return TRUE;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }
}