<?php

namespace Mapper;

class VehiclesModel
{
    private $id = 'id';
    private $classe = 'classe';
    private $targa = 'targa';
    private $modello = 'modello';
    private $scadAssicurazione = 'scad_assicurazione';
    private $scadBollo = 'scad_bollo';
    private $scadRevisione = 'scad_revisione';
    private $kmUltRev = 'km_ult_rev';

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return VehiclesModel
     */
    public function setId(string $id): VehiclesModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getClasse(): string
    {
        return $this->classe;
    }

    /**
     * @param string $classe
     * @return VehiclesModel
     */
    public function setClasse(string $classe): VehiclesModel
    {
        $this->classe = $classe;
        return $this;
    }

    /**
     * @return string
     */
    public function getTarga(): string
    {
        return $this->targa;
    }

    /**
     * @param string $targa
     * @return VehiclesModel
     */
    public function setTarga(string $targa): VehiclesModel
    {
        $this->targa = $targa;
        return $this;
    }

    /**
     * @return string
     */
    public function getModello(): string
    {
        return $this->modello;
    }

    /**
     * @param string $modello
     * @return VehiclesModel
     */
    public function setModello(string $modello): VehiclesModel
    {
        $this->modello = $modello;
        return $this;
    }

    /**
     * @return string
     */
    public function getScadAssicurazione(): string
    {
        return $this->scadAssicurazione;
    }

    /**
     * @param string $scadAssicurazione
     * @return VehiclesModel
     */
    public function setScadAssicurazione(string $scadAssicurazione): VehiclesModel
    {
        $this->scadAssicurazione = $scadAssicurazione;
        return $this;
    }

    /**
     * @return string
     */
    public function getScadBollo(): string
    {
        return $this->scadBollo;
    }

    /**
     * @param string $scadBollo
     * @return VehiclesModel
     */
    public function setScadBollo(string $scadBollo): VehiclesModel
    {
        $this->scadBollo = $scadBollo;
        return $this;
    }

    /**
     * @return string
     */
    public function getScadRevisione(): string
    {
        return $this->scadRevisione;
    }

    /**
     * @param string $scadRevisione
     * @return VehiclesModel
     */
    public function setScadRevisione(string $scadRevisione): VehiclesModel
    {
        $this->scadRevisione = $scadRevisione;
        return $this;
    }

    /**
     * @return string
     */
    public function getKmUltRev(): string
    {
        return $this->kmUltRev;
    }

    /**
     * @param string $kmUltRev
     * @return VehiclesModel
     */
    public function setKmUltRev(string $kmUltRev): VehiclesModel
    {
        $this->kmUltRev = $kmUltRev;
        return $this;
    }



}