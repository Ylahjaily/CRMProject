<?php


namespace App\Tests\Entity;

use App\Entity\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{

    private $contact;

    public function setUp(): void
    {
        $this->contact = new Contact();
        $this->contact->setFirstname('toto');
        $this->contact->setLastname('foo');
        $this->contact->setEmail('toto@mail.com');
        $this->contact->setPhoneNumber('0644586295');
    }

    public function tearDown(): void
    {
        unset($this->contact);
    }

    public function testGetId()
    {
        $contact = new Contact();
        static::assertSame(
            null,
            $contact->getId()
        );
    }

    public function testSetLastname()
    {
        $contact = new Contact();
        $contact->setLastName("lastname");
        static::assertSame(
            "lastname",
            $contact->getLastName()
        );
    }

    public function testSetFirstName()
    {
        $contact = new Contact();
        $contact->setFirstName("firstname");
        static::assertSame(
            "firstname",
            $contact->getFirstName()
        );
    }

    public function testSetEmail()
    {
        $contact = new Contact();
        $contact->setEmail("email@email.fr");
        static::assertSame(
            "email@email.fr",
            $contact->getEmail()
        );
    }

    public function testSetPhoneNumber()
    {
        $contact = new Contact();
        $contact->setPhoneNumber("0750933920");
        static::assertSame(
            "0750933920",
            $contact->getPhoneNumber()
        );
    }

}
