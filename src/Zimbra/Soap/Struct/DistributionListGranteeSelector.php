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

use Zimbra\Soap\Enum\GranteeType;
use Zimbra\Soap\Enum\DistributionListGranteeBy;
use Zimbra\Utils\SimpleXML;

/**
 * DistributionListGranteeSelector class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DistributionListGranteeSelector
{
    /**
     * Grantee type
     * - use : required
     * @var GranteeType
     */
    private $_type;

    /**
     * Selects meaning of {dl-grantee-key}
     * - use : required
     * @var LDGranteeBy
     */
    private $_by;

    /**
     * Value of selector
     * @var string
     */
    private $_value;

    /**
     * Constructor method for DistributionListGranteeSelector
     * @param GranteeType $type
     * @param DistributionListGranteeBy $by
     * @param string $value
     * @return self
     */
    public function __construct($type, $by, $value = null)
    {
        if(GranteeType::isValid(trim($type)))
        {
            $this->_type = trim($type);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid grantee type');
        }
        if(DistributionListGranteeBy::isValid(trim($by)))
        {
            $this->_by = trim($by);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid grantee by');
        }
        $this->_value = trim($value);
    }

    /**
     * Gets or sets type
     *
     * @param  string $type
     * @return string|self
     */
    public function type($type = null)
    {
        if(null === $type)
        {
            return (string) $this->_type;
        }
        if(GranteeType::isValid(trim($type)))
        {
            $this->_type = trim($type);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid grantee type');
        }
        return $this;
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
            return (string) $this->_by;
        }
        if(DistributionListGranteeBy::isValid(trim($by)))
        {
            $this->_by = trim($by);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid grantee by');
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
    public function toArray($name = 'grantee')
    {
        $name = !empty($name) ? $name : 'grantee';
        $arr = array(
            'type' => $this->_type,
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
    public function toXml($name = 'grantee')
    {
        $name = !empty($name) ? $name : 'grantee';
        $xml = new SimpleXML('<'.$name.'>'.$this->_value.'</'.$name.'>');
        $xml->addAttribute('type', $this->_type)
            ->addAttribute('by', $this->_by);
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
