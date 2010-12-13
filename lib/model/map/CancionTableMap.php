<?php


/**
 * This class defines the structure of the 'cancion' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Dec 13 14:51:56 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class CancionTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.CancionTableMap';

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
		$this->setName('cancion');
		$this->setPhpName('Cancion');
		$this->setClassname('Cancion');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('cancion_codigo_seq');
		// columns
		$this->addPrimaryKey('CODIGO', 'Codigo', 'INTEGER', true, null, null);
		$this->addColumn('NOMBRE', 'Nombre', 'VARCHAR', false, 200, null);
		$this->addColumn('AUTOR', 'Autor', 'VARCHAR', false, 200, null);
		$this->addColumn('ALBUM', 'Album', 'VARCHAR', false, 200, null);
		$this->addColumn('FECHA_DE_PUBLICACION', 'FechaDePublicacion', 'DATE', false, null, null);
		$this->addColumn('DURACION', 'Duracion', 'TIME', false, null, null);
		$this->addColumn('URL', 'Url', 'VARCHAR', false, 200, null);
		$this->addColumn('HABILITADA', 'Habilitada', 'BOOLEAN', false, null, null);
		$this->addColumn('PRECIO', 'Precio', 'NUMERIC', false, null, null);
		$this->addColumn('RANKING', 'Ranking', 'INTEGER', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('ProgramacionCancion', 'ProgramacionCancion', RelationMap::ONE_TO_MANY, array('codigo' => 'cancion', ), null, null);
    $this->addRelation('VentaCancion', 'VentaCancion', RelationMap::ONE_TO_MANY, array('codigo' => 'cancion', ), 'RESTRICT', 'RESTRICT');
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

} // CancionTableMap
