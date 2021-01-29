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

        $serializer = SerializerFactory::create();
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
        $serializer = SerializerFactory::create();
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
}
