<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\FreeBusyStatus;

/**
 * FreeBusyUserStatus class
 * Free/Busy user status
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FreeBusyUserStatus
{
    /**
     * Email address for a user who has a conflict with the instance
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private string $name;

    /**
     * Free/Busy status - B|T|O (Busy, Tentative or Out-of-office)
     *
     * @var FreeBusyStatus
     */
    #[Accessor(getter: "getFreebusyStatus", setter: "setFreebusyStatus")]
    #[SerializedName("fb")]
    #[XmlAttribute]
    private FreeBusyStatus $freebusyStatus;

    /**
     * Constructor
     *
     * @param  string $name
     * @param  FreeBusyStatus $freebusyStatus
     * @return self
     */
    public function __construct(
        string $name = "",
        ?FreeBusyStatus $freebusyStatus = null
    ) {
        $this->setName($name)->setFreebusyStatus(
            $freebusyStatus ?? FreeBusyStatus::FREE
        );
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get freebusyStatus
     *
     * @return FreeBusyStatus
     */
    public function getFreebusyStatus(): FreeBusyStatus
    {
        return $this->freebusyStatus;
    }

    /**
     * Set freebusyStatus
     *
     * @param  FreeBusyStatus $freebusyStatus
     * @return self
     */
    public function setFreebusyStatus(FreeBusyStatus $freebusyStatus): self
    {
        $this->freebusyStatus = $freebusyStatus;
        return $this;
    }
}
