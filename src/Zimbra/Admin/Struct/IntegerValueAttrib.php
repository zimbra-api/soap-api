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

/**
 * IntegerValueAttrib struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="a")
 */
class IntegerValueAttrib
{
    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("value")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_value;

    /**
     * Constructor method for IntegerValueAttrib
     * @param  int $value
     * @return self
     */
    public function __construct($value = NULL)
    {
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets value
     *
     * @return int
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * Sets value
     *
     * @param  int $value
     * @return self
     */
    public function setValue($value)
    {
        $this->_value = (int) $value;
        return $this;
    }
}
