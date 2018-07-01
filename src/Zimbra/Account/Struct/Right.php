<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use Zimbra\Struct\Base;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * Right struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="ace")
 */
class Right
{
    /**
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("string")
     * @XmlAttribute
     */
    private $_right;

    /**
     * Constructor method for Right
     * @param string $right
     * @return self
     */
    public function __construct($right)
    {
        $this->setRight($right);
    }

    /**
     * Gets right
     *
     * @return string
     */
    public function getRight()
    {
        return $this->_right;
    }

    /**
     * Sets right
     *
     * @param  string $right
     * @return self
     */
    public function setRight($right)
    {
        $this->_right = trim($right);
        return $this;
    }
}
