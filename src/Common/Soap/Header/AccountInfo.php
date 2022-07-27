<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Soap\Header;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\AccountBy;

/**
 * AccountInfo struct class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Soap
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AccountInfo
{
    /**
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Zimbra\Common\Enum\AccountBy")
     * @XmlAttribute
     */
    private AccountBy $by;

    /**
     * @Accessor(getter="getMountpointTraversed", setter="setMountpointTraversed")
     * @SerializedName("link")
     * @Type("boolean")
     * @XmlAttribute
     */
    private $mountpointTraversed;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for AccountInfo
     * @param  AccountBy $by
     * @param  string $value
     * @param  bool $mountpointTraversed
     * @return self
     */
    public function __construct(
        ?AccountBy $by = NULL, ?string $value = NULL, ?bool $mountpointTraversed = NULL
    )
    {
        $this->setBy($by ?? AccountBy::NAME());
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if (NULL !== $mountpointTraversed) {
            $this->setMountpointTraversed($mountpointTraversed);
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