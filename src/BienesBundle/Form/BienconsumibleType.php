<?php

namespace BienesBundle\Form;

use BienesBundle\BienesBundle;
use BienesBundle\Entity\Proveedor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityManagerInterface;

use BienesBundle\Entity\Tipo;
//use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class BienconsumibleType extends AbstractType
{
    

    private $em;

      /**
     * El tipo requiere EntityManager como argumento en el constructor. Es autowired
     * en Symfony 3.
     * 
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('descripcion',TextType::class,
        ['label'=> 'Producto: '
        ])
        ->add('estado',IntegerType::class, 
        ['label'=>'Cantidad: '
        ])
        ->add('proveedor')->add(('responsable'))->add('ubicacion')->add('factura')->add('tipo')->add('rama');

    

        // Agregue 2 detectores de eventos para el formulario
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
        $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));

        $builder->add('motivoBaja',TextType::class,['required' => false])
                ->add('fechaBaja', DateType::class, [
                        'label' => 'Fecha de baja',
                        'widget' => 'single_text',
                        'html5' => true,'required' =>false
                    ]);    
        
    }
 
    protected function addElements(FormInterface $form, Tipo $tipo = null,Proveedor $proveedor = null) {
        // 4. Agregar el elemento de rama
        $form->add('tipo', EntityType::class, array(
            'required' => true,
            'data' => $tipo,
            'placeholder' => 'Seleccionar Tipo',
            'class' => 'BienesBundle:Tipo'
        ));
        
        // ramas vacías, a menos que haya un tipo seleccionado (Editar vista)
        $ramas = array();
        
        // Si hay un tipo almacenada en la entidad Bien, cargue las ramas de la misma
        if ($tipo) {
            // Obtener ramas del tipo si hay un tipo seleccionada
            $repoRama = $this->em->getRepository('BienesBundle:Rama');
            
            $ramas = $repoRama->createQueryBuilder("q")
                ->where("q.tipo = :tipoid")
                ->setParameter("tipoid", $tipo->getId())
                ->getQuery()
                ->getResult();
        }
        
        // Agregue el campo rama con los datos adecuados
        $form->add('rama', EntityType::class, array(
            'required' => true,
            'placeholder' => 'Seleccione tipo primero ...',
            'class' => 'BienesBundle:Rama',
            'choices' => $ramas
        ));
   
        //logica de proveedor y factura
        $form->add('proveedor', EntityType::class, array(
            'required' => true,
            'data' => $proveedor,
            'placeholder' => 'Seleccionar Proveedor',
            'class' => 'BienesBundle:Proveedor'
        ));
        
        $facturas = array();

        if ($proveedor) {
            // Obtener ramas del tipo si hay un tipo seleccionada
            $repoFactura = $this->em->getRepository('BienesBundle:Factura');
            
            $facturas = $repoFactura->createQueryBuilder("q")
                ->where("q.proveedor = :proveedorid")
                ->setParameter("proveedorid", $proveedor->getId())
                ->getQuery()
                ->getResult();
        }
        
        // Agregue el campo rama con los datos adecuados
        $form->add('factura', EntityType::class, array(
            'required' => true,
            'placeholder' => 'Seleccione proveedor primero ...',
            'class' => 'BienesBundle:Factura',
            'choices' => $facturas
        ));
   
    }

    function onPreSubmit(FormEvent $event) {
        $form = $event->getForm();
        $data = $event->getData();
        
        // Busque la ciudad seleccionada y conviértala en una entidad
        $city = $this->em->getRepository('BienesBundle:Tipo')->find($data['tipo']);
        
       

        $prov = $this->em->getRepository('BienesBundle:Proveedor')->find($data['proveedor']);
        
        $this->addElements($form, $city, $prov);
    }

    function onPreSetData(FormEvent $event) {
        $bien = $event->getData();
        $form = $event->getForm();

        // Cuando creas una nueva persona, la ciudad siempre está vacía
        $tipo = $bien->getTipo() ? $bien->getTipo() : null;
        $proveedor = $bien->getProveedor() ? $bien->getProveedor() : null;
        $this->addElements($form, $tipo, $proveedor);
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
