<?php

namespace SwaggerBake\Lib\Annotation;

use InvalidArgumentException;

/**
 * Class AbstractSchemaProperty
 * @package SwaggerBake\Lib\Annotation
 *
 * Read OpenAPI specification for exact usage of the attributes:
 * @see https://swagger.io/specification/ search for "Schema Object"
 *
 * For `format` read OpenAPI specification on data formats:
 * @see https://swagger.io/docs/specification/data-models/data-types/?sbsearch=Data%20Format
 */
abstract class AbstractSchemaProperty
{
    /** @var string */
    public $name;

    /** @var string */
    public $type = 'string';

    /** @var string */
    public $format;

    /** @var string */
    public $description;

    /** @var bool */
    public $readOnly = false;

    /** @var bool */
    public $writeOnly = false;

    /** @var bool */
    public $required = false;

    /** @var string */
    public $title;

    /** @var mixed */
    public $default;

    /** @var bool */
    public $nullable = false;

    /** @var bool */
    public $deprecated = false;

    /** @var float|null */
    public $multipleOf;

    /** @var float|null */
    public $maximum;

    /** @var bool */
    public $exclusiveMaximum = false;

    /** @var float|null */
    public $minimum;

    /** @var bool */
    public $exclusiveMinimum = false;

    /** @var int|null */
    public $maxLength;

    /** @var int|null */
    public $minLength;

    /** @var string|null */
    public $pattern;

    /** @var int|null */
    public $maxItems;

    /** @var int|null */
    public $minItems;

    /** @var bool */
    public $uniqueItems = false;

    /** @var int|null */
    public $maxProperties;

    /** @var int|null */
    public $minProperties;

    /** @var array */
    public $enum = [];

    public function __construct(array $values)
    {
        if (!isset($values['name'])) {
            throw new InvalidArgumentException('Name parameter is required');
        }

        foreach ($values as $attribute => $value) {
            if (property_exists($this, $attribute)) {
                $this->{$attribute} = $value;
            }
        }
    }
}