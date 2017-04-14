<?php

namespace TeachingClassBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PreguntaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('pregunta')
        //->add('fechaAlta')
        //->add('fechaBaja')
        //->add('fechaModificacion')
        //->add('envio')
        //->add('claseDidactica')
        ->add('tipoPregunta');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TeachingClassBundle\Entity\Pregunta'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'teachingclassbundle_pregunta';
    }


}
