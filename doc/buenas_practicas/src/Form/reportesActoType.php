<?php

namespace App\Form;

use App\Entity\Actoadministrativo;
use App\Entity\Area;
use App\Entity\Tiposolicitante;
use App\Entity\Componente;
use App\Entity\Detallecomponente;
use App\Entity\Checkrequisitos;
use App\Entity\Estadoactoadministrativo;
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

class reportesActoType extends AbstractType {

    private $em;
    private $em_instituciones;

    public function buildForm(FormBuilderInterface $builder, array $options) {
        //$this->idorigen = $options['idorigen'];
        $this->em = $options['em'];
        $this->em_instituciones = $options['em_instituciones'];

        $builder->add('fechaDesde', DateType::class, [
                    'widget' => 'single_text',
                    // prevents rendering it as type="date", to avoid HTML5 date pickers
                    'html5' => true,
                    'label' => 'Fecha ingreso desde',
                    'required' => false,
                    'mapped' => false,
                ])
                ->add('fechaHasta', DateType::class, [
                    'widget' => 'single_text',
                    // prevents rendering it as type="date", to avoid HTML5 date pickers
                    'html5' => true,
                    'label' => 'Fecha ingreso hasta',
                    'required' => false,
                    'mapped' => false,
                ])
                 
                ->add('filtrar', SubmitType::class, ['label' => 'Filtrar'])
                ->add('evalua_secretario', SubmitType::class, ['label' => 'Generar reporte'])
                ->add('envio_ue', SubmitType::class, ['label' => 'Generar reporte'])
                ->add('envio_para_dictaminar', SubmitType::class, ['label' => 'Generar reporte'])

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

    //*************************************************************
}
