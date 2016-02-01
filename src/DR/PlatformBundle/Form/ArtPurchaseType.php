<?php

namespace DR\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtPurchaseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('visualname')
            ->add('linkfile')
            ->add('cost')
            ->add('reference')
            ->add('ordeform')
            ->add('startdate', 'datetime')
            ->add('enddate', 'datetime')
            ->add('copy')
            ->add('comment')
            ->add('type')
            ->add('folder')
            ->add('supplier')
            ->add('customer')
            ->add('area')
            ->add('support')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DR\PlatformBundle\Entity\ArtPurchase'
        ));
    }
}
