<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 19/11/18
 * Time: 10:32
 */

namespace App\Form;

use App\Entity\Category;
use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ArticleType extends AbstractType
{

    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
                 ->add('content');
        $builder->add('category', EntityType::class, [
                 'class'=>Category::class,
               'choice_label' => 'name',
        ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }


}