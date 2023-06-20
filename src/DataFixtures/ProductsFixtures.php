<?php
namespace App\DataFixtures;

use App\Entity\Products;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class ProductsFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $createAt = new DateTimeImmutable(); // Utilisez DateTimeImmutable au lieu de DateTime

        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 20; $i++) {
            $product = new Products();
            $category = $this->getReference('categoryShop-'.$faker->numberBetween(1, 4));

            $product->setName($faker->sentence);
            $product->setSlug($faker->slug);
            $product->setDescription($faker->text);
            $product->setAvaible(true);
            $product->setCreateAt($createAt);
            $product->setPriceHT($faker->randomFloat(2));
            $product->setCategorie($category);
            $manager->persist($product);
        }

        $manager->flush();
    }
}