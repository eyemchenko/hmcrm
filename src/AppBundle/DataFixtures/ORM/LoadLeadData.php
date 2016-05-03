<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Lead;
use AppBundle\Entity\User;

/**
 * LoadLeadData class.
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LoadLeadData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'AppBundle\DataFixtures\ORM\LoadUserData',
        ];
    }

    public function load(ObjectManager $manager)
    {
        /** @var User $userAdmin */
        $userAdmin = $this->getReference('user-admin');

        $lead1 = (new Lead())
            ->setFirstName('Сергей')
            ->setLastName('Иванов')
            ->setCompanyName('Лукойл')
            ->setTitle('Лукойл')
            ->setEmail('seregaaa@gmail.com')
            ->setMobilePhone('+380950945789')
            ->setWorkPhone('+38098453345')
            ->setAddress('проулок Победы 12')
            ->setCity('Воронеж')
            ->setRegion('Воронеж')
            ->setCountry('Россия')
            ->setTags('Новый клиент, перспективный')
            ->setLeadStatus(1)
            ->setUser($userAdmin);
        $this->setReference('lead-1', $lead1);
        $manager->persist($lead1);

        $lead2 = (new Lead())
            ->setFirstName('Мария')
            ->setLastName('Русланова')
            ->setCompanyName('Диджитал Солюшен')
            ->setTitle('Диджитал Солюшен')
            ->setEmail('mariyaaa@gmail.com')
            ->setMobilePhone('+38090941289')
            ->setWorkPhone('+38098723345')
            ->setAddress('проулок Свобооды 72')
            ->setCity('Киев')
            ->setRegion('Киев')
            ->setCountry('Украина')
            ->setTags('Клиент')
            ->setLeadStatus(1)
            ->setUser($userAdmin);
        $this->setReference('lead-2', $lead2);
        $manager->persist($lead2);

        $lead3 = (new Lead())
            ->setFirstName('Игорь')
            ->setLastName('Лапун')
            ->setCompanyName('Мистраль')
            ->setTitle('Мистраль')
            ->setEmail('iga_mistrag@gmail.com')
            ->setMobilePhone('+38093941289')
            ->setWorkPhone('+38098543345')
            ->setAddress('улица Центральная 18, кв 19')
            ->setCity('Харьков')
            ->setRegion('Харьков')
            ->setCountry('Украина')
            ->setTags('Клиент')
            ->setLeadStatus(2)
            ->setUser($userAdmin);
        $this->setReference('lead-3', $lead3);
        $manager->persist($lead3);

        $manager->flush();
    }
}