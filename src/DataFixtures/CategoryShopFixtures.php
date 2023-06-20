<?php
namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryShopFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        $c = [
            1 => [
                'name' => 'Pantalons',
                'slug' => 'pantalons'
            ],
            2 => [
                'name' => 'T-shirts',
                'slug' => 't-shirts'
            ],
            3 => [
                'name' => 'Chaussures',
                'slug' => 'chaussures'
            ],
            4 => [
                'name' => 'Vestes',
                'slug' => 'vestes'
            ]
        ];

        foreach($c as $k => $value)
        {
            $categoryShop = new Categories();
            $categoryShop->setName($value['name']);
            $categoryShop->setSlug($value['slug']);
            $manager->persist($categoryShop); // veut lui dire que tous les valeur du tableau doit être sur la bd
            $this->addReference('categoryShop-'.$k, $categoryShop);
        }

        $manager->flush();
    }
}