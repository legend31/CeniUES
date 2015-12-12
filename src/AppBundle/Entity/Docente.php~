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
     * @ORM\Column(name="primerNombreDocente", type="string", length=25, nullable=false)
     */
    private $primernombredocente;

    /**
     * @var string
     *
     * @ORM\Column(name="segundoNombreDocente", type="string", length=25, nullable=true)
     */
    private $segundonombredocente;

    /**
     * @var string
     *
     * @ORM\Column(name="primerApellidoDocente", type="string", length=25, nullable=false)
     */
    private $primerapellidodocente;

    /**
     * @var string
     *
     * @ORM\Column(name="segundoApellidoDocente", type="string", length=25, nullable=true)
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

    //edad y estado las agregue yo (Fredy)
    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Docente
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }
    //Hasta aqui los campos que he añadidio

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=9, nullable=false)
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
    //Metodo para obtener ambos nombres en una sola cadena
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
        $cuenta = count($nombre);
        if($cuenta > 1){
            $this->primernombredocente = $nombre[0];
            $this->segundonombredocente = $nombre[1];
        }
        else {
            $this->primernombredocente = $nombres;
            $this->segundonombredocente = null;
        }
        return $this;
    }

    public function setApellidodocente($apellidos)
    {
        $apellido = explode(" ", $apellidos);
        $cuenta = count($apellido);
        if($cuenta > 1) {
            $this->primerapellidodocente = $apellido[0];
            $this->segundoapellidodocente = $apellido[1];
        }
        else {
            $this->primerapellidodocente = $apellidos;
            $this->segundoapellidodocente = null;
        }
        return $this;
    }

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
