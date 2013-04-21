<?php
/**
 * User: jonathan
 * Date: 11/14/12
 * Time: 10:41 PM
 */

namespace Voileux\CoreBundle\DataFixtures\ORM;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Voileux\CoreBundle\Entity\Boat;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Voileux\CoreBundle\Util\String;

class LoadBoatData extends AbstractFixture implements DependentFixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $boats = array(
            array(
                'name' => 'Felouque',
                'city' => 'Louxor',
                'country' => 'Egypte',
                'description' => '<p>Location d\'une félouque, voilier traditionnel du Nil, avec équipage chevronné (nécessaire à l\'initiation à la navigation) pour balades entres Assouan et Esna ou entre Louxor et Esna.
                        <br>
                        Couchage pour 6 personnes sur le pont (sur de très confortables matelas! ). Dais entièrement fermé pour la nuit.<br>
                        Réchaud à gaz et matériel de cuisine disponible à bord.</p>',
                'rent_type' => 1,
                'min_rent_duration' => 5,
                'length' => 9.1,
                'cabins' => 1,
                'accomodation' => 6,
                'owner' => $this->getReference('user-marcaudonnet'),
                'price' => 90,
                'photos' => array('location-felouque-assouan-egypte.jpg'),
                'position' => Boat::BOAT_POSITION_HOME,
            ),
            array(
                'name' => 'First 45 F5',
                'city' => 'Toulon',
                'country' => 'France',
                'description' => 'Quelques heures ou journées inoubliables sur un voilier de 14,20 mètres super équipé.

Le First 45F5 est un bateau très rapide (plan Bruce farr) et confortable (désigner Pininfarina)',
                'rent_type' => 1,
                'min_rent_duration' => 1,
                'length' => 14.20,
                'cabins' => 3,
                'accomodation' => 6,
                'owner' => $this->getReference('user-jmyebra'),
                'price' => 60,
                'photos' => array('first45f5-location-toulon.jpg'),
                'position' => Boat::BOAT_POSITION_HOME,
            ),
            array(
                'name' => 'Sortilège',
                'city' => 'Nosy Be',
                'country' => 'Madagascar',
                'description' => 'Croisière dans les archipels de Nosy Be au large de Madagascar dans un Sortilège des chantiers Dufour en très bon état.',
                'rent_type' => 1,
                'min_rent_duration' => 2,
                'length' => 12.5,
                'cabins' => 2,
                'accomodation' => 6,
                'owner' => $this->getReference('user-tfabre'),
                'price' => 290,
                'photos' => array('location-voilier-sortilege-madagascar.jpg'),
                'position' => Boat::BOAT_POSITION_HOME,
            ),
        );



        foreach($boats as $boat) {
            $this->loadBoat($boat, $manager);
        }
        $manager->flush();
    }

    private function loadBoat($boat, ObjectManager $manager)
    {
        $boatObject = new Boat();
        $boatObject->setName($boat['name']);
        $boatObject->setSlug(String::slug($boat['name'].' '.$boat['city'].' '.$boat['country'], '-'));
        $boatObject->setCity($boat['city']);
        $boatObject->setAccomodation($boat['accomodation']);
        $boatObject->setCountry($boat['country']);
        $boatObject->setDescription($boat['description']);
        $boatObject->setRentType($boat['rent_type']);
        $boatObject->setMinRentDuration($boat['min_rent_duration']);
        $boatObject->setLength($boat['length']);
        $boatObject->setCabins($boat['cabins']);
        $boatObject->setOwner($boat['owner']);
        $boatObject->setPricePerDay($boat['price']);
        $boatObject->setPhotos($boat['photos']);
        $boatObject->setPosition($boat['position']);

        $this->setReference($boat['name'], $boatObject);

        $manager->persist($boatObject);

    }

    public function getDependencies()
    {
        return array(
            'Voileux\CoreBundle\DataFixtures\ORM\LoadUserData',
        );
    }
}