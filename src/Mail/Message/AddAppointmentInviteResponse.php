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
     * @Accessor(getter="getCalItemId", setter="setCalItemId")
     * @SerializedName("calItemId")
     * @Type("integer")
     * @XmlAttribute
     */
    private $calItemId;

    /**
     * Invite ID of the added invite
     * @Accessor(getter="getInvId", setter="setInvId")
     * @SerializedName("invId")
     * @Type("integer")
     * @XmlAttribute
     */
    private $invId;

    /**
     * Component number of the added invite
     * @Accessor(getter="getComponentNum", setter="setComponentNum")
     * @SerializedName("compNum")
     * @Type("integer")
     * @XmlAttribute
     */
    private $componentNum;

    /**
     * Constructor method for AddAppointmentInviteResponse
     *
     * @param  int $calItemId
     * @param  int $invId
     * @param  int $componentNum
     * @return self
     */
    public function __construct(
        ?int $calItemId = NULL, ?int $invId = NULL, ?int $componentNum = NULL
    )
    {
        if (NULL !== $calItemId) {
            $this->setCalItemId($calItemId);
        }
        if (NULL !== $invId) {
            $this->setInvId($invId);
        }
        if (NULL !== $componentNum) {
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
