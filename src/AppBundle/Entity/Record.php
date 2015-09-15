<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Record
 *
 * @ORM\Table(name="record", indexes={@ORM\Index(name="fk_Record_Nivel1_idx", columns={"Nivel_idNivel"}), @ORM\Index(name="fk_Record_RecordAlumno1_idx", columns={"RecordAlumno_idRecordAlumno"})})
 * @ORM\Entity
 */
class Record
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idRecord", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrecord;

    /**
     * @var integer
     *
     * @ORM\Column(name="esGraduado", type="integer", nullable=false)
     */
    private $esgraduado;

    /**
     * @var \Nivel
     *
     * @ORM\ManyToOne(targetEntity="Nivel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Nivel_idNivel", referencedColumnName="idNivel")
     * })
     */
    private $nivelnivel;

    /**
     * @var \Recordalumno
     *
     * @ORM\ManyToOne(targetEntity="Recordalumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RecordAlumno_idRecordAlumno", referencedColumnName="idRecordAlumno")
     * })
     */
    private $recordalumnorecordalumno;


}

