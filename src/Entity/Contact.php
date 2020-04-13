<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotNull()
     * @Assert\Length(min=5)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=false,)
     * @Assert\NotNull()
     * @Assert\Length(min=5)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255,  nullable=false, unique=true)
     * @Assert\NotNull()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, length=10, nullable=true, unique=true)
     *
     */
    private $phoneNumber;

    public function getId() : ? int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function isValidEmail(String $email)
    {
        if(!preg_match("/[a-zA-Z0-9_-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/", $email ) OR '' === $email)
        {
            return false;
        }
        return true;
    }
}
