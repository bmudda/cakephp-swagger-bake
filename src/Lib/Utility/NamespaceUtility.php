<?php

namespace SwaggerBake\Lib\Utility;

use Cake\ORM\Table;
use SwaggerBake\Lib\Configuration;
use SwaggerBake\Lib\Exception\SwaggerBakeRunTimeException;

/**
 * Class NamespaceUtility
 * @package SwaggerBake\Lib\Utility
 */
class NamespaceUtility
{
    /**
     * Gets a controllers FQNS using the controllers short name
     *
     * @param string $className
     * @param Configuration $config
     * @return string|null
     */
    public static function getControllerFullQualifiedNameSpace(string $className, Configuration $config) : ?string
    {
        $namespaces = $config->getNamespaces();

        if (!isset($namespaces['controllers']) || !is_array($namespaces['controllers'])) {
            throw new SwaggerBakeRunTimeException(
                'Invalid configuration, missing SwaggerBake.namespaces.controllers'
            );
        }

        foreach ($namespaces['controllers'] as $namespace) {
            $entity = $namespace . 'Controller\\' . $className;
            if (class_exists($entity, true)) {
                return $entity;
            }
        }

        return null;
    }

    /**
     * Gets a FQNS of an Entity using the entities short name
     *
     * @param string $className
     * @param Configuration $config
     * @return string|null
     */
    public static function getEntityFullyQualifiedNameSpace(string $className, Configuration $config) : ?string
    {
        $namespaces = $config->getNamespaces();

        if (!isset($namespaces['entities']) || !is_array($namespaces['entities'])) {
            throw new SwaggerBakeRunTimeException(
                'Invalid configuration, missing SwaggerBake.namespaces.entities'
            );
        }

        foreach ($namespaces['entities'] as $namespace) {
            $entity = $namespace . 'Model\Entity\\' . $className;
            if (class_exists($entity, true)) {
                return $entity;
            }
        }

        return null;
    }

    /**
     * Gets a FQNS of a Table
     *
     * @param string $className
     * @param Configuration $config
     * @return string|null
     */
    public static function getTableFullyQualifiedNameSpace(string $className, Configuration $config) : ?string
    {
        $namespaces = $config->getNamespaces();

        if (!isset($namespaces['tables']) || !is_array($namespaces['tables'])) {
            throw new SwaggerBakeRunTimeException(
                'Invalid configuration, missing SwaggerBake.namespaces.tables'
            );
        }

        foreach ($namespaces['tables'] as $namespace) {
            $table = $namespace . 'Model\Table\\' . $className;
            if (class_exists($table, true)) {
                return $table;
            }
        }

        return null;
    }
}