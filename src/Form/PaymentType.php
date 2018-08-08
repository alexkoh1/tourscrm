<?php

namespace App\Form;

use App\Entity\Payment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Intl\DateFormatter\IntlDateFormatter;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sum')
            ->add(
                'proccedTime',
                DateTimeType::Class,
                [
                    'widget' => 'single_text',
                    'html5'  => false,
                    'attr'   =>
                        [
                            'format' => 'yyyy-MM-dd HH:mm:ss'
                        ],
                ]
            )
            ->add(
                'client',
                null,
                [
                    'attr' => ['data-select' => 'true']
                ]
            )
            ->add('tour')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Payment::class,
            'csrf_protection' => false,
        ]);
    }
}
