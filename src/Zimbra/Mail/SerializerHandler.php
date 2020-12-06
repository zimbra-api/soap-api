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

use Zimbra\Common\SerializerFactory;
use Zimbra\Enum\FilterCondition;
use Zimbra\Mail\Struct\FilterTests;
use Zimbra\Mail\Struct\NestedRule;
use Zimbra\Mail\Struct\FilterVariables;

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

            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => 'Zimbra\Mail\Struct\NestedRule',
                'method' => 'xmlDeserializeNestedRule',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'Zimbra\Mail\Struct\NestedRule',
                'method' => 'jsonDeserializeNestedRule',
            ],
        ];
    }

    public function xmlDeserializeFilterTests(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    )
    {
        $serializer = SerializerFactory::create();
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
        $serializer = SerializerFactory::create();
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


    public function xmlDeserializeNestedRule(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    )
    {
        $serializer = SerializerFactory::create();
        $nestedRule = new NestedRule(new FilterTests(FilterCondition::ALL_OF()));
        $types = NestedRule::filterActionTypes();

        $children = $data->children();
        foreach ($children as $value) {
            $name = $value->getName();
            if ('filterVariables' === $name) {
                $nestedRule->setFilterVariables(
                    $serializer->deserialize($value->asXml(), FilterVariables::class, 'xml')
                );
            }
            if ('filterTests' === $name) {
                $nestedRule->setFilterTests(
                    $serializer->deserialize($value->asXml(), FilterTests::class, 'xml')
                );
            }
            if ('nestedRule' === $name) {
                $nestedRule->setChild(
                    $serializer->deserialize($value->asXml(), NestedRule::class, 'xml')
                );
            }
            if ('filterActions' === $name) {
                $filterActions = $value->children();
                foreach ($filterActions as $action) {
                    $type = $types[$action->getName()] ?? NULL;
                    if (!empty($type)) {
                        $nestedRule->addFilterAction(
                            $serializer->deserialize($action->asXml(), $type, 'xml')
                        );
                    }
                }
            }
        }

        return $nestedRule;
    }

    public function jsonDeserializeNestedRule(
        DeserializationVisitor $visitor, $data, array $type, Context $context
    )
    {
        $serializer = SerializerFactory::create();
        $nestedRule = new NestedRule(new FilterTests(FilterCondition::ALL_OF()));

        if (isset($data['filterVariables']) && $data['filterVariables'] !== NULL) {
            $nestedRule->setFilterVariables(
                $serializer->deserialize(json_encode($data['filterVariables']), FilterVariables::class, 'json')
            );
        }
        if (isset($data['filterTests']) && $data['filterTests'] !== NULL) {
            $nestedRule->setFilterTests(
                $serializer->deserialize(json_encode($data['filterTests']), FilterTests::class, 'json')
            );
        }
        if (isset($data['nestedRule']) && $data['nestedRule'] !== NULL) {
            $nestedRule->setChild(
                $serializer->deserialize(json_encode($data['nestedRule']), NestedRule::class, 'json')
            );
        }
        if (isset($data['filterActions']) && $data['filterActions'] !== NULL) {
            $filterActions = $data['filterActions'];
            foreach (NestedRule::filterActionTypes() as $key => $type) {
                if (isset($filterActions[$key]) && is_array($filterActions[$key])) {
                    $nestedRule->addFilterAction(
                        $serializer->deserialize(json_encode($filterActions[$key]), $type, 'json')
                    );
                }
            }
        }
        return $nestedRule;
    }
}
