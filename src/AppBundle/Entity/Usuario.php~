<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\Role\Role;


/**
 * Usuario
 *
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="fk_Usuario_Tipo_Usuario_idx", columns={"Tipo_Usuario_idTipo_Usuario"})})
 * @ORM\Entity
 */
class Usuario implements AdvancedUserInterface, \Serializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idUsuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idusuario;

    /**
     * @var string
     *
     * @ORM\Column(name="nomUsuario", type="string", length=45, nullable=false)
     */
    private $nomusuario;

    /**
     * @var string
     *
     * @ORM\Column(name="emailUsuario", type="string", length=45, nullable=false)
     */
    private $emailusuario;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64, nullable=false)
     */
    private $password;

    /**
     * @var integer
     *
     * @ORM\Column(name="isactive", type="integer", nullable=false)
     */
    private $isactive;

    /**
     * @var \TipoUsuario
     *
     * @ORM\ManyToOne(targetEntity="TipoUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipo_Usuario_idTipo_Usuario", referencedColumnName="idTipo_Usuario")
     * })
     */
    private $tipoUsuariotipoUsuario;

    /*----------------------------------------------------------------------------------------------------------------*/

    public function getIdusuario()
    {
        return $this->idusuario;
    }


    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;
    }


    public function getNomusuario()
    {
        return $this->nomusuario;
    }


    public function setNomusuario($nomusuario)
    {
        $this->nomusuario = $nomusuario;
    }


    public function getEmailusuario()
    {
        return $this->emailusuario;
    }


    public function setEmailusuario($emailusuario)
    {
        $this->emailusuario = $emailusuario;
    }


    public function getTipoUsuariotipoUsuario()
    {
        return $this->tipoUsuariotipoUsuario;
    }


    public function setTipoUsuariotipoUsuario($tipoUsuariotipoUsuario)
    {
        $this->tipoUsuariotipoUsuario = $tipoUsuariotipoUsuario;
    }

    public function setPassword($pass){
        $this->password=$pass;
    }

    public function getIsActive(){
        return $this->isactive;
    }


    public function serialize()
    {
        return serialize(array(
            $this->idusuario
        ));
    }


    public function unserialize($serialized)
    {
        list(
            $this->idusuario

            ) = unserialize($serialized);
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        $aux = $this->tipoUsuariotipoUsuario;
        if($aux == 'Administrador'){
            return array('ROLE_ADMINISTRADOR');
        }else{
            if($aux == 'Docente'){
                return array('ROLE_DOCENTE');
            }else return array('ROLE_ANONYMOUS');
        }
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {

    }

    public function getUsername()
    {
        return $this->nomusuario;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }

    /**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return bool true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return bool true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked()
    {
        return !($this->getIsActive()===2);
    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return bool true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return bool true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled()
    {
        return $this->getIsActive() === 1;
    }
}
