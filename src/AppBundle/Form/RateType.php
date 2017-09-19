<?php

namespace AppBundle\Form;

use AppBundle\Entity\Forecast;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{
    NumberType, SubmitType
};

/**
 * RateType
 */
class RateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('homeRate', NumberType::class)
            ->add('guestRate', NumberType::class)
            ->add('submit', SubmitType::class, [
                'label' => 'Set',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Forecast::class,
            'csrf_protection' => false,
        ]);
    }

}
