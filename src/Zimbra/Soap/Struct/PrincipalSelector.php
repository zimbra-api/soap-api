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

use Zimbra\Soap\Enum\AutoProvPrincipalBy as PrincipalBy;
use Zimbra\Utils\SimpleXML;

/**
 * PrincipalSelector class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class PrincipalSelector
{
    /**
     * Select the meaning of {acct-selector-key}
     * Valid values: dn|name
     * - use : required
     * @var string
     */
    private $_by;

    /**
     * Specifies the account to authenticate against
     * @var string
     */
    private $_value;

    /**
     * Constructor method for PrincipalSelector
     * @param  string $by
     * @param  string $value
     * @return self
     */
    public function __construct($by, $value = null)
    {
        if(PrincipalBy::isValid(trim($by)))
        {
            $this->_by = trim($by);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid principal by');
        }
        $this->_value = trim($value);
    }

    /**
     * Gets or sets by
     *
     * @param  string $by
     * @return string|self
     */
    public function by($by = null)
    {
        if(null === $by)
        {
            return $this->_by;
        }
        if(PrincipalBy::isValid(trim($by)))
        {
            $this->_by = trim($by);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid principal by');
        }
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
    public function toArray($name = 'principal')
    {
        $name = !empty($name) ? $name : 'principal';
        $arr = array(
            'by' => $this->_by,
            '_' => $this->_value,
        );
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'principal')
    {
        $name = !empty($name) ? $name : 'principal';
        $xml = new SimpleXML('<'.$name.'>'.$this->_value.'</'.$name.'>');
        $xml->addAttribute('by', $this->_by);
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
