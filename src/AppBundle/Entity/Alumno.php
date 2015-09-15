<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alumno
 *
 * @ORM\Table(name="alumno", indexes={@ORM\Index(name="fk_Alumno_Matricula1_idx", columns={"Matricula_idMatricula"}), @ORM\Index(name="fk_Alumno_Padre1_idx", columns={"Padre_idPadre"}), @ORM\Index(name="fk_Alumno_Responsable1_idx", columns={"Responsable_idResponsable"})})
 * @ORM\Entity
 */
class Alumno
{
    /**
     * @var string
     *
     * @ORM\Column(name="carnetAlumno", type="string", length=7, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @var \Matricula
     *
     * @ORM\ManyToOne(targetEntity="Matricula")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Matricula_idMatricula", referencedColumnName="idMatricula")
     * })
     */
    private $matriculamatricula;

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


}

