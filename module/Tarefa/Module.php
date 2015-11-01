<?php
/**
 * @author Lucas Mota
 */

namespace Tarefa;

use Tarefa\Model\TarefaMapper;

class Module
{
    public function getServiceConfig() 
    {
	return [
	    'factories' => [
		'TarefaMapper' => function ($sm) {
		    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
		    return new TarefaMapper($adapter);
		}
	    ]
	];
    }
    
    
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
