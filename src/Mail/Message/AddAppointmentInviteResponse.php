<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\SoapResponse;

/**
 * AddAppointmentInviteResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AddAppointmentInviteResponse extends SoapResponse
{
    /**
     * Calendar item ID
     *
     * @var int
     */
    #[Accessor(getter: "getCalItemId", setter: "setCalItemId")]
    #[SerializedName("calItemId")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $calItemId = null;

    /**
     * Invite ID of the added invite
     *
     * @var int
     */
    #[Accessor(getter: "getInvId", setter: "setInvId")]
    #[SerializedName("invId")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $invId = null;

    /**
     * Component number of the added invite
     *
     * @var int
     */
    #[Accessor(getter: "getComponentNum", setter: "setComponentNum")]
    #[SerializedName("compNum")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $componentNum = null;

    /**
     * Constructor
     *
     * @param  int $calItemId
     * @param  int $invId
     * @param  int $componentNum
     * @return self
     */
    public function __construct(
        ?int $calItemId = null,
        ?int $invId = null,
        ?int $componentNum = null
    ) {
        if (null !== $calItemId) {
            $this->setCalItemId($calItemId);
        }
        if (null !== $invId) {
            $this->setInvId($invId);
        }
        if (null !== $componentNum) {
            $this->setComponentNum($componentNum);
        }
    }

    /**
     * Get calItemId
     *
     * @return int
     */
    public function getCalItemId(): ?int
    {
        return $this->calItemId;
    }

    /**
     * Set calItemId
     *
     * @param  int $calItemId
     * @return self
     */
    public function setCalItemId(int $calItemId): self
    {
        $this->calItemId = $calItemId;
        return $this;
    }

    /**
     * Get invId
     *
     * @return int
     */
    public function getInvId(): ?int
    {
        return $this->invId;
    }

    /**
     * Set invId
     *
     * @param  int $invId
     * @return self
     */
    public function setInvId(int $invId): self
    {
        $this->invId = $invId;
        return $this;
    }

    /**
     * Get componentNum
     *
     * @return int
     */
    public function getComponentNum(): ?int
    {
        return $this->componentNum;
    }

    /**
     * Set componentNum
     *
     * @param  int $componentNum
     * @return self
     */
    public function setComponentNum(int $componentNum): self
    {
        $this->componentNum = $componentNum;
        return $this;
    }
}
