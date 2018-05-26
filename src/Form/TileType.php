<?php

namespace WeatherApp\Form;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use WeatherApp\Entity\Tile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * TileType
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class TileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', TextType::class, ['label' => 'city'])
            ->add('latitude', TextType::class)
            ->add('longitude', TextType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => Tile::class,
            'translation_domain' => 'messages'
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
