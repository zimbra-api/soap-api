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

use Zimbra\Soap\Request;
use Zimbra\Common\SimpleXML;
use Zimbra\Common\TypedSequence;

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
     * Attributes specified as key value pairs
     * @var Sequence
     */
    private $_requests;

    /**
     * Batch request constructor
     * @param  array $requests
     * @return self
     */
    public function __construct(array $requests = [])
    {
        parent::__construct();
        $this->setRequests($requests);
    }

    /**
     * Gets on error
     *
     * @return string
     */
    public function getOnError()
    {
        return $this->getProperty('onerror');
    }

    /**
     * Sets on error
     *
     * @param  string $onerror
     * @return self
     */
    public function setOnError($onerror = 'continue')
    {
        if (!in_array('continue', 'stop'))
        {
            $onerror = 'continue';
        }
        return $this->setProperty('onerror', trim($onerror));
    }

    /**
     * Add a request
     *
     * @param  Request $request
     * @return self
     */
    public function addRequest(Request $request)
    {
        $this->_requests->add($request);
        return $this;
    }

    /**
     * Set request sequence
     *
     * @param  array $requests
     * @return Sequence
     */
    public function setRequests(array $requests)
    {
        $this->_requests = new TypedSequence('Zimbra\Soap\Request', $requests);
        return $this;
    }

    /**
     * Gets request sequence
     *
     * @return Sequence
     */
    public function getRequests()
    {
        return $this->_requests;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = null)
    {
        $name = empty($name) ? $this->requestName() : $name;
        $arr = [
            '_jsns' => $this->getXmlNamespace(),
            'onerror' => $this->getOnError(),
        ];
        foreach ($this->_requests as $key => $request)
        {
            $reqArr = $request->toArray();
            $arr[$request->requestName()] = $reqArr[$request->requestName()];
        }
        return [$this->requestName() => $arr];
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = null)
    {
        $name = empty($name) ? $this->requestName() : $name;
        $xml = new SimpleXML('<'.$name.' />');
        foreach ($this->_requests as $key => $request)
        {
            $requestXml = $request->toXml();
            $requestXml->addAttribute('requestId', $key);
            $xml->append($requestXml, $request->getXmlNamespace());
        }
        return $xml;
    }
}