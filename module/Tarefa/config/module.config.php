<?php
/**
 * @author Lucas Mota
 * @since 30/10/2015
 */

namespace Tarefa;

return [
    'controllers' => [
        'invokables' => [
            'Tarefa\Controller\Tarefa' => 'Tarefa\Controller\TarefaController',
        ]
    ],
    'view_manager' => [
	'template_path_stack' => [
	    'tarefa' => __DIR__ . '/../view'
	]
    ],
    'router' => [
	'router' => [
	    'tarefa' => [
		'type'    => 'literal',
		'options' => [
		    'route'    => '/tarefa',
		    'defaults' => [
			'controller' => 'Tarefa\Controller\Tarefa',
			'action'     => 'index'
		    ]
		]
	    ]
	]
    ]
];
   