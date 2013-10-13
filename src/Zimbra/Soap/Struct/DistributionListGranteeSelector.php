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
use Zimbra\Soap\Enum\DistributionListGranteeBy as GranteeBy;
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
     * @var GranteeType
     */
    private $_type;

    /**
     * Selects meaning of {dl-grantee-key}
     * @var GranteeBy
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
     * @param GranteeBy $by
     * @param string $value
     * @return self
     */
    public function __construct(GranteeType $type, GranteeBy $by, $value = null)
    {
        $this->_type = $type;
        $this->_by = $by;
        $this->_value = trim($value);
    }

    /**
     * Gets or sets type
     *
     * @param  GranteeType $type
     * @return GranteeType|self
     */
    public function type(GranteeType $type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        $this->_type = $type;
        return $this;
    }

    /**
     * Gets or sets by
     *
     * @param  GranteeBy $by
     * @return GranteeBy|self
     */
    public function by(GranteeBy $by = null)
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
    public function toArray($name = 'grantee')
    {
        $name = !empty($name) ? $name : 'grantee';
        $arr = array(
            'type' => (string) $this->_type,
            'by' => (string) $this->_by,
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
        $xml->addAttribute('type', (string) $this->_type)
            ->addAttribute('by', (string) $this->_by);
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
