<?php

namespace project\GameHubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SujetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('text',TextareaType::class)
            ->add('category', ChoiceType::class, array(
                'choices'   => array('fps' => 'fps',
                    'mmo rpg' => 'mmo rpg',
                    'aventure' => 'aventure',
                    'strategie' => 'strategie',
                    'infiltration' => 'infiltration',
                    'plateforme' => 'plateforme',
                    'arcade' => 'arcade'

                    ),
                'required'  => false,
            ))

        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'project\GameHubBundle\Entity\Sujet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'project_gamehubbundle_sujet';
    }


}
