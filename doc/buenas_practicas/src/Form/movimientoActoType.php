<?php

namespace App\Form;

use App\Entity\Movimiento;
use App\Entity\Area;
use App\Entity\Estadoactoadministrativo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class movimientoActoType extends AbstractType {

    private $em;
    private $em_instituciones;

    public function buildForm(FormBuilderInterface $builder, array $options) {
        //$this->idorigen = $options['idorigen'];
        $this->em = $options['em'];
        $this->em_instituciones = $options['em_instituciones'];

        $builder->add('fechamovimiento', DateType::class, [
                    'widget' => 'single_text',
                    // prevents rendering it as type="date", to avoid HTML5 date pickers
                    'html5' => true,
                    'label' => 'Fecha Movimiento',
                    'required' => true,
                ])
                ->add('areaIdareaorigen', EntityType::class, array(
                    'required' => true,
                    'label' => 'Área Origen',
                    'multiple' => false,
                    'choice_label' => 'Area',
                    'placeholder' => 'Todas',
                    'class' => Area::class,
                    'query_builder' => function ($repositorio) {
                        return $repositorio->createQueryBuilder('a')->orderBy('a.area', 'ASC');
                    }
                ))
                ->add('areaIdareadestino', EntityType::class, array(
                    'required' => true,
                    'label' => 'Área Destino',
                    'multiple' => false,
                    'choice_label' => 'Area',
                    'placeholder' => 'Todas',
                    'class' => Area::class,
                    'query_builder' => function ($repositorio) {
                        return $repositorio->createQueryBuilder('a')->orderBy('a.area', 'ASC');
                    }
                ))
                ->add('motivomovimiento', TextType::class, [
                    'label' => 'Motivo',
                    'required' => false,
                ])
                ->add('folios', IntegerType::class, [
                    'label' => 'Folios',
                    'required' => false,
                ])
                ->add('observacion', TextType::class, [
                    'label' => 'Observaciones',
                    'required' => false,
                ])
                ->add('tipomovimiento', ChoiceType::class, array('label' => 'Tipo Movimiento',
                    'choices' => array(
                        'Interno' => 'INTERNO',
                        'Externo' => 'EXTERNO'
                    ),
                    'required' => true,
                    'data' => 'INTERNO',
                        )
                )
                ->add('idestado', EntityType::class, array(
                    'required' => false,
                    'mapped' => false,
                    'label' => 'NUEVO ESTADO',
                    'choice_label' => 'estadodescripcion',
                    'placeholder' => 'Seleccione',
                    'class' => Estadoactoadministrativo::class,
                    'query_builder' => function ($e) {
                        return $e->createQueryBuilder('estado')
                                ->where('estado.idestado in (3,4,6,12)');
                    },
                ))
                ->add('buscarActo', ButtonType::class, ['label' => 'Buscar'])
                ->add('guardar_datos', SubmitType::class, ['label' => 'Guardar'])



        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Movimiento'
        ));
        $resolver->setRequired('em_instituciones');
        $resolver->setRequired('em');
    }

    public function getBlockPrefix() {
        return 'form';
    }

}
