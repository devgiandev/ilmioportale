<?php

namespace Mapper;

include_once __DIR__ . '/../../Mapper/dbConnMapper/Vehicles.php';

class VehiclesController
{
    //constanti utilizzate dal metodo recordTableUsers per settare i campi
    public const ID = 1;
    public const CLASSE = 2;
    public const TARGA = 3;
    public const MODELLO = 4;
    public const SCADENZA_ASSICURAZIONE = 5;
    public const SCADENZA_BOLLO = 6;
    public const SCADENZA_REVISIONE = 7;
    public const KM_ULT_REVISIONE = 8;

    private $config;

    private $vehiclesModel;
    /**
     * @var Vehicles
     */
    private $vehiclesMapper;

    public function __construct()
    {
        $this->config = include __DIR__ . '/../../Mapper/common/config.php';
        $this->vehiclesMapper = new Vehicles($this->config);
        $this->vehiclesModel = new VehiclesModel();
    }

    public function find($id)
    {
        $view = json_encode($this->vehiclesMapper->find($id));
        echo $view;
        return $view;
    }

    public function fetchAll()
    {
        $view = json_encode($this->vehiclesMapper->fetchAll());
        echo $view;
        return $view;
    }

    public function fetchAllId()
    {
        $fetchAll = $this->vehiclesMapper->fetchAll();
        $rows = [];
        //Il value deve essere uguale al risultato dell'id selezionato nella view -->   $rows[] = $row[$this->vehiclesModel->getId()]
        foreach ($fetchAll as $row) {
            ?>
            <option value="<?= $rows[] = $row[$this->vehiclesModel->getId()] ?>">
                <?= $rows[] = $row[$this->vehiclesModel->getId()] ?>
            </option>
            <?php
        }
        return json_encode($rows);
    }

    public function fetchAllViewTable()
    {
        echo '<table class="table">';
        echo '<thead>';
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>CLASSE</th>";
        echo "<th>TARGA</th>";
        echo "<th>MODELLO</th>";
        echo "<th>SCADENZA ASSICURAZIONE</th>";
        echo "<th>SCADENZA BOLLO</th>";
        echo "<th>SCADENZA REVISIONE</th>";
        echo "<th>KM ULTIMA REVISIONE</th>";
        echo "</tr>";
        echo '</thead>';
        echo '<tbody>';
        $this->vehiclesMapper->fetchAllViewTable();
        echo '</tbody>';
        echo '</table>';
        return TRUE;
    }

    //Funzione che selezionato un id utente sceglie quale record di quell'utente mostrare attraverso $vehiclesType
    public function recordTableVehicles($idVehicles, $vehiclesType)
    {
        switch ($vehiclesType) {
            case 1 :
                echo $this->vehiclesMapper->dataVehicles($idVehicles, $this->vehiclesModel->getId());
                break;
            case 2 :
                echo $this->vehiclesMapper->dataVehicles($idVehicles, $this->vehiclesModel->getClasse());
                break;
            case 3 :
                echo $this->vehiclesMapper->dataVehicles($idVehicles, $this->vehiclesModel->getTarga());
                break;
            case 4 :
                echo $this->vehiclesMapper->dataVehicles($idVehicles, $this->vehiclesModel->getModello());
                break;
            case 5 :
                echo $this->vehiclesMapper->dataVehicles($idVehicles, $this->vehiclesModel->getScadAssicurazione());
                break;
            case 6 :
                echo $this->vehiclesMapper->dataVehicles($idVehicles, $this->vehiclesModel->getScadBollo());
                break;
            case 7 :
                echo $this->vehiclesMapper->dataVehicles($idVehicles, $this->vehiclesModel->getScadRevisione());
                break;
            case 8 :
                echo $this->vehiclesMapper->dataVehicles($idVehicles, $this->vehiclesModel->getKmUltRev());
                break;
        }
    }

    //Funzione che selezionato un id utente mostra la riga contenente tutti gli attributi di  quell'utente
    public function rowTableVehicles($idVehicles)
    {
        ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">CLASSE</th>
                <th scope="col">TARGA</th>
                <th scope="col">MODELLO</th>
                <th scope="col">SCADENZA ASSICURAZIONE</th>
                <th scope="col">SCADENZA BOLLO</th>
                <th scope="col">SCADENZA REVISIONE</th>
                <th scope="col">KM ULTIMA REVISIONE</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?= $this->vehiclesMapper->dataVehicles($idVehicles) ?>
            </tr>
            </tbody>
        </table>
        <?php
    }

    public function insert()
    {
        $messageCorrect = ['codice' => 0, 'message' => 'Operazione eseguita correttamente'];
        $messageUncorrect = ['codice' => 400, 'message' => 'Operazione non eseguita'];
        if (isset($_POST['submitInserimentoNuovoVeicolo'])) {
            $classe = strtoupper($_POST['classe']);
            $targa = strtoupper($_POST['targa']);
            $modello = strtoupper($_POST['modello']);
            $scad_assicurazione = strtoupper($_POST['scad_assicurazione']);
            $scad_bollo = strtoupper($_POST['scad_bollo']);
            $scad_revisione = strtoupper($_POST['scad_revisione']);
            $km_ult_rev = strtoupper($_POST['km_ult_revisione']);
            //Controllo sui km_ult_revisione se il valore è nullo lo setto a 0 perchè il campo non è obbligatorio
            if ($km_ult_rev == 0 || $km_ult_rev == null) {
                $km_ult_rev = 0;
            }
            $result = $this->vehiclesMapper->insert($classe, $targa, $modello, $scad_assicurazione, $scad_bollo, $scad_revisione, $km_ult_rev);
            if ($result > 0) {
                ?>
                <div class="alert alert-primary" role="alert">
                    <?= 'Codice n°: ' . $messageCorrect['codice'] . ' : ' . $messageCorrect['message'] ?>
                </div>
                <?php
            } else {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= 'Codice n°: ' . $messageUncorrect['codice'] . ' : ' . $messageUncorrect['message'] ?>
                </div>
                <?php
            }
        }
        return TRUE;
    }

    public function storicoRecordTable($id, $record)
    {
        return $this->vehiclesMapper->storicoRecord($id, $record);
    }

    public function update()
    {
        $messageCorrect = ['codice' => 0, 'message' => 'Operazione eseguita correttamente'];
        $messageUncorrect = ['codice' => 400, 'message' => 'Operazione non eseguita'];
        if (isset($_POST['submitModificaVeicolo'])) {
            $classe = strtoupper($_POST['classe']);
            $targa = strtoupper($_POST['targa']);
            $modello = strtoupper($_POST['modello']);
            $scad_assicurazione = strtoupper($_POST['scad_assicurazione']);
            $scad_bollo = strtoupper($_POST['scad_bollo']);
            $scad_revisione = strtoupper($_POST['scad_revisione']);
            $km_ult_rev = strtoupper($_POST['km_ult_revisione']);
            $id = $_POST['id'];
            if ($targa == '' || $targa == null) {
                $targa = $this->storicoRecordTable($id, $this->vehiclesModel->getTarga());
            }
            if ($modello == '' || $modello == null) {
                $modello = $this->storicoRecordTable($id, $this->vehiclesModel->getModello());
            }
            if ($scad_assicurazione == '' || $scad_assicurazione == null) {
                $scad_assicurazione = $this->storicoRecordTable($id, $this->vehiclesModel->getScadAssicurazione());
            }
            if ($scad_bollo == '' || $scad_bollo == null) {
                $scad_bollo = $this->storicoRecordTable($id, $this->vehiclesModel->getScadBollo());
            }
            if ($scad_revisione == '' || $scad_revisione == null) {
                $scad_revisione = $this->storicoRecordTable($id, $this->vehiclesModel->getScadRevisione());
            }
            if ($km_ult_rev == 0 || $km_ult_rev == null) {
                $km_ult_rev = $this->storicoRecordTable($id, $this->vehiclesModel->getKmUltRev());
            }
            $result = $this->vehiclesMapper->update($classe, $targa, $modello, $scad_assicurazione, $scad_bollo, $scad_revisione, $km_ult_rev, $id);
            if ($result > 0) {
                ?>
                <div class="alert alert-primary" role="alert">
                    <?= 'Codice n°: ' . $messageCorrect['codice'] . ' : ' . $messageCorrect['message'] ?>
                </div>
                <?php
            } else {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= 'Codice n°: ' . $messageUncorrect['codice'] . ' : ' . $messageUncorrect['message'] ?>
                </div>
                <?php
            }
        }
        return TRUE;
    }

    public function elimina()
    {
        $messageCorrect = ['codice' => 0, 'message' => 'Operazione eseguita correttamente'];
        $messageUncorrect = ['codice' => 400, 'message' => 'Operazione non eseguita'];
        if (isset($_POST['submitEliminaVeicolo'])) {
            $id = $_POST['id'];
            $result = $this->vehiclesMapper->delete($id);
            if ($result > 0) {
                ?>
                <div class="alert alert-primary" role="alert">
                    <?= 'Codice n°: ' . $messageCorrect['codice'] . ' : ' . $messageCorrect['message'] ?>
                </div>
                <?php
            } else {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= 'Codice n°: ' . $messageUncorrect['codice'] . ' : ' . $messageUncorrect['message'] ?>
                </div>
                <?php
            }
        }
        return TRUE;
    }

}