<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 15/11/18
 * Time: 15:37
 */

namespace App\Form;


use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{

    public function buildForm (FormBuilderInterface $builder, array $options)
   {
        $builder->add('name')
                ;
    }

   public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}