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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\AclType;

/**
 * ZimletAcl struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ZimletAcl
{
    /**
     * Name of Class Of Service (COS)
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("string")
     * @XmlAttribute
     */
    private $cos;

    /**
     * ACL
     * @Accessor(getter="getAcl", setter="setAcl")
     * @SerializedName("acl")
     * @Type("Zimbra\Common\Enum\AclType")
     * @XmlAttribute
     */
    private ?AclType $acl = NULL;

    /**
     * Constructor method for ZimletAcl
     * @param  string $cos
     * @param  AclType $acl
     * @return self
     */
    public function __construct(?string $cos = NULL, ?AclType $acl = NULL)
    {
        if (NULL !== $cos) {
            $this->setCos($cos);
        }
        if (NULL !== $acl) {
            $this->setAcl($acl);
        }
    }

    /**
     * Get the cos
     *
     * @return string
     */
    public function getCos(): ?string
    {
        return $this->cos;
    }

    /**
     * Set the cos
     *
     * @param  string $cos
     * @return self
     */
    public function setCos(string $cos): self
    {
        $this->cos = $cos;
        return $this;
    }

    /**
     * Get the acl
     *
     * @return AclType
     */
    public function getAcl(): ?AclType
    {
        return $this->acl;
    }

    /**
     * Set the acl
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
