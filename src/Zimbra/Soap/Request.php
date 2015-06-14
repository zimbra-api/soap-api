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
     * Request constructor
     *
     * @param  string $value
     * @return self
     */
    public function __construct($value = null)
    {
        parent::__construct($value);
        $className = $this->className();
        $this->_requestName = $className . 'Request';
        $this->_responseName = $className . 'Response';
        $this->setXmlNamespace('urn:zimbra');
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
     * Returns the array representation of this class 
     *
     * @param  string $name
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
     * @param  string $name
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
