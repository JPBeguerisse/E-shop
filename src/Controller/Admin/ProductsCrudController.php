<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use App\Entity\Categories;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

use Vich\UploaderBundle\Form\Type\VichImageType;





class ProductsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Products::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            SlugField::new('slug')->setTargetFieldName('name'),
            TexteditorField::new('description'),
            BooleanField::new('avaible'),
            TextField::new('imageFile')->setFormType(VichImageType::class),
            ImageField::new('image')->setBasePath('/uploads/image')->onlyOnIndex(),
            MoneyField::new('priceHT')->setCurrency('EUR'),
            DateField::new('createAt'),
            AssociationField::new('categorie')
        ];
    }
    
}
