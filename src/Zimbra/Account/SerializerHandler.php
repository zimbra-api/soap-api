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
use Zimbra\Common\SerializerFactory;

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
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => AccountDataSources::class,
                'method' => 'xmlDeserializeAccountDataSources',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => AccountDataSources::class,
                'method' => 'jsonDeserializeAccountDataSources',
            ],
        ];
    }

    public function xmlDeserializeAccountDataSources(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    )
    {
        $serializer = SerializerFactory::create();
        $types = AccountDataSources::dataSourceTypes();
        $dataSources = [];

        foreach ($data->children() as $child) {
            $name = $child->getName();
            if (!empty($types[$name])) {
                $dataSources[] = $serializer->deserialize($child->asXml(), $types[$name], 'xml');
            }
        }

        return new AccountDataSources($dataSources);
    }

    public function jsonDeserializeAccountDataSources(
        DeserializationVisitor $visitor, $data, array $type, Context $context
    )
    {
        $serializer = SerializerFactory::create();
        $dataSources = [];

        foreach (AccountDataSources::dataSourceTypes() as $key => $dsType) {
            if (isset($data[$key]) && is_array($data[$key])) {
                foreach ($data[$key] as $dataSource) {
                    $dataSources[] = $serializer->deserialize(json_encode($dataSource), $dsType, 'json');
                }
            }
        }

        return new AccountDataSources($dataSources);
    }
}
