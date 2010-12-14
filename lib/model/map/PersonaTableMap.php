<?php


/**
 * This class defines the structure of the 'persona' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Dec 13 22:23:09 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class PersonaTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.PersonaTableMap';

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
		$this->setName('persona');
		$this->setPhpName('Persona');
		$this->setClassname('Persona');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('persona_codigo_seq');
		// columns
		$this->addPrimaryKey('CODIGO', 'Codigo', 'INTEGER', true, null, null);
		$this->addColumn('NOMBRE', 'Nombre', 'VARCHAR', true, 200, null);
		$this->addColumn('APELLIDO', 'Apellido', 'VARCHAR', false, 200, null);
		$this->addColumn('IDENTIFICACION', 'Identificacion', 'VARCHAR', false, 200, null);
		$this->addForeignKey('TIPO_IDENTIFICACION', 'TipoIdentificacion', 'INTEGER', 'tipo_identificacion', 'CODIGO', false, null, null);
		$this->addColumn('DIRECCION', 'Direccion', 'VARCHAR', false, 200, null);
		$this->addColumn('TELEFONO', 'Telefono', 'VARCHAR', false, 200, null);
		$this->addColumn('E_MAIL', 'EMail', 'VARCHAR', false, 200, null);
		$this->addColumn('HABILITADO', 'Habilitado', 'BOOLEAN', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('TipoIdentificacionRelatedByTipoIdentificacion', 'TipoIdentificacion', RelationMap::MANY_TO_ONE, array('tipo_identificacion' => 'codigo', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('Usuario', 'Usuario', RelationMap::ONE_TO_MANY, array('codigo' => 'persona', ), 'RESTRICT', 'RESTRICT');
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

} // PersonaTableMap
