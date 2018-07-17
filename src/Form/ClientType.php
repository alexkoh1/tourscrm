<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('tail')
            ->add(
                'phone',
                TextType::class,
                [
                    'attr' => [
                        'data-mask' => '+7 (000) 000-00-00',
                        'placeholder' => '+7 (961) 359-30-39'
                    ],
                ]
            )
            ->add('vk')
            ->add('telegram')
            ->add('tours')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
