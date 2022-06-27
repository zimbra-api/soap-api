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
use Zimbra\Soap\ResponseInterface;

/**
 * RecalculateMailboxCountsResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RecalculateMailboxCountsResponse implements ResponseInterface
{
    /**
     * Information about mailbox quotas
     * @Accessor(getter="getMailbox", setter="setMailbox")
     * @SerializedName("mbox")
     * @Type("Zimbra\Admin\Struct\MailboxQuotaInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private Mailbox $mailbox;

    /**
     * Constructor method for RecalculateMailboxCountsResponse
     *
     * @param Mailbox $mailbox
     * @return self
     */
    public function __construct(Mailbox $mailbox)
    {
        $this->setMailbox($mailbox);
    }

    /**
     * Gets the mailbox
     *
     * @return Mailbox
     */
    public function getMailbox(): Mailbox
    {
        return $this->mailbox;
    }

    /**
     * Sets mailbox
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
