<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\MailboxQuotaInfo as Mailbox;
use Zimbra\Common\Struct\SoapResponse;

/**
 * RecalculateMailboxCountsResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RecalculateMailboxCountsResponse extends SoapResponse
{
    /**
     * Information about mailbox quotas
     *
     * @Accessor(getter="getMailbox", setter="setMailbox")
     * @SerializedName("mbox")
     * @Type("Zimbra\Admin\Struct\MailboxQuotaInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var Mailbox
     */
    #[Accessor(getter: "getMailbox", setter: "setMailbox")]
    #[SerializedName("mbox")]
    #[Type(Mailbox::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?Mailbox $mailbox;

    /**
     * Constructor
     *
     * @param Mailbox $mailbox
     * @return self
     */
    public function __construct(?Mailbox $mailbox = null)
    {
        $this->mailbox = $mailbox;
    }

    /**
     * Get the mailbox
     *
     * @return Mailbox
     */
    public function getMailbox(): ?Mailbox
    {
        return $this->mailbox;
    }

    /**
     * Set mailbox
     *
     * @param  Mailbox $mailbox
     * @return self
     */
    public function setMailbox(Mailbox $mailbox): self
    {
        $this->mailbox = $mailbox;
        return $this;
    }
}
