<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recordalumno
 *
 * @ORM\Table(name="recordalumno", indexes={@ORM\Index(name="fk_RecordAlumno_Alumno1_idx", columns={"Alumno_carnetAlumno"})})
 * @ORM\Entity
 */
class Recordalumno
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idRecordAlumno", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrecordalumno;

    /**
     * @var float
     *
     * @ORM\Column(name="notaFinal", type="float", precision=10, scale=0, nullable=false)
     */
    private $notafinal;

    /**
     * @var \Alumno
     *
     * @ORM\ManyToOne(targetEntity="Alumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Alumno_carnetAlumno", referencedColumnName="carnetAlumno")
     * })
     */
    private $alumnoCarnetalumno;


}

