<?php

namespace SwaggerBake\Lib\OpenApi;

use JsonSerializable;

/**
 * Class SchemaProperty
 * @package SwaggerBake\Lib\OpenApi
 * @see https://swagger.io/docs/specification/data-models/
 */
class SchemaProperty implements JsonSerializable
{
    use JsonSchemaTrait;

    /** @var string  */
    private $name = '';

    /** @var string  */
    private $type = '';

    /** @var string  */
    private $format = '';

    /** @var string  */
    private $example = '';

    /** @var string  */
    private $description = '';

    /** @var bool  */
    private $readOnly = false;

    /** @var bool  */
    private $writeOnly = false;

    /** @var bool  */
    private $required = false;

    /** @var array */
    private $enum = [];

    /** @var bool */
    private $deprecated = false;

    /** @var bool  */
    private $requirePresenceOnCreate = false;

    /** @var bool  */
    private $requirePresenceOnUpdate = false;

    public function toArray() : array
    {
        $vars = get_object_vars($this);
        // allows remove this items from JSON
        foreach(['name','required','requirePresenceOnCreate','requirePresenceOnUpdate'] as $v) {
            unset($vars[$v]);
        }

        // reduce JSON clutter by removing empty values
        foreach (['example','description','enum'] as $v) {
            if (empty($vars[$v])) {
                unset($vars[$v]);
            }
        }

        // reduce JSON clutter if these values are equal to their defaults
        foreach (['readOnly', 'writeOnly', 'deprecated'] as $name) {
            if ($vars[$name] === false) {
                unset($vars[$name]);
            }
        }

        return $this->removeEmptyVars($vars);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return SchemaProperty
     */
    public function setName(string $name): SchemaProperty
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return SchemaProperty
     */
    public function setType(string $type): SchemaProperty
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @param string $format
     * @return SchemaProperty
     */
    public function setFormat(string $format): SchemaProperty
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @return bool
     */
    public function isReadOnly(): bool
    {
        return $this->readOnly;
    }

    /**
     * @param bool $readOnly
     * @return SchemaProperty
     */
    public function setReadOnly(bool $readOnly): SchemaProperty
    {
        $this->readOnly = $readOnly;
        return $this;
    }

    /**
     * @return bool
     */
    public function isWriteOnly(): bool
    {
        return $this->writeOnly;
    }

    /**
     * @param bool $writeOnly
     * @return SchemaProperty
     */
    public function setWriteOnly(bool $writeOnly): SchemaProperty
    {
        $this->writeOnly = $writeOnly;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     * @return SchemaProperty
     */
    public function setRequired(bool $required): SchemaProperty
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @return string
     */
    public function getExample(): string
    {
        return $this->example;
    }

    /**
     * @param string $example
     * @return SchemaProperty
     */
    public function setExample(string $example): SchemaProperty
    {
        $this->example = $example;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return SchemaProperty
     */
    public function setDescription(string $description): SchemaProperty
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return array
     */
    public function getEnum(): array
    {
        return $this->enum;
    }

    /**
     * @param array $enum
     * @return SchemaProperty
     */
    public function setEnum(array $enum): SchemaProperty
    {
        $this->enum = $enum;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDeprecated(): bool
    {
        return $this->deprecated;
    }

    /**
     * @param bool $deprecated
     * @return SchemaProperty
     */
    public function setDeprecated(bool $deprecated): SchemaProperty
    {
        $this->deprecated = $deprecated;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequirePresenceOnCreate(): bool
    {
        return $this->requirePresenceOnCreate;
    }

    /**
     * @param bool $requirePresenceOnCreate
     * @return SchemaProperty
     */
    public function setRequirePresenceOnCreate(bool $requirePresenceOnCreate): SchemaProperty
    {
        $this->requirePresenceOnCreate = $requirePresenceOnCreate;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequirePresenceOnUpdate(): bool
    {
        return $this->requirePresenceOnUpdate;
    }

    /**
     * @param bool $requirePresenceOnUpdate
     * @return SchemaProperty
     */
    public function setRequirePresenceOnUpdate(bool $requirePresenceOnUpdate): SchemaProperty
    {
        $this->requirePresenceOnUpdate = $requirePresenceOnUpdate;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTypeScalar() : bool
    {
        return in_array($this->type, ['integer','string','float','boolean','bool','int']);
    }
}