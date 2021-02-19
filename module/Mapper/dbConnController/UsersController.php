<?php

namespace Mapper;

include_once __DIR__ . '/../../Mapper/dbConnMapper/Users.php';

class UsersController
{
    public const ID = 1;
    public const USERNAME = 2;
    public const PASSWORD = 3;
    public const CREATED_AT = 4;

    private $config ;

    /**
     * @var UsersModel
     */
    private $usersModel;

    /**
     * @var Users
     */
    private $usersMapper;

    public function __construct()
    {
        $this->config = include __DIR__ . '/../../Mapper/common/config.php';
        $this->usersMapper = new Users($this->config);
        $this->usersModel = new UsersModel();
    }

    public function find($id)
    {
        return json_encode($this->usersMapper->find($id));
    }

    public function fetchAllViewTable()
    {
        echo '<table class="table">';
        echo '<thead>';
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>USERNAME</th>";
        echo "<th>PASSWORD</th>";
        echo "<th>DATA CREAZIONE</th>";
        echo "</tr>";
        echo '</thead>';
        echo '<tbody>';
        $this->usersMapper->fetchAllViewLayout();
        echo '</tbody>';
        echo '</table>';
        return TRUE;
    }

    //Funzione che selezionato un id utente sceglie quale record di quell'utente mostrare attraverso $usersType
    public function recordTableUsers($idUsers , $usersType)
    {
        switch ($usersType){
            case 1 :
                echo $this->usersMapper->dataUsers($idUsers,$this->usersModel->getId());
                break;
            case 2 :
                echo $this->usersMapper->dataUsers($idUsers,$this->usersModel->getUsername());
                break;
            case 3 :
                echo $this->usersMapper->dataUsers($idUsers,$this->usersModel->getPassword());
                break;
            case 4 :
                echo $this->usersMapper->dataUsers($idUsers,$this->usersModel->getCreatedAt());
                break;
        }
        return TRUE;
    }

    //Funzione che selezionato un id utente mostra la riga contenente tutti gli attributi di  quell'utente
    public function rowTableUsers($idUsers)
    {
        ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">USERNAME</th>
                <th scope="col">PASSSWORD</th>
                <th scope="col">DATA CREAZIONE</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?= $this->usersMapper->dataUsers($idUsers) ?>
            </tr>
            </tbody>
        </table>
        <?php
    }

}