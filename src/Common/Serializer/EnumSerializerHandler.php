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

use JMS\Serializer\{
    Handler\SubscribingHandlerInterface,
    Visitor\DeserializationVisitorInterface,
    Visitor\SerializationVisitorInterface,
    Context,
    GraphNavigatorInterface,
};
use BackedEnum;

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

    /**
     * Serialize Enum type
     *
     * @return \DOMText
     */
    public static function serializeEnum(
        SerializationVisitorInterface $visitor, BackedEnum $enum, array $type, Context $context
    ): \DOMText
    {
        $mappedClass = self::getEnumClass($type);
        $actualClass = get_class($enum);
        if ($mappedClass !== $actualClass) {
            throw new \TypeError(sprintf(
                'Class of given value "%s" does not match mapped %s<%s>',
                $actualClass,
                self::TYPE_ENUM,
                $mappedClass
            ));
        }
        return $visitor->visitString($enum->value, $type);
    }

    /**
     * Deserialize BackedEnum type
     *
     * @return BackedEnum
     */
    public static function deserializeEnum(
        DeserializationVisitorInterface $visitor, $data, array $type, Context $context
    ): ?BackedEnum
    {
        $enumClass = self::getEnumClass($type);
        return $enumClass::tryFrom((string) $data);
    }

    private static function getEnumClass(array $type): string
    {
        if (!(isset($type['params'][0]) && isset($type['params'][0]['name']))) {
            throw new \InvalidArgumentException('Missing enum class name');
        }

        $enumClass = $type['params'][0]['name'];
        if (!is_subclass_of($enumClass, BackedEnum::class)) {
            throw new \TypeError(sprintf('Class "%s" is not an Enum', $enumClass));
        }
        return $enumClass;
    }
}
