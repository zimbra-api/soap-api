<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Soap\Enum\DomainBy;
use Zimbra\Utils\SimpleXML;

/**
 * DomainSelector class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DomainSelector
{
    /**
     * Select the meaning of {acct-selector-key}
     * Valid values: id|name|virtualHostname|krb5Realm|foreignName
     * @var DomainBy
     */
    private $_by;

    /**
     * Specifies the account to authenticate against
     * @var string
     */
    private $_value;

    /**
     * Constructor method for DomainSelector
     * @param  DomainBy $by
     * @param  string $value
     * @return self
     */
    public function __construct(DomainBy $by, $value = null)
    {
        $this->_by = $by;
        $this->_value = trim($value);
    }

    /**
     * Gets or sets by
     *
     * @param  DomainBy $by
     * @return DomainBy|self
     */
    public function by(DomainBy $by = null)
    {
        if(null === $by)
        {
            return $this->_by;
        }
        $this->_by = $by;
        return $this;
    }

    /**
     * Gets or sets value
     *
     * @param  string $value
     * @return string|self
     */
    public function value($value = null)
    {
        if(null === $value)
        {
            return $this->_value;
        }
        $this->_value = trim($value);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'domain')
    {
        $name = !empty($name) ? $name : 'domain';
        return array($name => array(
            'by' => (string) $this->_by,
            '_' => $this->_value,
        ));
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'domain')
    {
        $name = !empty($name) ? $name : 'domain';
        $xml = new SimpleXML('<'.$name.'>'.$this->_value.'</'.$name.'>');
        $xml->addAttribute('by', (string) $this->_by);
        return $xml;
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
