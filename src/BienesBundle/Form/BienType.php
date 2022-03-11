<?php

namespace BienesBundle\Form;

use BienesBundle\BienesBundle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ColorType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityManagerInterface;

use BienesBundle\Entity\Tipo;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class BienType extends AbstractType
{
    


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('fechaAlta', DateType::class, [
            'label' => 'Fecha de Vencimiento',
            'widget' => 'single_text',
            'html5' => true
        ])->add('descripcion')->add('estado')->add('proveedor')->add(('responsable'))->add('ubicacion')
            ->add('factura');

        //$builder->addEventListener(FormEvents::PRE_SET_DATA, array($this,'onPreSetData'));
        //$builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));
        $builder->add('tipo');
        $builder->add('rama');
        $builder->add('consumible');
        
    }

  

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BienesBundle\Entity\Bien'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bienesbundle_bien';
    }


}
