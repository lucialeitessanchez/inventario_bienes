<?php
 
namespace Web\BlogBundle\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
 
class RegistroType extends AbstractType {
 
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', 'text', array("label" => "Nombre: ",
                    "required" => false,
                    "attr" => array('class' => 'form-control')))
                 
                ->add('surname', 'text', array("label" => "Apellido: ",
                    "required" => false,
                    "attr" => array('class' => 'form-control')))
                 
                ->add('email', 'email', array("label" => "Correo electronico: ",
                    "required" => false,
                    "attr" => array('class' => 'form-control')))
                 
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'Las contraseñas no son iguales, repitelo',
                    'required' => true,
                    'first_options' => array('label' => 'Contraseña: ',"attr" => array('class' => 'form-control')),
                    'second_options' => array('label' => 'Repetir contraseña: ',"attr" => array('class' => 'form-control'))))
                 
                ->add('Registrarse', 'submit',array("attr" => array('class' => 'btn btn-success')));
    }
 
    public function getName() {
        return 'Registro';
    }
 
}
 
?>
