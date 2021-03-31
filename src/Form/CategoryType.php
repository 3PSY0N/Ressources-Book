<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('color', ChoiceType::class, [
                'choices'  => [
                    'Primary'   => 'primary',
                    'Secondary' => 'secondary',
                    'Success'   => 'success',
                    'Info'      => 'info text-dark',
                    'Warning'   => 'warning text-dark',
                    'Danger'    => 'danger',
                    'Light'     => 'light text-dark',
                    'Dark'      => 'dark',
                    'Blue'      => 'blue',
                    'Indigo'    => 'indigo',
                    'Purple'    => 'purple',
                    'Pink'      => 'pink',
                    'Red'       => 'red',
                    'Orange'    => 'orange text-dark',
                    'Yellow'    => 'yellow text-dark',
                    'Green'     => 'green',
                    'Teal'      => 'teal text-dark',
                    'Cyan'      => 'cyan text-dark',
                    'White'     => 'white text-dark',
                    'Gray'      => 'gray',
                    'Gray-dark' => 'gray-dark'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
