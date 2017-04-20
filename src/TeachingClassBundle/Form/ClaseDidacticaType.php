<?php

namespace TeachingClassBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ClaseDidacticaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('descripcion')
        //->add('hora')
        //->add('fechaAlta')
        //->add('fechaBaja')
        //->add('fechaModificacion')
        //->add('estado');
        //->add('usuarioId')
        //->add('materia');
        ->add('habilitada', ChoiceType::class, array(
                            'choices'  => array(
                                'Habilitar' => true,
                                'Deshabilitar' => false,
                            ))
              );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TeachingClassBundle\Entity\ClaseDidactica'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'teachingclassbundle_clasedidactica';
    }


}
