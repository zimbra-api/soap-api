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
use Zimbra\Mail\Struct\{
    FilterActions,
    FilterTests,
    FreeBusyUserInfo
};

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
    const SERIALIZE_FORMAT = 'xml';

    public static function getSubscribingMethods(): array
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => self::SERIALIZE_FORMAT,
                'type' => CreateDataSourceRequest::class,
                'method' => 'xmlDeserializeCreateDataSourceRequest',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => self::SERIALIZE_FORMAT,
                'type' => CreateDataSourceResponse::class,
                'method' => 'xmlDeserializeCreateDataSourceResponse',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => self::SERIALIZE_FORMAT,
                'type' => DeleteDataSourceRequest::class,
                'method' => 'xmlDeserializeDeleteDataSourceRequest',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => self::SERIALIZE_FORMAT,
                'type' => GetDataSourcesResponse::class,
                'method' => 'xmlDeserializeGetDataSourcesResponse',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => self::SERIALIZE_FORMAT,
                'type' => GetImportStatusResponse::class,
                'method' => 'xmlDeserializeGetImportStatusResponse',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => self::SERIALIZE_FORMAT,
                'type' => GetItemResponse::class,
                'method' => 'xmlDeserializeGetItemResponse',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => self::SERIALIZE_FORMAT,
                'type' => FilterActions::class,
                'method' => 'xmlDeserializeFilterActions',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => self::SERIALIZE_FORMAT,
                'type' => FilterTests::class,
                'method' => 'xmlDeserializeFilterTests',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => self::SERIALIZE_FORMAT,
                'type' => FreeBusyUserInfo::class,
                'method' => 'xmlDeserializeFreeBusyUserInfo',
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
                    $serializer->deserialize($child->asXml(), $types[$name], self::SERIALIZE_FORMAT)
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
                    $serializer->deserialize($child->asXml(), $types[$name], self::SERIALIZE_FORMAT)
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
                    $serializer->deserialize($child->asXml(), $types[$name], self::SERIALIZE_FORMAT)
                );
            }
        }
        return $response;

    }

    public function xmlDeserializeFilterActions(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    ): FilterActions
    {
        $serializer = SerializerFactory::create();
        $types = FilterActions::filterActionTypes();
        $children = array_filter(iterator_to_array($data->children()), static fn ($child) => !empty($types[$child->getName()]));
        $actions = array_map(static fn ($child) => $serializer->deserialize($child->asXml(), $types[$child->getName()], self::SERIALIZE_FORMAT), $children);
        return new FilterActions(array_values($actions));
    }

    public function xmlDeserializeFilterTests(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    ): FilterTests
    {
        $serializer = SerializerFactory::create();
        $filterTests = new FilterTests();
        foreach ($data->attributes() as $key => $value) {
            if ($key == 'condition') {
                $filterTests->setCondition(new FilterCondition((string) $value));
            }
        }

        $types = FilterTests::filterTestTypes();
        $children = array_filter(iterator_to_array($data->children()), static fn ($child) => !empty($types[$child->getName()]));
        $tests = array_map(static fn ($child) => $serializer->deserialize($child->asXml(), $types[$child->getName()], self::SERIALIZE_FORMAT), $children);
        $filterTests->setTests(array_values($tests));
        return $filterTests;

    }

    public function xmlDeserializeFreeBusyUserInfo(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    ): FreeBusyUserInfo
    {
        $serializer = SerializerFactory::create();
        $types = FreeBusyUserInfo::elementTypes();
        $children = array_filter(iterator_to_array($data->children()), static fn ($child) => !empty($types[$child->getName()]));
        $elements = array_map(static fn ($child) => $serializer->deserialize($child->asXml(), $types[$child->getName()], self::SERIALIZE_FORMAT), $children);

        $id = '';
        foreach ($data->attributes() as $key => $value) {
            if ($key == 'id') {
                $id = (string) $value;
                break;
            }
        }

        return new FreeBusyUserInfo($id, array_values($elements));
    }
}
