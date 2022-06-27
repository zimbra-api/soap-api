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

use Zimbra\Common\{SerializerFactory, Text};
use Zimbra\Common\Enum\FilterCondition;
use Zimbra\Mail\Message\{
    CreateDataSourceRequest,
    CreateDataSourceResponse,
    DeleteDataSourceRequest,
    GetDataSourcesResponse,
    GetImportStatusResponse,
    GetItemResponse
};
use Zimbra\Mail\Struct\{FilterRule, FilterTests, FilterVariables, FreeBusyUserInfo, NestedRule};

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
    public static function getSubscribingMethods(): array
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => CreateDataSourceRequest::class,
                'method' => 'xmlDeserializeCreateDataSourceRequest',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => CreateDataSourceResponse::class,
                'method' => 'xmlDeserializeCreateDataSourceResponse',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => DeleteDataSourceRequest::class,
                'method' => 'xmlDeserializeDeleteDataSourceRequest',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => GetDataSourcesResponse::class,
                'method' => 'xmlDeserializeGetDataSourcesResponse',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => GetImportStatusResponse::class,
                'method' => 'xmlDeserializeGetImportStatusResponse',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => GetItemResponse::class,
                'method' => 'xmlDeserializeGetItemResponse',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => FilterTests::class,
                'method' => 'xmlDeserializeFilterTests',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => FreeBusyUserInfo::class,
                'method' => 'xmlDeserializeFreeBusyUserInfo',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => NestedRule::class,
                'method' => 'xmlDeserializeNestedRule',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => FilterRule::class,
                'method' => 'xmlDeserializeFilterRule',
            ],
        ];
    }

    public function xmlDeserializeCreateDataSourceRequest(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    ): CreateDataSourceRequest
    {
        $serializer = SerializerFactory::create();
        $request = new CreateDataSourceRequest();

        $types = CreateDataSourceRequest::dataSourceTypes();
        foreach ($data->children() as $child) {
            $name = $child->getName();
            if (!empty($types[$name])) {
                $request->setDataSource(
                    $serializer->deserialize($child->asXml(), $types[$name], 'xml')
                );
            }
        }
        return $request;
    }

    public function xmlDeserializeCreateDataSourceResponse(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    ): CreateDataSourceResponse
    {
        $serializer = SerializerFactory::create();
        $response = new CreateDataSourceResponse();

        $types = CreateDataSourceResponse::dataSourceTypes();
        foreach ($data->children() as $child) {
            $name = $child->getName();
            if (!empty($types[$name])) {
                $response->setDataSource(
                    $serializer->deserialize($child->asXml(), $types[$name], 'xml')
                );
            }
        }
        return $response;

    }

    public function xmlDeserializeDeleteDataSourceRequest(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    ): DeleteDataSourceRequest
    {
        $serializer = SerializerFactory::create();
        $types = DeleteDataSourceRequest::dataSourceTypes();
        $children = array_filter(iterator_to_array($data->children()), static fn ($child) => !empty($types[$child->getName()]));
        $dataSources = array_map(static fn ($child) => $serializer->deserialize($child->asXml(), $types[$child->getName()], 'xml'), $children);
        return new DeleteDataSourceRequest(array_values($dataSources));
    }

    public function xmlDeserializeGetDataSourcesResponse(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    ): GetDataSourcesResponse
    {
        $serializer = SerializerFactory::create();
        $types = GetDataSourcesResponse::dataSourceTypes();
        $children = array_filter(iterator_to_array($data->children()), static fn ($child) => !empty($types[$child->getName()]));
        $dataSources = array_map(static fn ($child) => $serializer->deserialize($child->asXml(), $types[$child->getName()], 'xml'), $children);
        return new GetDataSourcesResponse(array_values($dataSources));
    }

    public function xmlDeserializeGetImportStatusResponse(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    ): GetImportStatusResponse
    {
        $serializer = SerializerFactory::create();
        $types = GetImportStatusResponse::statusTypes();
        $children = array_filter(iterator_to_array($data->children()), static fn ($child) => !empty($types[$child->getName()]));
        $statuses = array_map(static fn ($child) => $serializer->deserialize($child->asXml(), $types[$child->getName()], 'xml'), $children);
        return new GetImportStatusResponse(array_values($statuses));
    }

    public function xmlDeserializeGetItemResponse(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    ): GetItemResponse
    {
        $serializer = SerializerFactory::create();
        $response = new GetItemResponse();

        $types = GetItemResponse::itemTypes();
        foreach ($data->children() as $child) {
            $name = $child->getName();
            if (!empty($types[$name])) {
                $response->setItem(
                    $serializer->deserialize($child->asXml(), $types[$name], 'xml')
                );
            }
        }
        return $response;

    }

    public function xmlDeserializeFilterTests(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    ): FilterTests
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

    public function xmlDeserializeFreeBusyUserInfo(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    ): FreeBusyUserInfo
    {
        $serializer = SerializerFactory::create();
        $types = FreeBusyUserInfo::elementTypes();
        $children = array_filter(iterator_to_array($data->children()), static fn ($child) => !empty($types[$child->getName()]));
        $elements = array_map(static fn ($child) => $serializer->deserialize($child->asXml(), $types[$child->getName()], 'xml'), $children);

        $id = '';
        foreach ($data->attributes() as $key => $value) {
            if ($key == 'id') {
                $id = (string) $value;
                break;
            }
        }

        return new FreeBusyUserInfo($id, array_values($elements));
    }

    public function xmlDeserializeNestedRule(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    ): NestedRule
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

    public function xmlDeserializeFilterRule(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    ): FilterRule
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
}
