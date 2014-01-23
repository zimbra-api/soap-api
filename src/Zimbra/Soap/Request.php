<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap;

use Zimbra\Common\SimpleXML;
use Zimbra\Struct\Base;

/**
 * Request class in Zimbra API PHP, not to be instantiated.
 * 
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class Request extends Base
{
    /**
     * The xml request name
     * @var string
     */
    private $_requestName = 'Request';

    /**
     * The xml response name
     * @var string
     */
    private $_responseName = 'Response';

    /**
     * The xml representation of this class
     * @var SimpleXML
     */
    protected $xml;

    /**
     * The array representation of this class 
     * @var array
     */
    protected $array = array();

    /**
     * Request constructor
     */
    public function __construct()
    {
        parent::__construct();
        $ref = new \ReflectionObject($this);
        $this->_requestName = $ref->getShortName() . 'Request';
        $this->_responseName = $ref->getShortName() . 'Response';
        $this->xml = new SimpleXML('<'.$this->_requestName.' />');
    }

    /**
     * Returns the request name
     *
     * @return string
     */
    public function requestName()
    {
        return $this->_requestName;
    }

    /**
     * Returns the response name
     *
     * @return string
     */
    public function responseName()
    {
        return $this->_responseName;
    }

    /**
     * Process soap response body.
     *
     * @param  string $response Soap response message.
     * @throws RuntimeException
     * @return mix
     */
    public function processResponse($response)
    {
        if(empty($response))
        {
            throw new \UnexpectedValueException('Response string is empty.');
        }
        $xml = new SimpleXML($response);
        $fault = $xml->children('soap', true)->Body->Fault;
        if ($fault)
        {
            throw new \RuntimeException($fault->children('soap', true)->Reason->Text);
        }

        $result = $xml->children('soap', true)->Body->toObject();
        $name = $this->_responseName;
        return isset($result->$name) ? $result->$name : null;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  array $array Child array.
     * @return array
     */
    public function toArray($name = null)
    {
        $name = empty($name) ? $this->_requestName : $name;
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml($name = null)
    {
        $name = empty($name) ? $this->_requestName : $name;
        return parent::toXml($name);
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
