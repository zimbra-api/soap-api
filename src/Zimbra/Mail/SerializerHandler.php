<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail;

use JMS\Serializer\{Context, GraphNavigator};
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Visitor\SerializationVisitorInterface as SerializationVisitor;
use JMS\Serializer\Visitor\DeserializationVisitorInterface as DeserializationVisitor;

use Zimbra\Common\SerializerBuilder;
use Zimbra\Enum\FilterCondition;
use Zimbra\Mail\Struct\FilterTests;

/**
 * SerializerHandler class.
 *
 * @package   Zimbra
 * @category  Mail
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
                'type' => 'Zimbra\Mail\Struct\FilterTests',
                'method' => 'xmlDeserializeFilterTests',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'Zimbra\Mail\Struct\FilterTests',
                'method' => 'jsonDeserializeFilterTests',
            ],
        ];
    }

    public function xmlDeserializeFilterTests(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    )
    {
        $serializer = SerializerBuilder::getSerializer();
        $filterTests = new FilterTests(FilterCondition::ALL_OF());
        $attributes = $data->attributes();
        foreach ($attributes as $key => $value) {
            if ($key == 'condition') {
                $filterTests->setCondition(new FilterCondition((string) $value));
            }
        }

        $children = $data->children();
        $types = FilterTests::filterTestTypes();
        foreach ($children as $value) {
            $type = $types[$value->getName()] ?? NULL;
            if (!empty($type)) {
                $filterTests->addTest(
                    $serializer->deserialize($value->asXml(), $type, 'xml')
                );
            }
        }
        return $filterTests;

    }

    public function jsonDeserializeFilterTests(
        DeserializationVisitor $visitor, $data, array $type, Context $context
    )
    {
        $serializer = SerializerBuilder::getSerializer();
        $filterTests = new FilterTests(FilterCondition::ALL_OF());
        if (isset($data['condition']) && $data['condition'] !== NULL) {
            $filterTests->setCondition(new FilterCondition((string) $data['condition']));
        }
        foreach (FilterTests::filterTestTypes() as $key => $type) {
            if (isset($data[$key]) && is_array($data[$key])) {
                $filterTests->addTest(
                    $serializer->deserialize(json_encode($data[$key]), $type, 'json')
                );
            }
        }
        return $filterTests;
    }
}
