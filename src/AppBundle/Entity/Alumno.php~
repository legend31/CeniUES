<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alumno
 *
 * @ORM\Table(name="alumno", indexes={@ORM\Index(name="fk_Alumno_Padre1_idx", columns={"Padre_idPadre"}), @ORM\Index(name="fk_Alumno_Responsable1_idx", columns={"Responsable_idResponsable"})})
 * @ORM\Entity
 */
class Alumno
{
    /**
     * @var string
     *
     * @ORM\Column(name="carnetAlumno", type="string", length=7, nullable=false)
     * @ORM\Id
     */
    private $carnetalumno;

    /**
     * @var string
     *
     * @ORM\Column(name="primerNombreAlumno", type="string", length=45, nullable=false)
     */
    private $primernombrealumno;

    /**
     * @var string
     *
     * @ORM\Column(name="segundoNombreAlumno", type="string", length=45, nullable=true)
     */
    private $segundonombrealumno;

    /**
     * @var string
     *
     * @ORM\Column(name="primerApellidoAlumno", type="string", length=45, nullable=false)
     */
    private $primerapellidoalumno;

    /**
     * @var string
     *
     * @ORM\Column(name="segundoApellidoAlumno", type="string", length=45, nullable=true)
     */
    private $segundoapellidoalumno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaNacimiento", type="date", nullable=false)
     */
    private $fechanacimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad", type="integer", nullable=true)
     */
    private $edad;

    /**
     * @var string
     *
     * @ORM\Column(name="direccionCasa", type="string", length=70, nullable=true)
     */
    private $direccioncasa;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoCasa", type="string", length=8, nullable=true)
     */
    private $telefonocasa;

    /**
     * @var \Padre
     *
     * @ORM\ManyToOne(targetEntity="Padre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Padre_idPadre", referencedColumnName="idPadre")
     * })
     */
    private $padrepadre;

    /**
     * @var \Responsable
     *
     * @ORM\ManyToOne(targetEntity="Responsable")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Responsable_idResponsable", referencedColumnName="idResponsable")
     * })
     */
    private $responsableresponsable;



    /**
     * Get carnetalumno
     *
     * @return string
     */
    public function getCarnetalumno()
    {
        return $this->carnetalumno;
    }

    /**
     * Set primernombrealumno
     *
     * @param string $primernombrealumno
     *
     * @return Alumno
     */
    public function setPrimernombrealumno($primernombrealumno)
    {
        $this->primernombrealumno = $primernombrealumno;

        return $this;
    }

    /**
     * Get primernombrealumno
     *
     * @return string
     */
    public function getPrimernombrealumno()
    {
        return $this->primernombrealumno;
    }

    /**
     * Set segundonombrealumno
     *
     * @param string $segundonombrealumno
     *
     * @return Alumno
     */
    public function setSegundonombrealumno($segundonombrealumno)
    {
        $this->segundonombrealumno = $segundonombrealumno;

        return $this;
    }

    /**
     * Get segundonombrealumno
     *
     * @return string
     */
    public function getSegundonombrealumno()
    {
        return $this->segundonombrealumno;
    }

    /**
     * Set primerapellidoalumno
     *
     * @param string $primerapellidoalumno
     *
     * @return Alumno
     */
    public function setPrimerapellidoalumno($primerapellidoalumno)
    {
        $this->primerapellidoalumno = $primerapellidoalumno;

        return $this;
    }

    /**
     * Get primerapellidoalumno
     *
     * @return string
     */
    public function getPrimerapellidoalumno()
    {
        return $this->primerapellidoalumno;
    }

    /**
     * Set segundoapellidoalumno
     *
     * @param string $segundoapellidoalumno
     *
     * @return Alumno
     */
    public function setSegundoapellidoalumno($segundoapellidoalumno)
    {
        $this->segundoapellidoalumno = $segundoapellidoalumno;

        return $this;
    }

    /**
     * Get segundoapellidoalumno
     *
     * @return string
     */
    public function getSegundoapellidoalumno()
    {
        return $this->segundoapellidoalumno;
    }

    /**
     * Set fechanacimiento
     *
     * @param \DateTime $fechanacimiento
     *
     * @return Alumno
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

    /**
     * Set edad
     *
     * @param integer $edad
     *
     * @return Alumno
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get edad
     *
     * @return integer
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set direccioncasa
     *
     * @param string $direccioncasa
     *
     * @return Alumno
     */
    public function setDireccioncasa($direccioncasa)
    {
        $this->direccioncasa = $direccioncasa;

        return $this;
    }

    /**
     * Get direccioncasa
     *
     * @return string
     */
    public function getDireccioncasa()
    {
        return $this->direccioncasa;
    }

    /**
     * Set telefonocasa
     *
     * @param string $telefonocasa
     *
     * @return Alumno
     */
    public function setTelefonocasa($telefonocasa)
    {
        $this->telefonocasa = $telefonocasa;

        return $this;
    }

    /**
     * Get telefonocasa
     *
     * @return string
     */
    public function getTelefonocasa()
    {
        return $this->telefonocasa;
    }

    /**
     * Set padrepadre
     *
     * @param \AppBundle\Entity\Padre $padrepadre
     *
     * @return Alumno
     */
    public function setPadrepadre(\AppBundle\Entity\Padre $padrepadre = null)
    {
        $this->padrepadre = $padrepadre;

        return $this;
    }

    /**
     * Get padrepadre
     *
     * @return \AppBundle\Entity\Padre
     */
    public function getPadrepadre()
    {
        return $this->padrepadre;
    }

    /**
     * Set responsableresponsable
     *
     * @param \AppBundle\Entity\Responsable $responsableresponsable
     *
     * @return Alumno
     */
    public function setResponsableresponsable(\AppBundle\Entity\Responsable $responsableresponsable = null)
    {
        $this->responsableresponsable = $responsableresponsable;

        return $this;
    }

    /**
     * Get responsableresponsable
     *
     * @return \AppBundle\Entity\Responsable
     */
    public function getResponsableresponsable()
    {
        return $this->responsableresponsable;
    }

    /**
     * Set carnetalumno
     *
     * @param string $carnetalumno
     *
     * @return Alumno
     */
    public function setCarnetalumno($carnetalumno)
    {
        $this->carnetalumno = $carnetalumno;

        return $this;
    }
}
