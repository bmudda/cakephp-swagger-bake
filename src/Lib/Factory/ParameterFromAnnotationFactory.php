<?php

namespace SwaggerBake\Lib\Factory;

use SwaggerBake\Lib\Annotation\AbstractParameter;
use SwaggerBake\Lib\Annotation\SwagHeader;
use SwaggerBake\Lib\Annotation\SwagQuery;
use SwaggerBake\Lib\OpenApi\Parameter;
use SwaggerBake\Lib\OpenApi\Schema;

class ParameterFromAnnotationFactory
{
    public function create(AbstractParameter $annotation) : Parameter
    {
        $parameter = (new Parameter())
            ->setName($annotation->name)
            ->setDescription($annotation->description)
            ->setRequired($annotation->required)
            ->setDeprecated($annotation->deprecated)
            ->setStyle($annotation->style)
            ->setExplode($annotation->explode)
            ->setExample($annotation->example)
            ->setSchema(
                (new Schema())
                    ->setType($annotation->type)
                    ->setEnum($annotation->enum)
                    ->setFormat($annotation->format)
            )
        ;

        if ($annotation instanceof SwagQuery) {
            $parameter
                ->setIn('query')
                ->setAllowReserved($annotation->allowReserved)
                ->setAllowEmptyValue($annotation->allowEmptyValue)
            ;
        } else if ($annotation instanceof SwagHeader) {
            $parameter->setIn('header');
        }

        return $parameter;
    }
}