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
	
	return $resultset;
    }
}


