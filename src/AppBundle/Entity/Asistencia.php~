<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asistencia
 *
 * @ORM\Table(name="asistencia", indexes={@ORM\Index(name="fk_Asistencia_Clase1_idx", columns={"Clase_idClase"}), @ORM\Index(name="fk_Asistencia_AsistenciaDia1_idx", columns={"AsistenciaDia_idAsistenciaDia"})})
 * @ORM\Entity
 */
class Asistencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idAsistencia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idasistencia;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=60, nullable=true)
     */
    private $descripcion;

    /**
     * @var \Asistenciadia
     *
     * @ORM\ManyToOne(targetEntity="Asistenciadia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="AsistenciaDia_idAsistenciaDia", referencedColumnName="idAsistenciaDia")
     * })
     */
    private $asistenciadiaasistenciadia;

    /**
     * @var \Clase
     *
     * @ORM\ManyToOne(targetEntity="Clase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Clase_idClase", referencedColumnName="idClase")
     * })
     */
    private $claseclase;


}

