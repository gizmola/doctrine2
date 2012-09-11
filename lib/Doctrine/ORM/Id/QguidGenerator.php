<?php 
namespace Doctrine\ORM\Id;

use Doctrine\ORM\EntityManager;
use Qubeey\ApiBundle\Utility\Qguid;

class QguidGenerator extends AbstractIdGenerator
{
	public function generate(EntityManager $em, $entity)
	{
		return Qguid::get();
	}
	
	public function isPostInsertGenerator()
	{
		return false;
	}
}