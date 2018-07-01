<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Request;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\HandlerCallback;
use JMS\Serializer\Context;
use JMS\Serializer\XmlSerializationVisitor;
use JMS\Serializer\XmlDeserializationVisitor;
use JMS\Serializer\SerializerBuilder;

use Zimbra\Soap\Request;
use Zimbra\Soap\RequestInterface;
use Zimbra\Soap\ClientInterface;

/**
 * Batch request class in Zimbra API PHP, not to be instantiated.
 * 
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2014 by Nguyen Van Nguyen.
 */
class Batch extends Request
{
    /**
     * @Type("array<Zimbra\Struct\RequestInterface>")
     */
    private $_requests;

    /**
     * @Accessor(getter="getOnError", setter="setOnError")
     * @Type("string")
     */
    private $_onerror;

    /**
     * Batch request constructor
     * @param  array $requests
     * @return self
     */
    public function __construct(array $requests = [])
    {
        $this->setRequests($requests);
    }

    /**
     * Gets on error
     *
     * @return string
     */
    public function getOnError()
    {
        return $this->_onerror;
    }

    /**
     * Sets on error
     *
     * @param  string $name
     * @return self
     */
    public function setOnError($onerror)
    {
        $onerror = strtolower(trim($onerror));
        if (!in_array($onerror, ['continue', 'stop']))
        {
            $onerror = 'continue';
        }
        $this->_onerror = $onerror;
        return $this;
    }

    /**
     * Add a request
     *
     * @param  RequestInterface $request
     * @return self
     */
    public function addRequest(RequestInterface $request)
    {
        $this->_requests[] = $request;
        return $this;
    }

    /**
     * Set requests
     *
     * @param  array $requests
     * @return Sequence
     */
    public function setRequests(array $requests)
    {
        $this->_requests = [];
        foreach ($requests as $request)
        {
            if ($request instanceof RequestInterface)
            {
                $this->_requests[] = $request;
            }
        }
        return $this;
    }

    /**
     * Gets requests
     *
     * @return array
     */
    public function getRequests()
    {
        return $this->_requests;
    }

    /** @HandlerCallback("xml", direction = "serialization") */
    public function serializeToXml(XmlSerializationVisitor $visitor, $data, Context $context)
    {
        $serializer = SerializerBuilder::create()->build();
        if (null === $visitor->document)
        {
            $visitor->document = $visitor->createDocument(null, null, false);
        }

        $batchNode = $visitor->document->createElement('BatchRequest');
        $onerror = $this->getOnError();
        if (!empty($onerror))
        {
            $batchNode->setAttribute('onerror', $onerror);
        }
        foreach ($this->_requests as $key => $request)
        {
            $xml = $serializer->serialize($request, 'xml');
            $reqDoc = $visitor->createDocument(null, null, false);
            $reqDoc->loadXML($xml);
            $child = $reqDoc->firstChild;
            if ($child)
            {
                $child->setAttribute('requestId', $key);
                $element = $visitor->document->importNode($child, true);                
                $batchNode->appendChild($element);
            }
        }

        $visitor->document->appendChild($batchNode);
    }

    public function execute(ClientInterface $client)
    {
    }
}
