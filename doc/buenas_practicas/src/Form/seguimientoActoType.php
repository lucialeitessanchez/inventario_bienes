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

class seguimientoActoType extends AbstractType {

    private $em;
    private $em_instituciones;

    public function buildForm(FormBuilderInterface $builder, array $options) {
        //$this->idorigen = $options['idorigen'];
        $this->em = $options['em'];
        $this->em_instituciones = $options['em_instituciones'];
        $builder->add('montoaprobado', TextType::class, [
                    'label' => 'Monto Aprobado',
                    'required' => true,
                ])
                ->add('fechamontoaprobado', DateType::class, [
                    'widget' => 'single_text',
                    // prevents rendering it as type="date", to avoid HTML5 date pickers
                    'html5' => true,
                    'label' => 'Fecha de aprobación',
                    'required' => false,
                ])
                ->add('observacion', TextType::class, [
                    'label' => 'Observaciones',
                    'required' => false,
                ])
                ->add('detallecomponenteIddetallecomponentesolicitado', EntityType::class, array(
                    'mapped' => true,
                    'required' => true,
                    'label' => 'Componente Aprobado',
                    'multiple' => true,
                    'choice_label' => 'descripcionCombo',
                    'placeholder' => 'Todos',
                    'class' => DetalleComponente::class,
                ))
                ->add('fechadictamen', DateType::class, [
                    'widget' => 'single_text',
                    // prevents rendering it as type="date", to avoid HTML5 date pickers
                    'html5' => true,
                    'label' => 'Fecha Dictamen',
                    'required' => false,
                ])
                ->add('observaciondictamen', TextType::class, [
                    'label' => 'Observación Dictamen',
                    'required' => false,
                    'mapped' => true,
                ])
                ->add('fechapago', DateType::class, [
                    'widget' => 'single_text',
                    // prevents rendering it as type="date", to avoid HTML5 date pickers
                    'html5' => true,
                    'label' => 'Fecha de Pago',
                    'required' => false,
                ])
                ->add('nroresolucion', IntegerType::class, [
                    'label' => 'Número Resolución',
                    'required' => false,
                ])
                ->add('fecharesolucion', DateType::class, [
                    'widget' => 'single_text',
                    // prevents rendering it as type="date", to avoid HTML5 date pickers
                    'html5' => true,
                    'label' => 'Fecha Resolución',
                    'required' => false,
                ])
                ->add('observacionbp', TextareaType::class, [
                    'label' => 'Observaciones / Novedades',
                    'required' => false,
                    'mapped' => false,
                ])
                ->add('nombreinstitucion', EntityType::class, array(
                    'class' => 'App\Entity\Actoadministrativo',
                    'label' => 'Nombre Institución',
                    'em' => 'default',
                    'query_builder' => function($er) {
                        return $er->createQueryBuilder('instbusca')
                                ->groupBy('instbusca.nombreinstitucion')
                                ->orderBy('instbusca.nombreinstitucion', 'ASC');
                    },
                    'choice_label' => 'nombreinstitucion',
                    'placeholder' => 'SELECCIONE',
                    'mapped' => false,
                    'required' => false
                ))
                ->add('idestado', EntityType::class, array(
                    'required' => false,
                    'mapped' => false,
                    'label' => 'Estado',
                    'choice_label' => 'estadodescripcion',
                    'placeholder' => 'Estado',
                    'class' => Estadoactoadministrativo::class,
                    'query_builder' => function ($e) {
                        return $e->createQueryBuilder('estado');
                    },
                ))
                ->add('filtrar', IntegerType::class, [
                    'label' => 'clickeo',
                    'required' => false,
                    'mapped' => false,
                ])
                ->add('filtrarExpediente', TextType::class, [
                    'label' => 'clickeo',
                    'required' => false,
                    'mapped' => false,
                ])
                ->add('filtrarEstado', IntegerType::class, [
                    'label' => 'clickeo',
                    'required' => false,
                    'mapped' => false,
                ])
                            
                ->add('fechaDesde', DateType::class, [
                    'widget' => 'single_text',
                    // prevents rendering it as type="date", to avoid HTML5 date pickers
                    'html5' => true,
                    'label' => 'DESDE',
                    'required' => false,
                    'mapped' => false,
                ])
                ->add('fechaHasta', DateType::class, [
                    'widget' => 'single_text',
                    // prevents rendering it as type="date", to avoid HTML5 date pickers
                    'html5' => true,
                    'label' => 'HASTA',
                    'required' => false,
                    'mapped' => false,
                ])            
                ->add('filtrarLista', SubmitType::class, ['label' => 'Filtrar'])
                ->add('limpiar', SubmitType::class, ['label' => 'Limpiar'])
                ->add('imprimir', SubmitType::class, ['label' => 'Imprimir resultado'])                            
                ->add('guardar_datos', SubmitType::class, ['label' => 'Guardar'])
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
