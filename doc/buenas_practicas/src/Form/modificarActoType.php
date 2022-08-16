<?php

namespace App\Form;

use App\Entity\Actoadministrativo;
use App\Entity\Area;
use App\Entity\Tiposolicitante;
use App\Entity\Componente;
use App\Entity\Detallecomponente;
use App\Entity\Estadoactoadministrativo;
use App\Entity\Checkrequisitos;
use App\Entity\Tipodocumento;
use App\Entity\tablascomunes\TLoc;
use App\Entity\ruinstituciones\Institucion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class modificarActoType extends AbstractType {

    private $em;
    private $em_instituciones;

//private $localidad;

    public function buildForm(FormBuilderInterface $builder, array $options) {
        //$this->idorigen = $options['idorigen'];
        $this->em = $options['em'];
        $this->em_instituciones = $options['em_instituciones'];
        //$this->localidad = $options['localidad'];

        $builder->add('nroNota', IntegerType::class, [
                    'label' => 'Número Nota',
                    'required' => false,
                ])
                ->add('fechaNota', DateType::class, [
                    'widget' => 'single_text',
                    // prevents rendering it as type="date", to avoid HTML5 date pickers
                    'html5' => true,
                    'label' => 'Fecha Nota',
                    'required' => false,
                ])
                ->add('tiposolicitanteIdtiposolicitante', EntityType::class, array(
                    'required' => true,
                    'label' => 'Tipo Solicitante',
                    'multiple' => false,
                    'choice_label' => 'descripcion',
                    'placeholder' => 'Todos',
                    'class' => Tiposolicitante::class,
                    'query_builder' => function ($repositorio) {
                        return $repositorio->createQueryBuilder('ts')->orderBy('ts.descripcion', 'ASC');
                    }
                ))
                ->add('instId', EntityType::class, array(
                    'class' => Institucion::class,
                    'choice_label' => 'instNom',
                    'placeholder' => 'SELECCIONE UNA LOCALIDAD',
                    'label' => 'Institución',
                ))
                ->add('localidad', EntityType::class, array(
                    'class' => TLoc::class,
                    'em' => 'default',
                    'query_builder' => function($er) {
                        return $er->createQueryBuilder('loc')
                                ->orderBy('loc.loc', 'ASC');
                    },
                    'choice_label' => 'loc',
                    'placeholder' => 'SELECCIONE',
                    'mapped' => false
                ))
                ->add('observacion', TextType::class, [
                    'label' => 'Detalle de lo solicitado',
                    'required' => false,
                ])
                ->add('referente', TextType::class, [
                    'label' => 'Referente 1',
                    'required' => false,
                ])
                ->add('referente2', TextType::class, [
                    'label' => 'Nombre Referente 2',
                    'required' => false,
                ])
                ->add('codigoareaRef2', TextType::class, [
                    'label' => 'Teléfono Referente 2 ',
                    'required' => false,
                    'mapped' => false,
                ])
                ->add('referente2codigoarea', TextType::class, [
                    'label' => 'Teléfono Referente 2',
                    'required' => false,
                        //'mapped' => false,
                ])
                ->add('referente2te', TextType::class, [
                    'label' => 'Número',
                    'required' => false,
                ])
                ->add('referente2mail', EmailType::class, [
                    'label' => 'Correo electrónico Referente 2',
                    'required' => false,
                ])
                ->add('contactoapenom', TextType::class, [
                    'label' => 'Nombre Contacto institucional',
                    'required' => false,
                ])
                ->add('contactocodigoarea', TextType::class, [
                    'label' => 'Teléfono Contacto ',
                    'required' => false,
                        //'mapped' => false,
                ])
                ->add('contactote', TextType::class, [
                    'label' => 'Número',
                    'required' => false,
                ])
                ->add('contactomail', EmailType::class, [
                    'label' => 'Correo electrónico Contacto',
                    'required' => false,
                ])
                ->add('tramiteurgente', ChoiceType::class, array('label' => 'Trámite Urgente?',
                    'choices' => array(
                        'Si' => '1',
                        'No' => '0'
                    ),
                    'required' => false,
                    'placeholder' => 'Seleccione...',
                        )
                )
                ->add('montoSolicitado', TextType::class, [
                    'label' => 'Monto Solicitado',
                    'required' => true,
                ])
                ->add('montoaprobado', TextType::class, [
                    'label' => 'Monto Aprobado',
                    'required' => false,
                ])
                ->add('fechamontoaprobado', DateType::class, [
                    'widget' => 'single_text',
                    // prevents rendering it as type="date", to avoid HTML5 date pickers
                    'html5' => true,
                    'label' => 'Fecha de aprobación',
                    'required' => false,
                ])
                ->add('nroexpediente', TextType::class, [
                    'label' => 'Nro Expediente',
                    'required' => false,
                ])
                ->add('fechaexpediente', DateType::class, [
                    'widget' => 'single_text',
                    // prevents rendering it as type="date", to avoid HTML5 date pickers
                    'html5' => true,
                    'label' => 'Fecha Expediente',
                    'required' => false,
                ])
                ->add('caratula', TextType::class, [
                    'label' => 'Carátula',
                    'required' => false,
                ])
                ->add('fechacaratula', DateType::class, [
                    'widget' => 'single_text',
                    // prevents rendering it as type="date", to avoid HTML5 date pickers
                    'html5' => true,
                    'label' => 'Fecha Carátula',
                    'required' => false,
                ])
                ->add('detallecomponenteIddetallecomponentesolicitado', EntityType::class, array(
                    'mapped' => true,
                    'required' => true,
                    'label' => 'Componente',
                    'multiple' => true,
                    'choice_label' => 'descripcionCombo',
                    'placeholder' => 'Todos',
                    'class' => DetalleComponente::class,
                ))
                ->add('idestado', EntityType::class, array(
                    'required' => false,
                    'mapped' => false,
                    'label' => 'NUEVO ESTADO',
                    'choice_label' => 'estadodescripcion',
                    'placeholder' => 'Seleccione',
                    'class' => Estadoactoadministrativo::class,
                    'query_builder' => function ($e) {
                        return $e->createQueryBuilder('estado')
                                ->where('estado.idestado in (3,4,12)');
                    },
                ))
                ->add('observacionbp', TextareaType::class, [
                    'label' => 'Observaciones / Novedades',
                    'required' => false,
                    'mapped' => false,
                ])
                ->add('cbuinstitucion', TextType::class, [
                    'label' => 'CBU Institución',
                    'required' => false,
                ])
                ->add('nrosipaf', TextType::class, [
                    'label' => 'Nro Sipaf',
                    'required' => false,
                ])
                ->add('detallerequisito', ChoiceType::class, [
                    'label' => 'Requisitos / Documentación presentada',
                    'choices' => $this->getRequisitos(),
                    'multiple' => true,
                    'expanded' => true,
                        //'choice_value'=>'1',
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
                            ],
                            'mimeTypesMessage' => 'Por favor, cargue un archio válido',
                          
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
                        return $em->createQueryBuilder('tipos');
                    },
                ))
                ->add('guardar_datos', SubmitType::class, ['label' => 'Guardar'])
        ;

        $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));
    }

// =============================================================================================  

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Actoadministrativo'
        ));

        $resolver->setRequired('em_instituciones');
        $resolver->setRequired('em');
        //  $resolver->setRequired('localidad');
    }

    public function getBlockPrefix() {
        return 'form';
    }

    protected function addElements(FormInterface $form, TLoc $localidad = null) {

        $formOptions = array(
            'class' => Institucion::class,
            'required' => true,
            'label' => 'Institucion:',
            'placeholder' => 'SELECCIONE');
        if ($localidad === null)
            $formOptions['choices'] = array();
        else {
            $formOptions['choice_label'] = 'inst_nom';
            //$em = $this->em;
            $em_instituciones = $this->em_instituciones;

            $formOptions['query_builder'] = function ($er) use ($localidad, $em_instituciones) {
                $qb = $em_instituciones->createQueryBuilder();
                //$er->getEntityManager();

                return $qb->select('a')->from(Institucion::class, 'a')
                                ->where('a.localidad = :localidad')
                                ->orderBy('a.instNom', 'ASC')
                                ->setParameter('localidad', $localidad->getIdLoc())
                ;
            };
        }
        $form->add('instId', EntityType::class, $formOptions);
    }

    //*************************************************************

    function getRequisitos() {

        $em = $this->em;

        $listaRequisitos = array();
        //$i = 0;

        $orm_Checkrequisitos = $em->getRepository(Checkrequisitos::class)->findAll();

        if (!empty($orm_Checkrequisitos)) {
            foreach ($orm_Checkrequisitos as $requisitos) {
                $listaRequisitos[$requisitos->getDetallerequisito()] = $requisitos->getIdcheckrequisitos();
                // $i++;
            }
        }

        return $listaRequisitos;
    }

    public function onPreSubmit($event) {
        //$curso = $event->getForm()->getData();
        $data = $event->getData();
//print_r($data['localidad']);

        $localidad = $this->em->getRepository(TLoc::class)->find($data['localidad']);
//echo $localidad->getLoc();
//die();
        $this->addElements($event->getForm(), $localidad);
    }

}
