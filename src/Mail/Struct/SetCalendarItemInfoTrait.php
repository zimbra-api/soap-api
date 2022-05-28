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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

use Zimbra\Common\Enum\ParticipationStatus;

/**
 * SetCalendarItemInfoTrait trait
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
trait SetCalendarItemInfoTrait
{
    /**
     * iCalendar PTST (Participation status)
     * Valid values: <b>NE|AC|TE|DE|DG|CO|IN|WE|DF</b>
     * Meanings:
     * "NE"eds-action, "TE"ntative, "AC"cept, "DE"clined, "DG" (delegated), "CO"mpleted (todo), "IN"-process (todo),
     * "WA"iting (custom value only for todo), "DF" (deferred; custom value only for todo)
     * @Accessor(getter="getPartStat", setter="setPartStat")
     * @SerializedName("ptst")
     * @Type("Zimbra\Common\Enum\ParticipationStatus")
     * @XmlAttribute
     */
    private ?ParticipationStatus $partStat = NULL;

    /**
     * Message
     * @Accessor(getter="getMsg", setter="setMsg")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\Msg")
     * @XmlElement
     */
    private ?Msg $msg = NULL;

    /**
     * Constructor method
     *
     * @param  ParticipationStatus $partStat
     * @param  Msg $msg
     * @return self
     */
    public function __construct(
        ?ParticipationStatus $partStat = NULL, ?Msg $msg = NULL
    )
    {
        if ($partStat instanceof ParticipationStatus) {
            $this->setPartStat($partStat);
        }
        if ($msg instanceof Msg) {
            $this->setMsg($msg);
        }
    }

    /**
     * Gets partStat
     *
     * @return ParticipationStatus
     */
    public function getPartStat(): ?ParticipationStatus
    {
        return $this->partStat;
    }

    /**
     * Sets partStat
     *
     * @param  ParticipationStatus $partStat
     * @return self
     */
    public function setPartStat(ParticipationStatus $partStat): self
    {
        $this->partStat = $partStat;
        return $this;
    }

    /**
     * Gets msg
     *
     * @return Msg
     */
    public function getMsg(): ?Msg
    {
        return $this->msg;
    }

    /**
     * Sets msg
     *
     * @param  Msg $msg
     * @return self
     */
    public function setMsg(Msg $msg): self
    {
        $this->msg = $msg;
        return $this;
    }
}
