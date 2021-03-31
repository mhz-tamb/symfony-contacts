<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Class ContactFixtures
 * @package App\DataFixtures
 */
class ContactFixtures extends Fixture
{
    /**
     * Quantity of generated values
     */
    const CONTACTS_QUANTITY = 15;

    /**
     * @param \Doctrine\Persistence\ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('ru_RU');

        for ($i = 0; $i < self::CONTACTS_QUANTITY; $i++) {
            $contact = new Contact();
            $contact->setName($faker->name);
            $contact->setEmail($faker->email);
            $contact->setPhone($faker->phoneNumber);
            $contact->setAddress($faker->address);

            $manager->persist($contact);
        }

        $manager->flush();
    }
}