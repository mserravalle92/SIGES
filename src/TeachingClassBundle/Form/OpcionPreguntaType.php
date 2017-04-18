<?php

namespace TeachingClassBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OpcionPreguntaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('opcion')
        ->add('correcta',ChoiceType::class, array(
              'choices'  => array(
                  'Si' => true,
                  'No' => false,
              ),));
        //->add('fechaAlta')
        //->add('fechaBaja')
        //->add('fechaModificacion')
        //->add('pregunta');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TeachingClassBundle\Entity\OpcionPregunta'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'teachingclassbundle_opcionpregunta';
    }


}
