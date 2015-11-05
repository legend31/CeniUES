<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Docente
 *
 * @ORM\Table(name="docente")
 * @ORM\Entity
 */
class Docente
{
    /**
     * @var string
     *
     * @ORM\Column(name="carnetDocente", type="string", length=7, nullable=false)
     * @ORM\Id
     */
    private $carnetdocente;

    /**
     * @var string
     *
     * @ORM\Column(name="primerNombreDocente", type="string", length=45, nullable=false)
     */
    private $primernombredocente;

    /**
     * @var string
     *
     * @ORM\Column(name="segundoNombreDocente", type="string", length=45, nullable=false)
     */
    private $segundonombredocente;

    /**
     * @var string
     *
     * @ORM\Column(name="primerApellidoDocente", type="string", length=45, nullable=true)
     */
    private $primerapellidodocente;

    /**
     * @var string
     *
     * @ORM\Column(name="segundoApellidoDocente", type="string", length=45, nullable=true)
     */
    private $segundoapellidodocente;

    /**
     * @var string
     *
     * @ORM\Column(name="dui", type="string", length=11, nullable=false)
     */
    private $dui;

    /**
     * @var string
     *
     * @ORM\Column(name="direccionDocente", type="string", length=70, nullable=false)
     */
    private $direcciondocente;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=8, nullable=false)
     */
    private $telefono;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaNacimiento", type="date", nullable=true)
     */
    private $fechanacimiento;



    /**
     * Get carnetdocente
     *
     * @return string
     */
    public function getCarnetdocente()
    {
        return $this->carnetdocente;
    }

    /**
     * Set primernombredocente
     *
     * @param string $primernombredocente
     *
     * @return Docente
     */
    public function setPrimernombredocente($primernombredocente)
    {
        $this->primernombredocente = $primernombredocente;

        return $this;
    }

    /**
     * Get primernombredocente
     *
     * @return string
     */
    public function getPrimernombredocente()
    {
        return $this->primernombredocente;
    }

    /**
     * Set segundonombredocente
     *
     * @param string $segundonombredocente
     *
     * @return Docente
     */
    public function setSegundonombredocente($segundonombredocente)
    {
        $this->segundonombredocente = $segundonombredocente;

        return $this;
    }

    /**
     * Get segundonombredocente
     *
     * @return string
     */
    public function getSegundonombredocente()
    {
        return $this->segundonombredocente;
    }

    /**
     * Set primerapellidodocente
     *
     * @param string $primerapellidodocente
     *
     * @return Docente
     */
    public function setPrimerapellidodocente($primerapellidodocente)
    {
        $this->primerapellidodocente = $primerapellidodocente;

        return $this;
    }

    /**
     * Get primerapellidodocente
     *
     * @return string
     */
    public function getPrimerapellidodocente()
    {
        return $this->primerapellidodocente;
    }

    /**
     * Set segundoapellidodocente
     *
     * @param string $segundoapellidodocente
     *
     * @return Docente
     */
    public function setSegundoapellidodocente($segundoapellidodocente)
    {
        $this->segundoapellidodocente = $segundoapellidodocente;

        return $this;
    }

    /**
     * Get segundoapellidodocente
     *
     * @return string
     */
    public function getSegundoapellidodocente()
    {
        return $this->segundoapellidodocente;
    }

    /**
     * Set dui
     *
     * @param string $dui
     *
     * @return Docente
     */
    public function setDui($dui)
    {
        $this->dui = $dui;

        return $this;
    }

    /**
     * Get dui
     *
     * @return string
     */
    public function getDui()
    {
        return $this->dui;
    }

    /**
     * Set direcciondocente
     *
     * @param string $direcciondocente
     *
     * @return Docente
     */
    public function setDirecciondocente($direcciondocente)
    {
        $this->direcciondocente = $direcciondocente;

        return $this;
    }

    /**
     * Get direcciondocente
     *
     * @return string
     */
    public function getDirecciondocente()
    {
        return $this->direcciondocente;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Docente
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set fechanacimiento
     *
     * @param \DateTime $fechanacimiento
     *
     * @return Docente
     */
    public function setFechanacimiento($fechanacimiento)
    {
        $this->fechanacimiento = $fechanacimiento;

        return $this;
    }

    /**
     * Get fechanacimiento
     *
     * @return \DateTime
     */
    public function getFechanacimiento()
    {
        return $this->fechanacimiento;
    }

    //metodos hechos por mi (Fredy)
    //Metodo para obtener el ambos nombres en una sola cadena
    public function getNombredocente()
    {
        return $this->getPrimernombredocente()." ".$this->getSegundonombredocente();
    }

    public function getApellidodocente()
    {
        return $this->getPrimerapellidodocente()." ".$this->getSegundoapellidodocente();
    }

    public function setNombredocente($nombres)
    {
        $nombre = explode(" ", $nombres);
        $this->primernombredocente = $nombre[0];
        $this->segundonombredocente = $nombre[1];
        return $this;
    }

    public function setApellidodocente($apellidos)
    {
        $apellido = explode(" ", $apellidos);
        $this->primerapellidodocente = $apellido[0];
        $this->segundoapellidodocente = $apellido[1];
        return $this;
    }
//Nada
    /**
     * Set carnetdocente
     *
     * @param string $carnetdocente
     *
     * @return Docente
     */
    public function setCarnetdocente($carnet)
    {
        $this->carnetdocente = $carnet;

        return $this;
    }
}
