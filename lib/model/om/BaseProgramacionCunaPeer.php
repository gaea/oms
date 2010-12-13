<?php

/**
 * Base static class for performing query and update operations on the 'programacion_cuna' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Dec 13 14:51:57 2010
 *
 * @package    lib.model.om
 */
abstract class BaseProgramacionCunaPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'programacion_cuna';

	/** the related Propel class for this table */
	const OM_CLASS = 'ProgramacionCuna';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.ProgramacionCuna';

	/** the related TableMap class for this table */
	const TM_CLASS = 'ProgramacionCunaTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 5;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the VENTA field */
	const VENTA = 'programacion_cuna.VENTA';

	/** the column name for the CUNIA_COMERCIAL field */
	const CUNIA_COMERCIAL = 'programacion_cuna.CUNIA_COMERCIAL';

	/** the column name for the FECHA field */
	const FECHA = 'programacion_cuna.FECHA';

	/** the column name for the INICIO field */
	const INICIO = 'programacion_cuna.INICIO';

	/** the column name for the FIN field */
	const FIN = 'programacion_cuna.FIN';

	/**
	 * An identiy map to hold any loaded instances of ProgramacionCuna objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array ProgramacionCuna[]
	 */
	public static $instances = array();


	// symfony behavior
	
	/**
	 * Indicates whether the current model includes I18N.
	 */
	const IS_I18N = false;

	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Venta', 'CuniaComercial', 'Fecha', 'Inicio', 'Fin', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('venta', 'cuniaComercial', 'fecha', 'inicio', 'fin', ),
		BasePeer::TYPE_COLNAME => array (self::VENTA, self::CUNIA_COMERCIAL, self::FECHA, self::INICIO, self::FIN, ),
		BasePeer::TYPE_FIELDNAME => array ('venta', 'cunia_comercial', 'fecha', 'inicio', 'fin', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Venta' => 0, 'CuniaComercial' => 1, 'Fecha' => 2, 'Inicio' => 3, 'Fin' => 4, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('venta' => 0, 'cuniaComercial' => 1, 'fecha' => 2, 'inicio' => 3, 'fin' => 4, ),
		BasePeer::TYPE_COLNAME => array (self::VENTA => 0, self::CUNIA_COMERCIAL => 1, self::FECHA => 2, self::INICIO => 3, self::FIN => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('venta' => 0, 'cunia_comercial' => 1, 'fecha' => 2, 'inicio' => 3, 'fin' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. ProgramacionCunaPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(ProgramacionCunaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{
		$criteria->addSelectColumn(ProgramacionCunaPeer::VENTA);
		$criteria->addSelectColumn(ProgramacionCunaPeer::CUNIA_COMERCIAL);
		$criteria->addSelectColumn(ProgramacionCunaPeer::FECHA);
		$criteria->addSelectColumn(ProgramacionCunaPeer::INICIO);
		$criteria->addSelectColumn(ProgramacionCunaPeer::FIN);
	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ProgramacionCunaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ProgramacionCunaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(ProgramacionCunaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		// symfony_behaviors behavior
		foreach (sfMixer::getCallables(self::getMixerPreSelectHook(__FUNCTION__)) as $sf_hook)
		{
		  call_user_func($sf_hook, 'BaseProgramacionCunaPeer', $criteria, $con);
		}

		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     ProgramacionCuna
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ProgramacionCunaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return ProgramacionCunaPeer::populateObjects(ProgramacionCunaPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ProgramacionCunaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			ProgramacionCunaPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);
		// symfony_behaviors behavior
		foreach (sfMixer::getCallables(self::getMixerPreSelectHook(__FUNCTION__)) as $sf_hook)
		{
		  call_user_func($sf_hook, 'BaseProgramacionCunaPeer', $criteria, $con);
		}


		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      ProgramacionCuna $value A ProgramacionCuna object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(ProgramacionCuna $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getVenta(), (string) $obj->getCuniaComercial(), (string) $obj->getFecha(), (string) $obj->getInicio(), (string) $obj->getFin()));
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A ProgramacionCuna object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof ProgramacionCuna) {
				$key = serialize(array((string) $value->getVenta(), (string) $value->getCuniaComercial(), (string) $value->getFecha(), (string) $value->getInicio(), (string) $value->getFin()));
			} elseif (is_array($value) && count($value) === 5) {
				// assume we've been passed a primary key
				$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2], (string) $value[3], (string) $value[4]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or ProgramacionCuna object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     ProgramacionCuna Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Method to invalidate the instance pool of all tables related to programacion_cuna
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
	}

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol] === null && $row[$startcol + 1] === null && $row[$startcol + 2] === null && $row[$startcol + 3] === null && $row[$startcol + 4] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol], (string) $row[$startcol + 1], (string) $row[$startcol + 2], (string) $row[$startcol + 3], (string) $row[$startcol + 4]));
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = ProgramacionCunaPeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = ProgramacionCunaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = ProgramacionCunaPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				ProgramacionCunaPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}
	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * Add a TableMap instance to the database for this peer class.
	 */
	public static function buildTableMap()
	{
	  $dbMap = Propel::getDatabaseMap(BaseProgramacionCunaPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseProgramacionCunaPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new ProgramacionCunaTableMap());
	  }
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * If $withPrefix is true, the returned path
	 * uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @param      boolean  Whether or not to return the path wit hthe class name 
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? ProgramacionCunaPeer::CLASS_DEFAULT : ProgramacionCunaPeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a ProgramacionCuna or Criteria object.
	 *
	 * @param      mixed $values Criteria or ProgramacionCuna object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseProgramacionCunaPeer:doInsert:pre') as $sf_hook)
    {
      if (false !== $sf_hook_retval = call_user_func($sf_hook, 'BaseProgramacionCunaPeer', $values, $con))
      {
        return $sf_hook_retval;
      }
    }

		if ($con === null) {
			$con = Propel::getConnection(ProgramacionCunaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from ProgramacionCuna object
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseProgramacionCunaPeer:doInsert:post') as $sf_hook)
    {
      call_user_func($sf_hook, 'BaseProgramacionCunaPeer', $values, $con, $pk);
    }

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a ProgramacionCuna or Criteria object.
	 *
	 * @param      mixed $values Criteria or ProgramacionCuna object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseProgramacionCunaPeer:doUpdate:pre') as $sf_hook)
    {
      if (false !== $sf_hook_retval = call_user_func($sf_hook, 'BaseProgramacionCunaPeer', $values, $con))
      {
        return $sf_hook_retval;
      }
    }

		if ($con === null) {
			$con = Propel::getConnection(ProgramacionCunaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(ProgramacionCunaPeer::VENTA);
			$selectCriteria->add(ProgramacionCunaPeer::VENTA, $criteria->remove(ProgramacionCunaPeer::VENTA), $comparison);

			$comparison = $criteria->getComparison(ProgramacionCunaPeer::CUNIA_COMERCIAL);
			$selectCriteria->add(ProgramacionCunaPeer::CUNIA_COMERCIAL, $criteria->remove(ProgramacionCunaPeer::CUNIA_COMERCIAL), $comparison);

			$comparison = $criteria->getComparison(ProgramacionCunaPeer::FECHA);
			$selectCriteria->add(ProgramacionCunaPeer::FECHA, $criteria->remove(ProgramacionCunaPeer::FECHA), $comparison);

			$comparison = $criteria->getComparison(ProgramacionCunaPeer::INICIO);
			$selectCriteria->add(ProgramacionCunaPeer::INICIO, $criteria->remove(ProgramacionCunaPeer::INICIO), $comparison);

			$comparison = $criteria->getComparison(ProgramacionCunaPeer::FIN);
			$selectCriteria->add(ProgramacionCunaPeer::FIN, $criteria->remove(ProgramacionCunaPeer::FIN), $comparison);

		} else { // $values is ProgramacionCuna object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);

    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseProgramacionCunaPeer:doUpdate:post') as $sf_hook)
    {
      call_user_func($sf_hook, 'BaseProgramacionCunaPeer', $values, $con, $ret);
    }

    return $ret;
	}

	/**
	 * Method to DELETE all rows from the programacion_cuna table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ProgramacionCunaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(ProgramacionCunaPeer::TABLE_NAME, $con);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			ProgramacionCunaPeer::clearInstancePool();
			ProgramacionCunaPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a ProgramacionCuna or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or ProgramacionCuna object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(ProgramacionCunaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			ProgramacionCunaPeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof ProgramacionCuna) { // it's a model object
			// invalidate the cache for this single object
			ProgramacionCunaPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			// primary key is composite; we therefore, expect
			// the primary key passed to be an array of pkey values
			if (count($values) == count($values, COUNT_RECURSIVE)) {
				// array is not multi-dimensional
				$values = array($values);
			}
			foreach ($values as $value) {
				$criterion = $criteria->getNewCriterion(ProgramacionCunaPeer::VENTA, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(ProgramacionCunaPeer::CUNIA_COMERCIAL, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(ProgramacionCunaPeer::FECHA, $value[2]));
				$criterion->addAnd($criteria->getNewCriterion(ProgramacionCunaPeer::INICIO, $value[3]));
				$criterion->addAnd($criteria->getNewCriterion(ProgramacionCunaPeer::FIN, $value[4]));
				$criteria->addOr($criterion);
				// we can invalidate the cache for this single PK
				ProgramacionCunaPeer::removeInstanceFromPool($value);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			ProgramacionCunaPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given ProgramacionCuna object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      ProgramacionCuna $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(ProgramacionCuna $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ProgramacionCunaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ProgramacionCunaPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(ProgramacionCunaPeer::DATABASE_NAME, ProgramacionCunaPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param      int $venta
	 * @param      int $cunia_comercial
	 * @param      string $fecha
	 * @param      string $inicio
	 * @param      string $fin
	 * @param      PropelPDO $con
	 * @return     ProgramacionCuna
	 */
	public static function retrieveByPK($venta, $cunia_comercial, $fecha, $inicio, $fin, PropelPDO $con = null) {
		$key = serialize(array((string) $venta, (string) $cunia_comercial, (string) $fecha, (string) $inicio, (string) $fin));
 		if (null !== ($obj = ProgramacionCunaPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(ProgramacionCunaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(ProgramacionCunaPeer::DATABASE_NAME);
		$criteria->add(ProgramacionCunaPeer::VENTA, $venta);
		$criteria->add(ProgramacionCunaPeer::CUNIA_COMERCIAL, $cunia_comercial);
		$criteria->add(ProgramacionCunaPeer::FECHA, $fecha);
		$criteria->add(ProgramacionCunaPeer::INICIO, $inicio);
		$criteria->add(ProgramacionCunaPeer::FIN, $fin);
		$v = ProgramacionCunaPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
	// symfony behavior
	
	/**
	 * Returns an array of arrays that contain columns in each unique index.
	 *
	 * @return array
	 */
	static public function getUniqueColumnNames()
	{
	  return array();
	}

	// symfony_behaviors behavior
	
	/**
	 * Returns the name of the hook to call from inside the supplied method.
	 *
	 * @param string $method The calling method
	 *
	 * @return string A hook name for {@link sfMixer}
	 *
	 * @throws LogicException If the method name is not recognized
	 */
	static private function getMixerPreSelectHook($method)
	{
	  if (preg_match('/^do(Select|Count)(Join(All(Except)?)?|Stmt)?/', $method, $match))
	  {
	    return sprintf('BaseProgramacionCunaPeer:%s:%1$s', 'Count' == $match[1] ? 'doCount' : $match[0]);
	  }
	
	  throw new LogicException(sprintf('Unrecognized function "%s"', $method));
	}

} // BaseProgramacionCunaPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseProgramacionCunaPeer::buildTableMap();

