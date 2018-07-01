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

use Zimbra\Enum\AclType;

/**
 * ZimletAcl struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="acl")
 */
class ZimletAcl
{
    /**
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("string")
     * @XmlAttribute
     */
    private $_cos;

    /**
     * @Accessor(getter="getAcl", setter="setAcl")
     * @SerializedName("acl")
     * @Type("string")
     * @XmlAttribute
     */
    private $_acl;

    /**
     * Constructor method for ZimletAcl
     * @param  string $cos Name of Class Of Service (COS)
     * @param  string $acl ACL
     * @return self
     */
    public function __construct($cos = NULL, $acl = NULL)
    {
        if (NULL !== $cos) {
            $this->setCos($cos);
        }
        if (NULL !== $acl) {
            $this->setAcl($acl);
        }
    }

    /**
     * Gets the cos
     *
     * @return string
     */
    public function getCos()
    {
        return $this->_cos;
    }

    /**
     * Sets the cos
     *
     * @param  string $cos
     * @return self
     */
    public function setCos($cos)
    {
        $this->_cos = trim($cos);
        return $this;
    }

    /**
     * Gets the acl
     *
     * @return string
     */
    public function getAcl()
    {
        return $this->_acl;
    }

    /**
     * Sets the acl
     *
     * @param  string $acl
     * @return self
     */
    public function setAcl($acl)
    {
        if (AclType::has(trim($acl))) {
            $this->_acl = trim($acl);
        }
        return $this;
    }
}
