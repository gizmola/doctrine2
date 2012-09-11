<?php


namespace Doctrine\ORM\Id;

use Doctrine\ORM\EntityManager;
use Qubeey\ApiBundle\Utility\QidRepository;

/**
 * /**
 * Qubeey QID Generator
 * Id generator that uses a single-row database table.  Hardwired to only work with MySQL.
 * 
 */
class QidGenerator extends AbstractIdGenerator
{
    public function generate(EntityManager $em, $entity)
    {
    	# TODO: Figure out how to reference this
    	$class = $em->getClassMetadata(get_class($entity));
    	$idField = $class->identifier[0];
    	$qid_table = $class->fieldMappings[$idField]['columnName'];
     	//$qem = EntityManager::create($conn, Configuration $config, EventManager $eventManager = null)    
    	$qconn = $em->getConnection();
    	$sql = 'UPDATE ' . $qid_table . ' SET lastid=LAST_INSERT_ID(lastid+1)';
    	//echo $sql;
    	if ($qconn->executeUpdate($sql)) {    		
    		$repo = QidRepository::GetRepositoryNumber($qconn->getHost());
    		$qid = $em->getConnection()->lastInsertId('lastid') * 100 + $repo;
    		return $qid;
    	} else {
    		// TODO: Throw exception
    	}
       
    }
}