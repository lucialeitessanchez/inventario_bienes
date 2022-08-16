<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\EventListener;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;


/**
 * Description of MappingListener
 *
 * @author informatica
 */
class MappingListener 
{
    #private $container;
    private $tables_from_db;
    
    public function __construct($tables_from_db) {
        $this->tables_from_db = $tables_from_db;
    }
    /*public function setContainer($container) {
        $this->container=$container;
    }*/
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $classMetadata = $eventArgs->getClassMetadata();
        $table = $classMetadata->table;

        $tablename = (isset($table['schema'])?$table['schema'].'.'.$table['name']:$table['name']);

        if (array_key_exists($tablename,$this->tables_from_db)) {
            $table['schema'] = $this->tables_from_db[$tablename];
            $classMetadata->setPrimaryTable($table);
        }
        
        foreach ($classMetadata->getAssociationMappings() as $fieldName => $mapping) {
            
            if ($mapping['type'] == \Doctrine\ORM\Mapping\ClassMetadataInfo::MANY_TO_MANY 
                    && array_key_exists('name', $classMetadata->associationMappings[$fieldName]['joinTable']) ) {     // Check if "joinTable" exists, it can be null if this field is the reverse side of a ManyToMany relationship
                $mappedTableName = $classMetadata->associationMappings[$fieldName]['joinTable']['name'];
                
                if (array_key_exists($mappedTableName,$this->tables_from_db))
                    $classMetadata->associationMappings[$fieldName]['joinTable']['name'] = $this->getAbsoluteName($mappedTableName);
            }
        }
    }
    
    private function getAbsoluteName($name) {
        $aux = $name;
        if ($i = strpos($name,'.'))
            $aux = substr($name,$i);
        
        return $this->tables_from_db[$name].'.'.$aux;
    }
}
