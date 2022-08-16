<?php

namespace App\Form;

use App\Entity\Actoadministrativo;
use App\Entity\Area;


use App\Entity\tablascomunes\TLoc;
use App\Entity\ruinstituciones\Institucion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;

class bajaActoType extends AbstractType {

    private $em;
    private $em_instituciones;

    public function buildForm(FormBuilderInterface $builder, array $options) {
        //$this->idorigen = $options['idorigen'];
        $this->em = $options['em'];
        $this->em_instituciones = $options['em_instituciones'];
        $builder
                ->add('fechabaja', DateType::class, [
                    'widget' => 'single_text',
                    // prevents rendering it as type="date", to avoid HTML5 date pickers
                    'html5' => true,
                    'label' => 'Fecha de Baja',
                    'required' => false,
                ])
                ->add('motivobaja', TextType::class, [
                    'label' => 'Motivo',
                    'required' => false,
                ])
                
                
               
                ->add('filtrarLista', SubmitType::class, ['label' => 'Filtrar'])
                ->add('btnbaja', SubmitType::class, ['label' => 'Baja'])
        //          ->add('agregar', SubmitType::class, ['label' => 'Agregar'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Actoadministrativo'
        ));

        $resolver->setRequired('em');
        $resolver->setRequired('em_instituciones');
    }

    public function getBlockPrefix() {
        return 'form';
    }
}
