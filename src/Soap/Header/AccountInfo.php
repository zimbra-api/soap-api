<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Header;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot, XmlValue};
use Zimbra\Enum\AccountBy;

/**
 * AccountInfo struct class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="account")
 */
class AccountInfo
{
    /**
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Zimbra\Enum\AccountBy")
     * @XmlAttribute
     */
    private $by;

    /**
     * @Accessor(getter="getMountpointTraversed", setter="setMountpointTraversed")
     * @SerializedName("link")
     * @Type("boolean")
     * @XmlAttribute
     */
    private $mountpointTraversed;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for AccountInfo
     * @param  AccountBy $by
     * @param  bool $mountpointTraversed
     * @param  string $value
     * @return self
     */
    public function __construct(AccountBy $by, ?bool $mountpointTraversed = NULL, ?string $value = NULL)
    {
        $this->setBy($by);
        if (NULL !== $mountpointTraversed) {
            $this->setMountpointTraversed($mountpointTraversed);
        }
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets account by
     *
     * @return AccountBy
     */
    public function getBy(): AccountBy
    {
        return $this->by;
    }

    /**
     * Sets account by enum
     *
     * @param  AccountBy $by
     * @return self
     */
    public function setBy(AccountBy $by): self
    {
        $this->by = $by;
        return $this;
    }

    /**
     * Gets mountpoint traversed
     *
     * @return bool
     */
    public function getMountpointTraversed(): ?bool
    {
        return $this->mountpointTraversed;
    }

    /**
     * Sets mountpoint traversed
     *
     * @param  bool $mountpointTraversed
     * @return self
     */
    public function setMountpointTraversed(bool $mountpointTraversed): self
    {
        $this->mountpointTraversed = $mountpointTraversed;
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $name
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
