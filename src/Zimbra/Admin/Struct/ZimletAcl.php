<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\AclType;

/**
 * ZimletAcl struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
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
    private $cos;

    /**
     * @Accessor(getter="getAcl", setter="setAcl")
     * @SerializedName("acl")
     * @Type("Zimbra\Enum\AclType")
     * @XmlAttribute
     */
    private $acl;

    /**
     * Constructor method for ZimletAcl
     * @param  string $cos Name of Class Of Service (COS)
     * @param  AclType $acl ACL
     * @return self
     */
    public function __construct($cos = NULL, AclType $acl = NULL)
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
    public function getCos(): string
    {
        return $this->cos;
    }

    /**
     * Sets the cos
     *
     * @param  string $cos
     * @return self
     */
    public function setCos($cos): self
    {
        $this->cos = trim($cos);
        return $this;
    }

    /**
     * Gets the acl
     *
     * @return AclType
     */
    public function getAcl(): AclType
    {
        return $this->acl;
    }

    /**
     * Sets the acl
     *
     * @param  AclType $acl
     * @return self
     */
    public function setAcl(AclType $acl): self
    {
        $this->acl = $acl;
        return $this;
    }
}
