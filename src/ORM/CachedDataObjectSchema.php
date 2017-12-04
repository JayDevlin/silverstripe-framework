<?php

namespace SilverStripe\ORM;

use SilverStripe\ORM\DataObjectSchema;

/**
 * Cached DataObjectSchema
 */
class CachedDataObjectSchema extends DataObjectSchema {

    /**
     * Cache for DataObjectSchema methods
     *
     * @internal
     * @var array
     */
    protected $cache = [];

    /**
     * {@inheritdoc}
     */
    public function reset() {
        $this->cache = [];
        parent::reset();
    }

    /**
     * {@inheritdoc}
     */
    public function sqlColumnForField($class, $field, $tablePrefix = null)
    {
        $key = __FUNCTION__ . '-' . $this->getClassName($class) . '-' . $field . '-' . $tablePrefix;
        if (!isset($this->cache[$key])) {
            $this->cache[$key] = parent::sqlColumnForField($class, $field, $tablePrefix);
        }
        return $this->cache[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function tableName($class)
    {
        $key = __FUNCTION__ . '-' . $this->getClassName($class);
        if (!isset($this->cache[$key])) {
            $this->cache[$key] = parent::tableName($class);
        }
        return $this->cache[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function baseDataClass($class)
    {
        $key = __FUNCTION__ . '-' . $this->getClassName($class);
        if (!isset($this->cache[$key])) {
            $this->cache[$key] = parent::baseDataClass($class);
        }
        return $this->cache[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function fieldSpecs($classOrInstance, $options = 0)
    {
        $key = __FUNCTION__ . '-' . $this->getClassName($classOrInstance) . '-' . $options;
        if (!isset($this->cache[$key])) {
            $this->cache[$key] = parent::fieldSpecs($classOrInstance, $options);
        }
        return $this->cache[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function databaseFields($class, $aggregated = true)
    {
        $key = __FUNCTION__ . '-' . $this->getClassName($class) . '-' . $aggregated;
        if (!isset($this->cache[$key])) {
            $this->cache[$key] = parent::databaseFields($class, $aggregated);
        }
        return $this->cache[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function compositeFields($class, $aggregated = true)
    {
        $key = __FUNCTION__ . '-' . $this->getClassName($class) . '-' . $aggregated;
        if (!isset($this->cache[$key])) {
            $this->cache[$key] = parent::compositeFields($class, $aggregated);
        }
        return $this->cache[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function tableForField($candidateClass, $fieldName)
    {
        $key = __FUNCTION__ . '-' . $this->getClassName($candidateClass) . '-' . $fieldName;
        if (!isset($this->cache[$key])) {
            $this->cache[$key] = parent::tableForField($candidateClass, $fieldName);
        }
        return $this->cache[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function classForField($candidateClass, $fieldName)
    {
        $key = __FUNCTION__ . '-' . $this->getClassName($candidateClass) . '-' . $fieldName;
        if (!isset($this->cache[$key])) {
            $this->cache[$key] = parent::classForField($candidateClass, $fieldName);
        }
        return $this->cache[$key];
    }

    /**
     * @param string|DataObject $nameOrObject
     * @return string
     */
    protected function getClassName($nameOrObject)
    {
        return (string) $nameOrObject;
    }
}
