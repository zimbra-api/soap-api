<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\XmlValue;

use Zimbra\Enum\DomainBy;

/**
 * DomainSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="domain")
 */
class DomainSelector
{
    /**
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("string")
     * @XmlAttribute
     */
    private $_by;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $_value;

    /**
     * Constructor method for DomainSelector
     * @param  string $by Select the meaning of {acct-selector-key}
     * @param  string $value The key used to identify the domain
     * @return self
     */
    public function __construct($by, $value = null)
    {
        $this->setBy($by);
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets by enum
     *
     * @return string
     */
    public function getBy()
    {
        return $this->_by;
    }

    /**
     * Sets by enum
     *
     * @param  string $by
     * @return self
     */
    public function setBy($by)
    {
        if (DomainBy::has(trim($by))) {
            $this->_by = $by;
        }
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * Sets value
     *
     * @param  string $name
     * @return self
     */
    public function setValue($value)
    {
        $this->_value = trim($value);
        return $this;
    }
}
