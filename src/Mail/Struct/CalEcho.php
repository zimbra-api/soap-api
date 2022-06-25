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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};

/**
 * CalEcho struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CalEcho
{
    /**
     * Invite
     * @Accessor(getter="getInvite", setter="setInvite")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\InviteAsMP")
     * @XmlElement
     */
    private ?InviteAsMP $invite = NULL;

    /**
     * Constructor method
     *
     * @param InviteAsMP $invite
     * @return self
     */
    public function __construct(?InviteAsMP $invite = NULL)
    {
        if ($invite instanceof InviteAsMP) {
            $this->setInvite($invite);
        }
    }

    /**
     * Gets the invite
     *
     * @return InviteAsMP
     */
    public function getInvite(): ?InviteAsMP
    {
        return $this->invite;
    }

    /**
     * Sets the invite
     *
     * @param  InviteAsMP $invite
     * @return self
     */
    public function setInvite(InviteAsMP $invite): self
    {
        $this->invite = $invite;
        return $this;
    }
}
