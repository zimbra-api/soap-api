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
use Zimbra\Common\Enum\RuntimeSwitchStatus;

/**
 * StoreManagerRuntimeSwitchResult struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class StoreManagerRuntimeSwitchResult
{
    /**
     * Status
     *
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Enum<Zimbra\Common\Enum\RuntimeSwitchStatus>")
     * @XmlAttribute
     *
     * @var RuntimeSwitchStatus
     */
    #[Accessor(getter: "getStatus", setter: "setStatus")]
    #[SerializedName("status")]
    #[Type("Enum<Zimbra\Common\Enum\RuntimeSwitchStatus>")]
    #[XmlAttribute]
    private RuntimeSwitchStatus $status;

    /**
     * Absolute path to root of volume, e.g. /opt/zimbra/store
     *
     * @Accessor(getter="getMessage", setter="setMessage")
     * @SerializedName("message")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getMessage", setter: "setMessage")]
    #[SerializedName("message")]
    #[Type("string")]
    #[XmlAttribute]
    private $message;

    /**
     * Constructor
     *
     * @param  RuntimeSwitchStatus $status
     * @param  string $message
     * @return self
     */
    public function __construct(
        ?RuntimeSwitchStatus $status = null,
        ?string $message = null
    ) {
        $this->setStatus($status ?? new RuntimeSwitchStatus("SUCCESS"));
        if (null !== $message) {
            $this->setMessage($message);
        }
    }

    /**
     * Get status enum
     *
     * @return RuntimeSwitchStatus
     */
    public function getStatus(): RuntimeSwitchStatus
    {
        return $this->status;
    }

    /**
     * Set status enum
     *
     * @param  RuntimeSwitchStatus $status
     * @return self
     */
    public function setStatus(RuntimeSwitchStatus $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Set message
     *
     * @param  string $message
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }
}
