<?php
/**
 * @author Lucas Daniel Burg Mota <lucasburgmota@gmail.com>
 * @since 01/11/2015 15:15:47
 */
namespace Tarefa\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
use Tarefa\Model\TarefaEntity;

class TarefaMapper 
{
    protected $tableName = 'item';
    protected $adapter;
    protected $sql;
    
    public function __construct(Adapter $adapter)
    {
	$this->adapter = $adapter;
	$this->sql = new Sql($adapter);
	$this->sql->setTable($this->tableName);
    }
    
    public function fetchAll()
    {
	$select = $this->sql->select();
	$select->order(['completed ASC', 'created ASC']);
	
	$stmt = $this->sql->prepareStatementForSqlObject($select);
	$results = $stmt->execute();
	
	$tarefaEntity = new TarefaEntity();
	$classMethods = new ClassMethods();
	$resultset    = new HydratingResultSet($classMethods, $tarefaEntity);
	$resultset->initialize($results);
	//sleep(5);
	return $resultset;
    }
    
    public function save(TarefaEntity $tarefa)
    {
	$classMethods = new ClassMethods();
	$data = $classMethods->extract($tarefa);
	
	if ($tarefa->getId()) {
	    $action = $this->sql->update();
	    $action->set($data);
	    $action->where(['id' => $tarefa->getId()]);
	} else {
	    $action = $this->sql->insert();
	    unset($data['id']);
	    $action->values($data);
	}
	
	$stmt = $this->sql->prepareStatementForSqlObject($action);
	$result = $stmt->execute();
	
	if (!$tarefa->getId()) {
	    $tarefa->setId($result->getGeneratedValue());
	}
	
	return $result;
	
    }
    
    public function getTarefa($id)
    {
	$select = $this->sql->select();
	$select->where(['id' => $id]);
	
	$stmt = $this->sql->prepareStatementForSqlObject($select);
	
	$result = $stmt->execute()->current();
	
	if (!$result) {
	    return false;
	}
	
	$classMethods = new ClassMethods();
	$tarefaEntity = new TarefaEntity();
	
	$classMethods->hydrate($result, $tarefaEntity);
	
	return $tarefaEntity;
	
    }
    
    public function delete($id) 
    {
	$delete = $this->sql->delete();
	$delete->where(['id' => $id]);
	
	$stmt = $this->sql->prepareStatementForSqlObject($delete);
	return $stmt->execute();
    }
}


