<?php


/**
 * This class defines the structure of the 'venta_cunia_comercial' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * mar 14 dic 2010 15:19:10 COT
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class VentaCuniaComercialTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.VentaCuniaComercialTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('venta_cunia_comercial');
		$this->setPhpName('VentaCuniaComercial');
		$this->setClassname('VentaCuniaComercial');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('VENTA', 'Venta', 'INTEGER' , 'venta', 'CODIGO', true, null, null);
		$this->addForeignPrimaryKey('CUNIA_COMERCIAL', 'CuniaComercial', 'INTEGER' , 'cunia_comercial', 'CODIGO', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('VentaRelatedByVenta', 'Venta', RelationMap::MANY_TO_ONE, array('venta' => 'codigo', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('CuniaComercialRelatedByCuniaComercial', 'CuniaComercial', RelationMap::MANY_TO_ONE, array('cunia_comercial' => 'codigo', ), 'RESTRICT', 'RESTRICT');
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // VentaCuniaComercialTableMap
