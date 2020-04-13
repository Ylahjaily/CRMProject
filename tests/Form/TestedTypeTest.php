<?php


namespace App\Tests\Form;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Form\Test\TypeTestCase;

class TestedTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'firstName' => 'Franck',
            'lastName' => 'Lampard',
            'phoneNumber' => '0750933920',
            'email' => 'email@email.fr'
        ];

        $objectToCompare = new Contact();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(ContactType::class, $objectToCompare);

        $object = new Contact();

        $object->setFirstName('Franck');
        $object->setLastName('Lampard');
        $object->setPhoneNumber('0750933920');
        $object->setEmail('email@email.fr');

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        // check that $objectToCompare was modified as expected when the form was submitted
        $this->assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
