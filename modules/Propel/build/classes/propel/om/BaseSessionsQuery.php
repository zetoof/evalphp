<?php


/**
 * Base class that represents a query for the 'sessions' table.
 *
 *
 *
 * @method SessionsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method SessionsQuery orderByNom($order = Criteria::ASC) Order by the nom column
 * @method SessionsQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method SessionsQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method SessionsQuery orderByFormation($order = Criteria::ASC) Order by the formation column
 *
 * @method SessionsQuery groupById() Group by the id column
 * @method SessionsQuery groupByNom() Group by the nom column
 * @method SessionsQuery groupByDescription() Group by the description column
 * @method SessionsQuery groupByDate() Group by the date column
 * @method SessionsQuery groupByFormation() Group by the formation column
 *
 * @method SessionsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SessionsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SessionsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SessionsQuery leftJoinFormations($relationAlias = null) Adds a LEFT JOIN clause to the query using the Formations relation
 * @method SessionsQuery rightJoinFormations($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Formations relation
 * @method SessionsQuery innerJoinFormations($relationAlias = null) Adds a INNER JOIN clause to the query using the Formations relation
 *
 * @method Sessions findOne(PropelPDO $con = null) Return the first Sessions matching the query
 * @method Sessions findOneOrCreate(PropelPDO $con = null) Return the first Sessions matching the query, or a new Sessions object populated from the query conditions when no match is found
 *
 * @method Sessions findOneByNom(string $nom) Return the first Sessions filtered by the nom column
 * @method Sessions findOneByDescription(string $description) Return the first Sessions filtered by the description column
 * @method Sessions findOneByDate(string $date) Return the first Sessions filtered by the date column
 * @method Sessions findOneByFormation(int $formation) Return the first Sessions filtered by the formation column
 *
 * @method array findById(int $id) Return Sessions objects filtered by the id column
 * @method array findByNom(string $nom) Return Sessions objects filtered by the nom column
 * @method array findByDescription(string $description) Return Sessions objects filtered by the description column
 * @method array findByDate(string $date) Return Sessions objects filtered by the date column
 * @method array findByFormation(int $formation) Return Sessions objects filtered by the formation column
 *
 * @package    propel.generator.propel.om
 */
abstract class BaseSessionsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSessionsQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'propel';
        }
        if (null === $modelName) {
            $modelName = 'Sessions';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SessionsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   SessionsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SessionsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SessionsQuery) {
            return $criteria;
        }
        $query = new SessionsQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Sessions|Sessions[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SessionsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SessionsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Sessions A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Sessions A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `nom`, `description`, `date`, `formation` FROM `sessions` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Sessions();
            $obj->hydrate($row);
            SessionsPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Sessions|Sessions[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Sessions[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return SessionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SessionsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SessionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SessionsPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SessionsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SessionsPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SessionsPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionsPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the nom column
     *
     * Example usage:
     * <code>
     * $query->filterByNom('fooValue');   // WHERE nom = 'fooValue'
     * $query->filterByNom('%fooValue%'); // WHERE nom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nom The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SessionsQuery The current query, for fluid interface
     */
    public function filterByNom($nom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nom)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nom)) {
                $nom = str_replace('*', '%', $nom);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SessionsPeer::NOM, $nom, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SessionsQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SessionsPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE date < '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SessionsQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(SessionsPeer::DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(SessionsPeer::DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionsPeer::DATE, $date, $comparison);
    }

    /**
     * Filter the query on the formation column
     *
     * Example usage:
     * <code>
     * $query->filterByFormation(1234); // WHERE formation = 1234
     * $query->filterByFormation(array(12, 34)); // WHERE formation IN (12, 34)
     * $query->filterByFormation(array('min' => 12)); // WHERE formation >= 12
     * $query->filterByFormation(array('max' => 12)); // WHERE formation <= 12
     * </code>
     *
     * @see       filterByFormations()
     *
     * @param     mixed $formation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SessionsQuery The current query, for fluid interface
     */
    public function filterByFormation($formation = null, $comparison = null)
    {
        if (is_array($formation)) {
            $useMinMax = false;
            if (isset($formation['min'])) {
                $this->addUsingAlias(SessionsPeer::FORMATION, $formation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($formation['max'])) {
                $this->addUsingAlias(SessionsPeer::FORMATION, $formation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionsPeer::FORMATION, $formation, $comparison);
    }

    /**
     * Filter the query by a related Formations object
     *
     * @param   Formations|PropelObjectCollection $formations The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SessionsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByFormations($formations, $comparison = null)
    {
        if ($formations instanceof Formations) {
            return $this
                ->addUsingAlias(SessionsPeer::FORMATION, $formations->getId(), $comparison);
        } elseif ($formations instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SessionsPeer::FORMATION, $formations->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByFormations() only accepts arguments of type Formations or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Formations relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SessionsQuery The current query, for fluid interface
     */
    public function joinFormations($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Formations');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Formations');
        }

        return $this;
    }

    /**
     * Use the Formations relation Formations object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   FormationsQuery A secondary query class using the current class as primary query
     */
    public function useFormationsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFormations($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Formations', 'FormationsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Sessions $sessions Object to remove from the list of results
     *
     * @return SessionsQuery The current query, for fluid interface
     */
    public function prune($sessions = null)
    {
        if ($sessions) {
            $this->addUsingAlias(SessionsPeer::ID, $sessions->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
