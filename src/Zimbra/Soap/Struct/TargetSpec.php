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

use Zimbra\Soap\Enum\AccountBy;
use Zimbra\Soap\Enum\TargetType;
use Zimbra\Utils\SimpleXML;

/**
 * TargetSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TargetSpec
{
    /**
     * Target type
     * @var TargetType
     */
    private $_type;

    /**
     * Select the meaning of {target-selector-key}
     * @var AccountBy
     */
    private $_by;

    /**
     * The key used to identify the target
     * @var string
     */
    private $_value;

    /**
     * Constructor method for AccountACEInfo
     * @param TargetType $type
     * @param AccountBy $by
     * @param string $value
     * @return self
     */
    public function __construct(
        TargetType $type,
        AccountBy $by,
        $value = null
    )
    {
        $this->_type = $type;
        $this->_by = $by;

        $this->_value = trim($value);
    }

    /**
     * Gets or sets type
     *
     * @param  TargetType $type
     * @return TargetType|self
     */
    public function type(TargetType $type = null)
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
     * @param  AccountBy $by
     * @return AccountBy|self
     */
    public function by(AccountBy $by = null)
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
    public function toArray($name = 'target')
    {
        $name = !empty($name) ? $name : 'target';
        $arr = array(
            'type' => (string) $this->_type,
            'by' => (string) $this->_by,
            '_' => $this->_value,
        );

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'target')
    {
        $name = !empty($name) ? $name : 'target';
        $xml = new SimpleXML('<'.$name.'>'.$this->_value.'</'.$name.'>');
        $xml->addAttribute('type', (string) $this->_type)
            ->addAttribute('by', (string) $this->_by);
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
