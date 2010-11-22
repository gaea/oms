<?php


/**
 * This class defines the structure of the 'tipo_identificacion' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Nov 22 16:46:13 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class TipoIdentificacionTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.TipoIdentificacionTableMap';

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
		$this->setName('tipo_identificacion');
		$this->setPhpName('TipoIdentificacion');
		$this->setClassname('TipoIdentificacion');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('tipo_identificacion_codigo_seq');
		// columns
		$this->addPrimaryKey('CODIGO', 'Codigo', 'INTEGER', true, null, null);
		$this->addColumn('NOMBRE', 'Nombre', 'VARCHAR', false, 200, null);
		$this->addColumn('DESCRIPCION', 'Descripcion', 'VARCHAR', false, 200, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Persona', 'Persona', RelationMap::ONE_TO_MANY, array('codigo' => 'tipo_identificacion', ), 'RESTRICT', 'RESTRICT');
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

} // TipoIdentificacionTableMap