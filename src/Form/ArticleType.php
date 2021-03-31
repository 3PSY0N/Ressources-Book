<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;

use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    /** @var CategoryRepository */
    private CategoryRepository $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo ) {
        $this->categoryRepo = $categoryRepo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Article title',
                'constraints' => [

                ]
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'label' => 'Article categories',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                              ->orderBy('u.name', 'ASC');
                },
                'multiple' => true,
                'attr' => ['class' => 'text-uppercase'],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Article Content',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
