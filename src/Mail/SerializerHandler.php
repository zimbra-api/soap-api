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
                'format' => 'json',
                'type' => CreateDataSourceRequest::class,
                'method' => 'jsonDeserializeCreateDataSourceRequest',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => CreateDataSourceResponse::class,
                'method' => 'xmlDeserializeCreateDataSourceResponse',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => CreateDataSourceResponse::class,
                'method' => 'jsonDeserializeCreateDataSourceResponse',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => DeleteDataSourceRequest::class,
                'method' => 'xmlDeserializeDeleteDataSourceRequest',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => DeleteDataSourceRequest::class,
                'method' => 'jsonDeserializeDeleteDataSourceRequest',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => GetDataSourcesResponse::class,
                'method' => 'xmlDeserializeGetDataSourcesResponse',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => GetDataSourcesResponse::class,
                'method' => 'jsonDeserializeGetDataSourcesResponse',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => GetImportStatusResponse::class,
                'method' => 'xmlDeserializeGetImportStatusResponse',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => GetImportStatusResponse::class,
                'method' => 'jsonDeserializeGetImportStatusResponse',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => GetItemResponse::class,
                'method' => 'xmlDeserializeGetItemResponse',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => GetItemResponse::class,
                'method' => 'jsonDeserializeGetItemResponse',
            ],
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
                'type' => FreeBusyUserInfo::class,
                'method' => 'xmlDeserializeFreeBusyUserInfo',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => FreeBusyUserInfo::class,
                'method' => 'jsonDeserializeFreeBusyUserInfo',
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

    public function jsonDeserializeCreateDataSourceRequest(
        DeserializationVisitor $visitor, $data, array $type, Context $context
    ): CreateDataSourceRequest
    {
        $serializer = SerializerFactory::create();
        $request = new CreateDataSourceRequest();
        foreach (CreateDataSourceRequest::dataSourceTypes() as $key => $value) {
            if (isset($data[$key]) && is_array($data[$key])) {
                $request->setDataSource(
                    $serializer->deserialize(json_encode($data[$key]), $value, 'json')
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

    public function jsonDeserializeCreateDataSourceResponse(
        DeserializationVisitor $visitor, $data, array $type, Context $context
    ): CreateDataSourceResponse
    {
        $serializer = SerializerFactory::create();
        $response = new CreateDataSourceResponse();
        foreach (CreateDataSourceResponse::dataSourceTypes() as $key => $value) {
            if (isset($data[$key]) && is_array($data[$key])) {
                $response->setDataSource(
                    $serializer->deserialize(json_encode($data[$key]), $value, 'json')
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

    public function jsonDeserializeDeleteDataSourceRequest(
        DeserializationVisitor $visitor, array $data, array $type, Context $context
    ): DeleteDataSourceRequest
    {
        $serializer = SerializerFactory::create();
        $dataSources = [];
        foreach (DeleteDataSourceRequest::dataSourceTypes() as $key => $dsType) {
            if (isset($data[$key]) && is_array($data[$key])) {
                foreach ($data[$key] as $dataSource) {
                    $dataSources[] = $serializer->deserialize(json_encode($dataSource), $dsType, 'json');
                }
            }
        }

        return new DeleteDataSourceRequest($dataSources);
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

    public function jsonDeserializeGetDataSourcesResponse(
        DeserializationVisitor $visitor, array $data, array $type, Context $context
    ): GetDataSourcesResponse
    {
        $serializer = SerializerFactory::create();
        $dataSources = [];
        foreach (GetDataSourcesResponse::dataSourceTypes() as $key => $dsType) {
            if (isset($data[$key]) && is_array($data[$key])) {
                foreach ($data[$key] as $dataSource) {
                    $dataSources[] = $serializer->deserialize(json_encode($dataSource), $dsType, 'json');
                }
            }
        }

        return new GetDataSourcesResponse($dataSources);
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

    public function jsonDeserializeGetImportStatusResponse(
        DeserializationVisitor $visitor, array $data, array $type, Context $context
    ): GetImportStatusResponse
    {
        $serializer = SerializerFactory::create();
        $statuses = [];
        foreach (GetImportStatusResponse::statusTypes() as $key => $dsType) {
            if (isset($data[$key]) && is_array($data[$key])) {
                foreach ($data[$key] as $dataSource) {
                    $statuses[] = $serializer->deserialize(json_encode($dataSource), $dsType, 'json');
                }
            }
        }

        return new GetImportStatusResponse($statuses);
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

    public function jsonDeserializeGetItemResponse(
        DeserializationVisitor $visitor, $data, array $type, Context $context
    ): GetItemResponse
    {
        $serializer = SerializerFactory::create();
        $response = new GetItemResponse();
        foreach (GetItemResponse::itemTypes() as $key => $value) {
            if (isset($data[$key]) && is_array($data[$key])) {
                $response->setItem(
                    $serializer->deserialize(json_encode($data[$key]), $value, 'json')
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

    public function jsonDeserializeFilterTests(
        DeserializationVisitor $visitor, $data, array $type, Context $context
    ): FilterTests
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

    public function jsonDeserializeFreeBusyUserInfo(
        DeserializationVisitor $visitor, array $data, array $type, Context $context
    ): FreeBusyUserInfo
    {
        $serializer = SerializerFactory::create();
        $elements = [];
        foreach (FreeBusyUserInfo::elementTypes() as $key => $dsType) {
            if (isset($data[$key]) && is_array($data[$key])) {
                foreach ($data[$key] as $element) {
                    $elements[] = $serializer->deserialize(json_encode($element), $dsType, 'json');
                }
            }
        }
        return new FreeBusyUserInfo($data['id'] ?? '', $elements);
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

    public function jsonDeserializeNestedRule(
        DeserializationVisitor $visitor, $data, array $type, Context $context
    ): NestedRule
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

    public function jsonDeserializeFilterRule(
        DeserializationVisitor $visitor, $data, array $type, Context $context
    ): FilterRule
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
