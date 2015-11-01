<?php
namespace Tarefa\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Tarefa\Form\TarefaForm;
use Tarefa\Model\TarefaEntity;

class TarefaController extends AbstractActionController
{
    public function indexAction()
    {
	
	$mapper = $this->getTarefaMapper();
	
        return new ViewModel([
	    'tarefas' => $mapper->fetchAll()		
	]);
    }
    
    public function addAction()
    {
	$form   = new TarefaForm();
	$tarefa = new TarefaEntity();
	$form->bind($tarefa);
	
	$req = $this->getRequest();
	
	if ($req->isPost()) {
	    
	}
	
	return ['form' => $form];
    }
    
    public function editAction()
    {
	return [];
    }
    
    public function deleteAction()
    {
	return [];
    }
    
    public function getTarefaMapper()
    {
	return $this->getServiceLocator()->get('TarefaMapper');
    }
    
}
