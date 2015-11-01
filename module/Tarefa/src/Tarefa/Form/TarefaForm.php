<?php
/**
 * @author Lucas Daniel Burg Mota <lucasburgmota@gmail.com>
 * @since 01/11/2015 16:05:13
 */
namespace Tarefa\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use Tarefa\Form\TarefaFilter;

class TarefaForm extends Form
{
    public function __construct($name = null, $options = [])
    {
	parent::__construct('tarefa');
	
	$this->setAttribute('method', 'post');
	
	$this->setInputFilter(new TarefaFilter());
	$this->setHydrator(new ClassMethods());
	
	$this->add([
	    'name' => 'id',
	    'type' => 'hidden'
	]);
	
	$this->add([
	    'name' => 'title',
	    'type' => 'text',
	    'options' => [
		'label' => 'Title'
	    ],
	    'attributes' => [
		'id'        => 'title',
		'maxlength' => 100
	    ]
	]);
	
	$this->add([
	    'name' => 'completed',
	    'type' => 'checkbox',
	    'options' => [
		'label' => 'Completed?',
		'label_attributes' => ['class' => 'checkbox']
	    ] 
	]);
	
	$this->add([
	    'name' => 'submit',
	    'attributes' => [
		'type' => 'submit',
		'value' => 'Go',
		'class' => 'btn btn-primary'
	    ]
	]);
    }
}


