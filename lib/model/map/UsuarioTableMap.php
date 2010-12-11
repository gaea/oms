<?php


/**
 * This class defines the structure of the 'usuario' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * sáb 11 dic 2010 12:03:14 COT
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class UsuarioTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.UsuarioTableMap';

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
		$this->setName('usuario');
		$this->setPhpName('Usuario');
		$this->setClassname('Usuario');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('usuario_codigo_seq');
		// columns
		$this->addPrimaryKey('CODIGO', 'Codigo', 'INTEGER', true, null, null);
		$this->addColumn('USUARIO', 'Usuario', 'VARCHAR', true, 200, null);
		$this->addColumn('CONTRASENA', 'Contrasena', 'VARCHAR', true, 200, null);
		$this->addForeignKey('PERFIL', 'Perfil', 'INTEGER', 'perfil', 'CODIGO', false, null, null);
		$this->addForeignKey('PERSONA', 'Persona', 'INTEGER', 'persona', 'CODIGO', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('PerfilRelatedByPerfil', 'Perfil', RelationMap::MANY_TO_ONE, array('perfil' => 'codigo', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('PersonaRelatedByPersona', 'Persona', RelationMap::MANY_TO_ONE, array('persona' => 'codigo', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('CuniaComercial', 'CuniaComercial', RelationMap::ONE_TO_MANY, array('codigo' => 'usuario', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('Mensaje', 'Mensaje', RelationMap::ONE_TO_MANY, array('codigo' => 'usuario', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('Venta', 'Venta', RelationMap::ONE_TO_MANY, array('codigo' => 'usuario', ), 'RESTRICT', 'RESTRICT');
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

} // UsuarioTableMap
