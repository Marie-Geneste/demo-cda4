<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $toto = new User();
        $toto->setEmail('toto@toto.fr');
        //1er argument le user et 2eme le mdp qu'on veut hasher
        $hash = $this->passwordHasher->hashPassword($toto, 'toto');
        $toto->setPassword($hash);
        $manager->persist($toto);

        $admin = new User();
        $admin->setEmail('admin@admin.fr');
        $adminHash = $this->passwordHasher->hashPassword($admin, 'admin');
        $admin->setPassword($adminHash);
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);


        $boissons = new Categorie();
        $boissons-> setName("Boissons");
        $manager->persist($boissons);

        $eau = new Produit();
        $eau-> setName('Eau minérale');
        $eau-> setPrice(1.2);
        $eau-> setDescription("De l'eau bien pure");
        $eau-> setStock(10);
        $eau-> setCategorie($boissons);
        $manager->persist($eau);

        $manager->flush();
    }
}
