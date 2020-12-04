<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common;

use JMS\Serializer\{Context, GraphNavigator};
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Visitor\SerializationVisitorInterface as SerializationVisitor;
use JMS\Serializer\Visitor\DeserializationVisitorInterface as DeserializationVisitor;

use Zimbra\Common\{SimpleXML, Text};
use Zimbra\Soap\Request\Batch;
use Zimbra\Admin\Struct\EntrySearchFilterMultiCond as MultiCond;
use Zimbra\Admin\Struct\EntrySearchFilterSingleCond as SingleCond;
use Zimbra\Mail\Struct\FilterTests;
use Zimbra\Enum\FilterCondition;

/**
 * SerializerHandler class.
 * 
 * @package   Zimbra
 * @category  Common
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
final class SerializerHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format' => 'json',
                'type' => 'Zimbra\Soap\Request\Batch',
                'method' => 'jsonSerializeBatchRequest',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format' => 'xml',
                'type' => 'Zimbra\Soap\Request\Batch',
                'method' => 'xmlSerializeBatchRequest',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => 'Zimbra\Admin\Struct\EntrySearchFilterMultiCond',
                'method' => 'xmlDeserializeSearchFilterMultiCond',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'Zimbra\Admin\Struct\EntrySearchFilterMultiCond',
                'method' => 'jsonDeserializeSearchFilterMultiCond',
            ],
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

    public function jsonSerializeBatchRequest(
        SerializationVisitor $visitor, Batch $batchRequest, array $type, Context $context
    )
    {
        $data = [
            '_jsns' => 'urn:zimbra',
        ];
        $metadataFactory = $context->getMetadataFactory();

        $serializer = SerializerBuilder::getSerializer();
        $onerror = $batchRequest->getOnError();
        if (!empty($onerror)) {
            $data['onerror'] = $onerror;
        }
        $requests = $batchRequest->getRequests();
        foreach ($requests as $key => $request) {
            $obj = json_decode($serializer->serialize($request, 'json'));
            $obj->requestId = (string) $key;
            $metadata = $metadataFactory->getMetadataForClass(get_class($request));
            $obj->_jsns = $metadata->xmlRootNamespace;
            $data[$metadata->xmlRootName] = $obj;
        }
        return $data;
    }

    public function xmlSerializeBatchRequest(
        SerializationVisitor $visitor, Batch $batchRequest, array $type, Context $context
    )
    {
        $serializer = SerializerBuilder::getSerializer();
        $document = $visitor->getDocument();
        $batchXml = new SimpleXML('<BatchRequest xmlns="urn:zimbra" />');
        $onerror = $batchRequest->getOnError();
        if (!empty($onerror)) {
            $batchXml->addAttribute('onerror', $onerror);
        }
        $requests = $batchRequest->getRequests();
        foreach ($requests as $key => $request) {
            $requestXml = new SimpleXML($serializer->serialize($request, 'xml'));
            $requestXml->addAttribute('requestId', (string) $key);
            $batchXml->append($requestXml);
        }
        $document->loadXML($batchXml->asXml());
    }

    public function xmlDeserializeSearchFilterMultiCond(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    )
    {
        $serializer = SerializerBuilder::getSerializer();
        $conds = new MultiCond;
        $attributes = $data->attributes();
        foreach ($attributes as $key => $value) {
            if ($key == 'not') {
                $conds->setNot(Text::stringToBoolean($value));
            }
            if ($key == 'or') {
                $conds->setOr(Text::stringToBoolean($value));
            }
        }

        $children = $data->children();
        foreach ($children as $value) {
            $name = $value->getName();
            if ($name == 'conds') {
                $conds->addCondition(
                    $this->xmlDeserializeSearchFilterMultiCond($visitor, $value, $type, $context)
                );
            }
            if ($name == 'cond') {
                $conds->addCondition(
                    $serializer->deserialize($value->asXml(), SingleCond::class, 'xml')
                );
            }
        }
        return $conds;
    }

    public function jsonDeserializeSearchFilterMultiCond(
        DeserializationVisitor $visitor, $data, array $type, Context $context
    )
    {
        $serializer = SerializerBuilder::getSerializer();
        $conds = new MultiCond;
        if (isset($data['not']) && $data['not'] !== NULL) {
            $conds->setNot($data['not']);
        }
        if (isset($data['or']) && $data['or'] !== NULL) {
            $conds->setOr($data['or']);
        }
        if (isset($data['conds']) && is_array($data['conds'])) {
            foreach ($data['conds'] as $value) {
                $conds->addCondition(
                    $this->jsonDeserializeSearchFilterMultiCond($visitor, $value, $type, $context)
                );
            }
        }
        if (isset($data['cond'])) {
            foreach ($data['cond'] as $value) {
                $conds->addCondition(
                    $serializer->deserialize(json_encode($value), SingleCond::class, 'json')
                );
            }
        }
        return $conds;
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
