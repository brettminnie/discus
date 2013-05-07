<?php

namespace BDB\Framework\Core;

use BDB\Framework\Interfaces\Storable;
use BDB\Framework\Core\CoreException;
use Classes\Bootstrap;

/**
 * @todo Make this an array object
 * */
abstract class ADBO implements Storable {

     /**
      *
      * @var string
      */
    protected $_tableName;

    /**
     *
     * @var array
     */
    protected $_arFields;

    /**
     *
     * @var string
     */
    protected $_primaryKey;


    /**
     *
     * @var string
     */
    protected $_aliasName;


    /**
     *
     * @var array`
     */
    protected $_constraints;

    /**
     *
     * @var array
     */
    protected $_joins;

    /**
     * Constructor
     * @param string $tableName
     */
    public function __construct($TableName, $AliasName = NULL) {
        $this->_tableName = $TableName;
        $this->_primaryKey = $TableName . '_id';

        $this->CreateFields ();

        if(!$AliasName) {
            $this->_aliasName = str_replace(array('a','e','i','o','u','y','_','-'), '', $TableName);
        }
        else {
            $this->_aliasName = $AliasName;
        }

        $this->_constraints = array();
        $this->_joins = array();
    }

    /**
     * Method to generate a the fields for the table
     */
    protected function CreateFields() {
        $dbConnection = Bootstrap::Get ()->GetDbInstance ();

        $query = $dbConnection->prepare ( "DESCRIBE {$this->_tableName}" );
        try {
            if ($query->execute ()) {
                $tableFields = $query->fetchAll ( \PDO::FETCH_COLUMN );
                foreach ( $tableFields as $key => $val ) {
                    $this->_arFields [] = $val;
                }
            } else {
                var_dump ( $dbConnection->errorInfo () );
            }
        } catch ( \Exception $e ) {
            echo $e->getMessage ();
        }
    }


    public function __call($MethodName, $Arguments) {

        $MethodName =  strtolower(preg_replace('/([a-z]|[0-9])([A-Z])/', '$1_$2', trim($MethodName)));
        $Method = substr($MethodName, 0,3);
        $Field  = substr($MethodName, 4);

        if(FALSE == in_array($strMethod, array('get','set'))) {
            throw new CoreException(_("Method {$Method} is not supported."));
        }

        switch($strMethod) {
            case 'get' :
                if(FALSE === in_array($Field, $this->_arFields)) {
                    throw new CoreException(_("Field {$Field} not found."));
                }
                return $this->_arFields[$Field];
                break;
            case 'set' :
                $strValue = '';

                if(is_array($Arguments)) {
                    $Value = $Arguments[0];
                }

                if(FALSE === in_array($Field, $this->_arFields)) {
                    throw new CoreException(_("Field {$strField} not found"));
                }

                $this->_arFields[$Field] = $Value;
                return $this;
                break;
            default:
                throw new CoreException(_("Method {$strMethod} is not supported in __call."));
                break;
        }
    }

    public static function __callstatic($functionName, $params) {
    }

    /**
     * @param string $dirtyString
     * @return string
     */
    public static function Clean($dirtyString) {
        return Bootstrap::Get ()->GetDbInstance ()->quote ( $dirtyString );
    }

    /**
     * @return string
     */
    public function OrderByPrimaryKey() {
        return "ORDER BY {$this->_aliasName}.{$this->_primaryKey}";
    }

    /**
     * (non-PHPdoc)
     * @see \BDB\Framework\Interfaces\Storable::GetBaseQuery()
     * @return string
     */
    public function GetBaseQuery() {
        $strParams = "";
        foreach($this->_arFields as $Field) {
            $strParams.= "{$this->_aliasName}.{$Field}, ";
        }
        $strParams = substr(trim($strParams),0,strlen(trim($strParams))-1);
        return "SELECT {$strParams} FROM {$this->_tableName} {$this->_aliasName}";
    }

    public function SelectByID($ID) {
        $Query = $this->GetBaseQuery() .
            " WHERE {$this->_aliasName}.{$this->_primaryKey} = " . $this->Clean($ID);
    }

    public function Store() {
    }

    public function AddConstraint()
    {
    }

    public function AddJoin()
    {
    }

}

