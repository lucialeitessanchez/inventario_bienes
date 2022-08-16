<?php

namespace App\Form;

use App\Entity\Actoadministrativo;
use App\Entity\Area;
use App\Entity\Tiposolicitante;
use App\Entity\Componente;
use App\Entity\Detallecomponente;
use App\Entity\Checkrequisitos;
use App\Entity\Estadoactoadministrativo;
use App\Entity\Archivo;
use App\Entity\Tipodocumento;
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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class datosActoType extends AbstractType {

    private $em;
    private $em_instituciones;

    public function buildForm(FormBuilderInterface $builder, array $options) {
        //$this->idorigen = $options['idorigen'];
        $this->em = $options['em'];
        $this->em_instituciones = $options['em_instituciones'];

        $builder->add('observacionbp', TextareaType::class, [
                    'label' => 'Observaciones / Novedades',
                    'required' => false,
                    'mapped' => false,
                ])
                ->add('idestado', EntityType::class, array(
                    'required' => false,
                    'mapped' => false,
                    'label' => 'NUEVO ESTADO',
                    'choice_label' => 'estadodescripcion',
                    'placeholder' => 'Seleccione',
                    'class' => Estadoactoadministrativo::class,
                    'query_builder' => function ($e) {
                        return $e->createQueryBuilder('estado')
                                ->where('estado.idestado in (9,10)');
                    },
                ))
                ->add('fechadictamen', DateType::class, [
                    'widget' => 'single_text',
                    // prevents rendering it as type="date", to avoid HTML5 date pickers
                    'html5' => true,
                    'label' => 'Fecha Dictamen',
                    'required' => false,
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
                ->add('observaciondictamen', TextType::class, [
                    'label' => 'Observación Dictamen',
                    'required' => false,
                    'mapped' => true,
                ])
                ->add('brochure', FileType::class, [
                    'label' => ' ',
                    // unmapped means that this field is not associated to any entity property
                    'mapped' => false,
                    // make it optional so you don't have to re-upload the PDF file
                    // every time you edit the Product details
                    'required' => false,
                    // unmapped fields can't define their validation using annotations
                    // in the associated entity, so you can use the PHP constraint classes
                    'constraints' => [
                        new File([
                            'maxSize' => '1024k',
                            'mimeTypes' => [
                                'application/pdf',
                                'application/x-pdf',
                                'application/msword',
                                'application/vnd.oasis.opendocument.text',
                                'application/vnd.oasis.opendocument.spreadsheet',
                                'application/vnd.ms-excel',
                            ],
                            'mimeTypesMessage' => 'Por favor, cargue un archio válido',
                            'uploadFormSizeErrorMessage'=> 'El archivo es demasiado grande',
                                ])
                    ],
                ])
                ->add('idtipodocumento', EntityType::class, array(
                  'required' => false,
                  'mapped' => false,
                  'label' => 'Tipo documento',
                  'choice_label' => 'descripciondocumento',
                  'placeholder' => 'Seleccione',
                  'class' => Tipodocumento::class,
                  'query_builder' => function ($em) {
                  return $em->createQueryBuilder('tipos')
               ;
                  },
                  )) 
                
                ->add('guardar', SubmitType::class, ['label' => 'Guardar'])
        ;
      
    }

// =============================================================================================  
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
