<?php

namespace DR\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

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
        ->add('startdate', DateType::class)
        ->add('enddate', DateType::class)
        ->add('copy')
        ->add('comment')
        ->add('type')
        ->add('folder', EntityType::class, array(
            'class' => 'DRPlatformBundle:Folder',
            'choice_label' => 'name'))
        ->add('supplier', EntityType::class, array(
            'class' => 'DRPlatformBundle:Supplier',
            'choice_label' => 'name'))
        ->add('customer', EntityType::class, array(
            'class' => 'DRPlatformBundle:Customer',
            'choice_label' => 'name'))
        ->add('area', EntityType::class, array(
            'class' => 'DRPlatformBundle:Area',
            'choice_label' => 'country'))
        ->add('support', EntityType::class, array(
            'class' => 'DRPlatformBundle:Support',
            'choice_label' => 'name'))
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
