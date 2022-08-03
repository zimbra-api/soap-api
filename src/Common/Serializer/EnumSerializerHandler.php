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

use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Visitor\{
    DeserializationVisitorInterface,
    SerializationVisitorInterface
};
use MyCLabs\Enum\Enum;

/**
 * Enum serializer handler class.
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Serializer
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EnumSerializerHandler implements SubscribingHandlerInterface
{
    private const TYPE_ENUM = 'Enum';

    /**
     * {@inheritdoc}
     */
    public static function getSubscribingMethods(): array
    {
        return [
            [
                'direction' => GraphNavigatorInterface::DIRECTION_SERIALIZATION,
                'type' => self::TYPE_ENUM,
                'format' => 'xml',
                'method' => 'serializeEnum',
            ],
            [
                'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'type' => self::TYPE_ENUM,
                'format' => 'xml',
                'method' => 'deserializeEnum',
            ],
        ];
    }

    public function serializeEnum(SerializationVisitorInterface $visitor, Enum $enum, array $type, Context $context)
    {
        $mappedClass = $this->getEnumClass($type);
        $actualClass = get_class($enum);
        if ($mappedClass !== $actualClass) {
            throw new \TypeError(sprintf(
                'Class of given value "%s" does not match mapped %s<%s>',
                $actualClass,
                self::TYPE_ENUM,
                $mappedClass
            ));
        }
        return $visitor->visitString($enum->getValue(), $type);
    }

    public function deserializeEnum(DeserializationVisitorInterface $visitor, $data, array $type, Context $context): Enum
    {
        $enumClass = $this->getEnumClass($type);
        return new $enumClass((string) $data);
    }

    private function getEnumClass(array $type): string
    {
        if (!(isset($type['params'][0]) && isset($type['params'][0]['name']))) {
            throw new \InvalidArgumentException('Missing enum class name');
        }

        $enumClass = $type['params'][0]['name'];
        if (!is_subclass_of($enumClass, Enum::class)) {
            throw new \TypeError(sprintf('Class "%s" is not an Enum', $enumClass));
        }
        return $enumClass;
    }
}
