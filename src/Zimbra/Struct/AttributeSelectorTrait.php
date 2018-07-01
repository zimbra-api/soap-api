<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;

/**
 * AttributeSelectorImpl struct trait
 *
 * @package    Zimbra
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
trait AttributeSelectorTrait
{

    /**
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("attrs")
     * @Type("string")
     * @XmlAttribute
     */
    private $_attrs;

    /**
     * Gets attributes
     *
     * @return string
     */
    public function getAttrs()
    {
        return $this->_attrs;
    }

    /**
     * Sets attributes
     *
     * @param  string $attrs
     * @return self
     */
    public function setAttrs($attrs)
    {
        $this->_attrs = trim($attrs);
        return $this;
    }
}
