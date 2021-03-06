<?php


/**
 * This class defines the structure of the 'mensaje' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * mar 14 dic 2010 15:19:07 COT
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class MensajeTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.MensajeTableMap';

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
		$this->setName('mensaje');
		$this->setPhpName('Mensaje');
		$this->setClassname('Mensaje');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('mensaje_codigo_seq');
		// columns
		$this->addPrimaryKey('CODIGO', 'Codigo', 'INTEGER', true, null, null);
		$this->addForeignKey('USUARIO', 'Usuario', 'INTEGER', 'usuario', 'CODIGO', true, null, null);
		$this->addColumn('ASUNTO', 'Asunto', 'VARCHAR', false, 200, null);
		$this->addColumn('MENSAJE', 'Mensaje', 'LONGVARCHAR', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('UsuarioRelatedByUsuario', 'Usuario', RelationMap::MANY_TO_ONE, array('usuario' => 'codigo', ), 'RESTRICT', 'RESTRICT');
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

} // MensajeTableMap
