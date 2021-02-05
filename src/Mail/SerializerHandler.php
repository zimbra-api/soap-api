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
use Zimbra\Common\Text;
use Zimbra\Enum\FilterCondition;
use Zimbra\Mail\Struct\FilterRule;
use Zimbra\Mail\Struct\FilterTests;
use Zimbra\Mail\Struct\FilterVariables;
use Zimbra\Mail\Struct\NestedRule;

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
                'type' => FilterTests::class,
                'method' => 'xmlDeserializeFilterTests',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => FilterTests::class,
                'method' => 'jsonDeserializeFilterTests',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => NestedRule::class,
                'method' => 'xmlDeserializeNestedRule',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => NestedRule::class,
                'method' => 'jsonDeserializeNestedRule',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => FilterRule::class,
                'method' => 'xmlDeserializeFilterRule',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => FilterRule::class,
                'method' => 'jsonDeserializeFilterRule',
            ],
        ];
    }

    public function xmlDeserializeFilterTests(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    )
    {
        $serializer = SerializerFactory::create();
        $filterTests = new FilterTests(FilterCondition::ALL_OF());
        foreach ($data->attributes() as $key => $value) {
            if ($key == 'condition') {
                $filterTests->setCondition(new FilterCondition((string) $value));
            }
        }

        $types = FilterTests::filterTestTypes();
        foreach ($data->children() as $child) {
            $name = $child->getName();
            if (!empty($types[$name])) {
                $filterTests->addTest(
                    $serializer->deserialize($child->asXml(), $types[$name], 'xml')
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
        foreach (FilterTests::filterTestTypes() as $key => $value) {
            if (isset($data[$key]) && is_array($data[$key])) {
                $filterTests->addTest(
                    $serializer->deserialize(json_encode($data[$key]), $value, 'json')
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

        foreach ($data->children() as $child) {
            $name = $child->getName();
            if ('filterVariables' === $name) {
                $nestedRule->setFilterVariables(
                    $serializer->deserialize($child->asXml(), FilterVariables::class, 'xml')
                );
            }
            if ('filterTests' === $name) {
                $nestedRule->setFilterTests(
                    $serializer->deserialize($child->asXml(), FilterTests::class, 'xml')
                );
            }
            if ('nestedRule' === $name) {
                $nestedRule->setChild(
                    $serializer->deserialize($child->asXml(), NestedRule::class, 'xml')
                );
            }
            if ('filterActions' === $name) {
                foreach ($child->children() as $action) {
                    $actionType = $types[$action->getName()] ?? NULL;
                    if (!empty($actionType)) {
                        $nestedRule->addFilterAction(
                            $serializer->deserialize($action->asXml(), $actionType, 'xml')
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
            foreach (NestedRule::filterActionTypes() as $key => $actionType) {
                if (isset($filterActions[$key]) && is_array($filterActions[$key])) {
                    $nestedRule->addFilterAction(
                        $serializer->deserialize(json_encode($filterActions[$key]), $actionType, 'json')
                    );
                }
            }
        }
        return $nestedRule;
    }

    public function xmlDeserializeFilterRule(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    )
    {
        $serializer = SerializerFactory::create();
        $filterRule = new FilterRule('', FALSE, new FilterTests(FilterCondition::ALL_OF()));
        $types = FilterRule::filterActionTypes();

        foreach ($data->attributes() as $key => $value) {
            if ($key == 'name') {
                $filterRule->setName((string) $value);
            }
            if ($key == 'active') {
                $filterRule->setActive(Text::stringToBoolean((string) $value));
            }
        }

        foreach ($data->children() as $child) {
            $name = $child->getName();
            if ('filterVariables' === $name) {
                $filterRule->setFilterVariables(
                    $serializer->deserialize($child->asXml(), FilterVariables::class, 'xml')
                );
            }
            if ('filterTests' === $name) {
                $filterRule->setFilterTests(
                    $serializer->deserialize($child->asXml(), FilterTests::class, 'xml')
                );
            }
            if ('nestedRule' === $name) {
                $filterRule->setChild(
                    $serializer->deserialize($child->asXml(), NestedRule::class, 'xml')
                );
            }
            if ('filterActions' === $name) {
                foreach ($child->children() as $action) {
                    $actionType = $types[$action->getName()] ?? NULL;
                    if (!empty($actionType)) {
                        $filterRule->addFilterAction(
                            $serializer->deserialize($action->asXml(), $actionType, 'xml')
                        );
                    }
                }
            }
        }

        return $filterRule;
    }

    public function jsonDeserializeFilterRule(
        DeserializationVisitor $visitor, $data, array $type, Context $context
    )
    {
        $serializer = SerializerFactory::create();
        $filterRule = new FilterRule('', FALSE, new FilterTests(FilterCondition::ALL_OF()));

        if (isset($data['name']) && $data['name'] !== NULL) {
            $filterRule->setName($data['name']);
        }
        if (isset($data['active']) && $data['active'] !== NULL) {
            $filterRule->setActive(Text::stringToBoolean($data['active']));
        }

        if (isset($data['filterVariables']) && $data['filterVariables'] !== NULL) {
            $filterRule->setFilterVariables(
                $serializer->deserialize(json_encode($data['filterVariables']), FilterVariables::class, 'json')
            );
        }
        if (isset($data['filterTests']) && $data['filterTests'] !== NULL) {
            $filterRule->setFilterTests(
                $serializer->deserialize(json_encode($data['filterTests']), FilterTests::class, 'json')
            );
        }
        if (isset($data['nestedRule']) && $data['nestedRule'] !== NULL) {
            $filterRule->setChild(
                $serializer->deserialize(json_encode($data['nestedRule']), NestedRule::class, 'json')
            );
        }
        if (isset($data['filterActions']) && $data['filterActions'] !== NULL) {
            $filterActions = $data['filterActions'];
            foreach (FilterRule::filterActionTypes() as $key => $actionType) {
                if (isset($filterActions[$key]) && is_array($filterActions[$key])) {
                    $filterRule->addFilterAction(
                        $serializer->deserialize(json_encode($filterActions[$key]), $actionType, 'json')
                    );
                }
            }
        }
        return $filterRule;
    }
}