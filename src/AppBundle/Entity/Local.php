<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Local
 *
 * @ORM\Table(name="local")
 * @ORM\Entity
 */
class Local
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idLocal", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlocal;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreLocal", type="string", length=70, nullable=false)
     */
    private $nombrelocal;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreFacultad", type="string", length=70, nullable=true)
     */
    private $nombrefacultad;


}

