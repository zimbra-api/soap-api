<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account;

use JMS\Serializer\{Context, GraphNavigator};
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Visitor\SerializationVisitorInterface as SerializationVisitor;
use JMS\Serializer\Visitor\DeserializationVisitorInterface as DeserializationVisitor;

use Zimbra\Account\Struct\AccountDataSources;
use Zimbra\Account\Struct\EntrySearchFilterMultiCond as MultiCond;
use Zimbra\Account\Struct\EntrySearchFilterSingleCond as SingleCond;
use Zimbra\Common\SerializerFactory;
use Zimbra\Common\Text;

/**
 * SerializerHandler class.
 * 
 * @package   Zimbra
 * @category  Account
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
final class SerializerHandler implements SubscribingHandlerInterface
{
    const SERIALIZE_FORMAT = 'xml';

    public static function getSubscribingMethods(): array
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => self::SERIALIZE_FORMAT,
                'type' => AccountDataSources::class,
                'method' => 'xmlDeserializeAccountDataSources',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => self::SERIALIZE_FORMAT,
                'type' => MultiCond::class,
                'method' => 'xmlDeserializeSearchFilterMultiCond',
            ],
        ];
    }

    public function xmlDeserializeAccountDataSources(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    ): AccountDataSources
    {
        $serializer = SerializerFactory::create();
        $types = AccountDataSources::dataSourceTypes();
        $children = array_filter(iterator_to_array($data->children()), static fn ($child) => !empty($types[$child->getName()]));
        $dataSources = array_map(static fn ($child) => $serializer->deserialize($child->asXml(), $types[$child->getName()], self::SERIALIZE_FORMAT), $children);
        return new AccountDataSources(array_values($dataSources));
    }

    public function xmlDeserializeSearchFilterMultiCond(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    ): MultiCond
    {
        $serializer = SerializerFactory::create();
        $conds = new MultiCond;
        $attributes = iterator_to_array($data->attributes());
        array_walk($attributes, static function ($value, $key) use ($conds) {
            if ($key === 'not') {
                $conds->setNot(Text::stringToBoolean($value));
            }
            if ($key === 'or') {
                $conds->setOr(Text::stringToBoolean($value));
            }
        });

        foreach ($data->children() as $child) {
            $name = $child->getName();
            if ($name === 'conds') {
                $conds->addCondition(
                    $this->xmlDeserializeSearchFilterMultiCond($visitor, $child, $type, $context)
                );
            }
            if ($name === 'cond') {
                $conds->addCondition(
                    $serializer->deserialize($child->asXml(), SingleCond::class, self::SERIALIZE_FORMAT)
                );
            }
        }
        return $conds;
    }
}
