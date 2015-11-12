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
	    $form->setData($req->getPost());
	    if ($form->isValid()) {
		$this->getTarefaMapper()->save($tarefa);
		return $this->redirect()->toRoute('tarefa');
	    }
	}
	
	return ['form' => $form];
    }
    
    public function editAction()
    {
	$id = (int) $this->params('id');
	
	if (!$id) {
	    return $this->redirect()->toRoute('tarefa', ['action' => 'add']);
	}
	
	$tarefa = $this->getTarefaMapper()->getTarefa($id);
	
	$form = new TarefaForm();
	$form->bind($tarefa);
	
	$req = $this->getRequest();
	
	if ($req->isPost()) {
	    $form->setData($req->getPost());
	    
	    if ($form->isValid()) {
		$this->getTarefaMapper()->save($tarefa);
		return $this->redirect()->toRoute('tarefa');
	    }
	}
	
	return ['id' => $id, 'form' => $form];
    }
    
    public function deleteAction()
    {
	$id = (int) $this->params('id');
	
	if (!$id) {
	    return $this->redirect()->toRoute('tarefa');
	}
	
	$tarefa = $this->getTarefaMapper()->getTarefa($id);
	
	if (!$tarefa) {
	    return $this->redirect()->toRoute('tarefa');
	}
	
	$req = $this->getRequest();
	
	if ($req->isPost()) {
	    if ($req->getPost()->get('del') == 'Yes') {
		$this->getTarefaMapper()->delete($id);
	    }
	    
	    return $this->redirect()->toRoute('tarefa');
	}
	
	
	return ['id' => $id, 'tarefa' => $tarefa];
    }
    
    public function getTarefaMapper()
    {
	return $this->getServiceLocator()->get('TarefaMapper');
    }
    
}
