<?php

namespace TeachingClassBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlumnoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre')->add('apellido')->add('dni')->add('legajo')->add('fechaNacimiento')->add('localidad')->add('nacionalidad')->add('direccion')->add('mail')->add('telefono')->add('obraSocial')->add('fichaMedica')->add('sexo')->add('usuario')->add('fechaAlta')->add('fechaModificacion')->add('fechaBaja')->add('curso');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TeachingClassBundle\Entity\Alumno'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'teachingclassbundle_alumno';
    }


}
