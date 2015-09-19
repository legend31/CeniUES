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
     * @ORM\GeneratedValue(strategy="IDENTITY")
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


}

