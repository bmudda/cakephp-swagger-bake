<?php

namespace SwaggerBake\Lib\Annotation;

/**
 * Annotation for creating application/x-www-form-urlencoded DTO request bodies
 *
 * Read OpenAPI specification for exact usage of the attributes:
 * @see https://swagger.io/specification/ search for "Schema Object"
 *
 * For `format` read OpenAPI specification on data formats:
 * @see https://swagger.io/docs/specification/data-models/data-types/?sbsearch=Data%20Format
 *
 * @Annotation
 * @Target({"PROPERTY"})
 * @Attributes({
 *   @Attribute("name", type = "string"),
 *   @Attribute("type",  type = "string"),
 *   @Attribute("format",  type = "string"),
 *   @Attribute("description",  type = "string"),
 *   @Attribute("readOnly",  type = "bool"),
 *   @Attribute("writeOnly",  type = "bool"),
 *   @Attribute("required",  type = "bool"),
 *   @Attribute("multipleOf", type = "float"),
 *   @Attribute("maximum",  type = "float"),
 *   @Attribute("exclusiveMaximum",  type = "bool"),
 *   @Attribute("minimum",  type = "float"),
 *   @Attribute("exclusiveMinimum",  type = "bool"),
 *   @Attribute("maxLength",  type = "integer"),
 *   @Attribute("minLength", type = "integer"),
 *   @Attribute("pattern",  type = "string"),
 *   @Attribute("maxItems",  type = "integer"),
 *   @Attribute("minItems",  type = "integer"),
 *   @Attribute("uniqueItems",  type = "bool"),
 *   @Attribute("maxProperties",  type = "integer"),
 *   @Attribute("minProperties", type = "integer"),
 *   @Attribute("enum", type = "array"),
 * })
 * @see AbstractSchemaProperty
 */
class SwagDtoForm extends AbstractSchemaProperty
{

}