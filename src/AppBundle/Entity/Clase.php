<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clase
 *
 * @ORM\Table(name="clase", indexes={@ORM\Index(name="fk_Clase_Nivel1_idx", columns={"Nivel_idNivel"}), @ORM\Index(name="fk_Clase_Local1_idx", columns={"Local_idLocal"}), @ORM\Index(name="fk_Clase_Docente1_idx", columns={"Docente_carnetDocente"})})
 * @ORM\Entity
 */
class Clase
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idClase", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idclase;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horario", type="time", nullable=true)
     */
    private $horario;

    /**
     * @var string
     *
     * @ORM\Column(name="turno", type="string", length=45, nullable=true)
     */
    private $turno;

    /**
     * @var \Docente
     *
     * @ORM\ManyToOne(targetEntity="Docente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Docente_carnetDocente", referencedColumnName="carnetDocente")
     * })
     */
    private $docenteCarnetdocente;

    /**
     * @var \Local
     *
     * @ORM\ManyToOne(targetEntity="Local")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Local_idLocal", referencedColumnName="idLocal")
     * })
     */
    private $locallocal;

    /**
     * @var \Nivel
     *
     * @ORM\ManyToOne(targetEntity="Nivel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Nivel_idNivel", referencedColumnName="idNivel")
     * })
     */
    private $nivelnivel;


}

