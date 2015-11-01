<?php
/**
 * @author Lucas Daniel Burg Mota <lucasburgmota@gmail.com>
 * @since 01/11/2015 16:16:38
 */
namespace Tarefa\Form;

use Zend\InputFilter\InputFilter;

class TarefaFilter extends InputFilter
{
    public function __construct()
    {
	$this->add([
	    'name' => 'id',
	    'required' => true,
	    'filters' => [
		['name' => 'Int']
	    ]
	]);
	
	$this->add([
	    'name' => 'title',
	    'required' => true,
	    'filters' => [
		['name' => 'StripTags'],
		['name' => 'StringTrim']
	    ],
	    'validators' => [
		[
		    'name'    => 'StringLength',
		    'options' => [
			'encoding' => 'UTF-8',
			'max'      => 100
		    ]
		]
	    ]
	]);
	
	$this->add([
	   'name'     => 'completed',
	   'required' => false
	]);
    }
    
}


