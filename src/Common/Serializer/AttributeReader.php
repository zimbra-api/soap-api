<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Serializer;

use Doctrine\Common\Annotations\Reader;

/**
 * Attribute reader class.
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Serializer
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AttributeReader implements Reader
{
    /**
     * {@inheritdoc}
     */
    public function getClassAnnotations(\ReflectionClass $class)
    {
        return $this->buildAnnotations($class->getAttributes());
    }

    /**
     * {@inheritdoc}
     */
    public function getClassAnnotation(\ReflectionClass $class, $annotationName)
    {
        return $this->buildAnnotation($class->getAttributes($annotationName));
    }

    /**
     * {@inheritdoc}
     */
    public function getMethodAnnotations(\ReflectionMethod $method)
    {
        return $this->buildAnnotations($method->getAttributes());
    }

    /**
     * {@inheritdoc}
     */
    public function getMethodAnnotation(\ReflectionMethod $method, $annotationName)
    {
        return $this->buildAnnotation($method->getAttributes($annotationName));
    }

    /**
     * {@inheritdoc}
     */
    public function getPropertyAnnotations(\ReflectionProperty $property)
    {
        return $this->buildAnnotations($property->getAttributes());
    }

    /**
     * {@inheritdoc}
     */
    public function getPropertyAnnotation(\ReflectionProperty $property, $annotationName)
    {
        return $this->buildAnnotation($property->getAttributes($annotationName));
    }

    private function buildAnnotation(array $attributes): ?object
    {
        if (!empty($attributes)) {
            $attribute = $attributes[0];
            if (0 === strpos($attribute->getName(), 'JMS\Serializer\Annotation')) {
                return $attribute->newInstance();
            }
        }
        return NULL;
    }

    private function buildAnnotations(array $attributes): array
    {
        $annotations = [];
        foreach ($attributes as $attribute) {
            if (0 === strpos($attribute->getName(), 'JMS\Serializer\Annotation')) {
                $annotations[] = $attribute->newInstance();
            }
        }

        return $annotations;
    }
}
