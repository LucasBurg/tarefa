<?php
/**
 * @author Lucas Mota
 * @since 30/10/2015
 */

namespace Tarefa;

return [
    'view_manager' => [
	'display_not_found_reason' => true,
	'display_exceptions'       => true,
	'doctype'                  => 'HTML5',
	'not_found_template'       => 'error/404',
	'exception_template'       => 'error/index',
	'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'tarefa/index/index'      => __DIR__ . '/../view/tarefa/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
	'template_path_stack' => [
	    'tarefa' => __DIR__ . '/../view'
	]
    ],
    'controllers' => [
        'invokables' => [
            'Tarefa\Controller\Tarefa' => 'Tarefa\Controller\TarefaController',
	    'Tarefa\Controller\Index'  => 'Tarefa\Controller\IndexController',
        ]
    ],
    'router' => [
	'routes' => [
	    'home' => [
                'type' => 'Literal',
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => 'Tarefa\Controller\Index',
                        'action'     => 'index',
                    ]
                ]
            ],
	    'tarefa' => [
		'type'    => 'Segment',
		'options' => [
		    'route'    => '/tarefa[/:action[/:id]]',
		    'defaults' => [
			'controller' => 'Tarefa\Controller\Tarefa',
			'action'     => 'index'
		    ],
		    'constraints' => [
			'action' => '(add|edit|delete)',
			'id'     => '[0-9]+'
		    ]
		]
	    ]
	]
    ],
    'service_manager' => array(
	'factories' => array(
	    'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory'
	)
    ),
    'navigation' => array(
	'default' => array(
	    array(
		'label' => 'Home',
		'route' => 'home',
	    ),
	    array(
		'label' => 'Tarefa',
		'route' => 'tarefa',
		'pages' => array(
		    array(
			'label' => 'Add',
			'route' => 'tarefa',
			'action' => 'add',
		    ),
		    array(
			'label' => 'Edit',
			'route' => 'tarefa',
			'action' => 'edit',
		    ),
		    array(
			'label' => 'Delete',
			'route' => 'tarefa',
			'action' => 'delete',
		    )
		)
	    )
	)
    )
];
   