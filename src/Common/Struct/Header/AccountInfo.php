<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct\Header;

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlValue
};
use Zimbra\Common\Enum\AccountBy;

/**
 * AccountInfo struct class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AccountInfo
{
    /**
     * Account by
     *
     * @var AccountBy
     */
    #[Accessor(getter: "getBy", setter: "setBy")]
    #[SerializedName("by")]
    #[XmlAttribute]
    private AccountBy $by;

    /**
     * Mountpoint traversed
     *
     * @var bool
     */
    #[
        Accessor(
            getter: "getMountpointTraversed",
            setter: "setMountpointTraversed"
        )
    ]
    #[SerializedName("link")]
    #[Type("bool")]
    #[XmlAttribute]
    private $mountpointTraversed;

    /**
     * Value
     *
     * @var string
     */
    #[Accessor(getter: "getValue", setter: "setValue")]
    #[Type("string")]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Constructor
     *
     * @param  AccountBy $by
     * @param  string $value
     * @param  bool $mountpointTraversed
     * @return self
     */
    public function __construct(
        ?AccountBy $by = null,
        ?string $value = null,
        ?bool $mountpointTraversed = null
    ) {
        $this->setBy($by ?? AccountBy::NAME);
        if (null !== $value) {
            $this->setValue($value);
        }
        if (null !== $mountpointTraversed) {
            $this->setMountpointTraversed($mountpointTraversed);
        }
    }

    /**
     * Get account by
     *
     * @return AccountBy
     */
    public function getBy(): AccountBy
    {
        return $this->by;
    }

    /**
     * Set account by enum
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
     * Get mountpoint traversed
     *
     * @return bool
     */
    public function getMountpointTraversed(): ?bool
    {
        return $this->mountpointTraversed;
    }

    /**
     * Set mountpoint traversed
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
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
