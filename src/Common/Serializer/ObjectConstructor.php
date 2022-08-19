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

use JMS\Serializer\Construction\ObjectConstructorInterface;
use JMS\Serializer\DeserializationContext as Context;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\Visitor\DeserializationVisitorInterface as Visitor;

/**
 * Object constructor class.
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Serializer
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ObjectConstructor implements ObjectConstructorInterface
{
    /**
     * Fallback object constructor
     * 
     * @var ObjectConstructorInterface
     */
    private ObjectConstructorInterface $fallbackConstructor;

    /**
     * Constructor
     * 
     * @param ObjectConstructorInterface $fallbackConstructor
     */
    public function __construct(
        ObjectConstructorInterface $fallbackConstructor
    ) {
        $this->fallbackConstructor = $fallbackConstructor;
    }

    /**
     * {@inheritdoc}
     */
    public function construct(
        Visitor $visitor, ClassMetadata $metadata, $data, array $type, Context $context
    ): ?object
    {
        $reflection = new \ReflectionClass($metadata->name);
        $constructor = $reflection->getConstructor();
        if (empty($constructor)) {
            return $reflection->newInstanceArgs();
        }
        else {
            $parameters = $constructor->getParameters();
            if (empty($parameters)) {
                return $reflection->newInstanceArgs();
            }
            else {
                $isDefaultConstructor = TRUE;
                foreach ($parameters as $parameter) {
                    if (!$parameter->isOptional()) {
                        $isDefaultConstructor = FALSE;
                        break;
                    }
                }
                if ($isDefaultConstructor) {
                    return $reflection->newInstanceArgs();
                }
            }
        }
        return $this->fallbackConstructor->construct($visitor, $metadata, $data, $type, $context);
    }
}
