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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Admin\Struct\MailboxBlobConsistency;
use Zimbra\Soap\ResponseInterface;

/**
 * CheckBlobConsistencyResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CheckBlobConsistencyResponse implements ResponseInterface
{
    /**
     * Mailboxes
     * 
     * @Accessor(getter="getMailboxes", setter="setMailboxes")
     * @SerializedName("mbox")
     * @Type("array<Zimbra\Admin\Struct\MailboxBlobConsistency>")
     * @XmlList(inline = true, entry = "mbox")
     */
    private $mailboxes = [];

    /**
     * Constructor method for CheckBlobConsistencyResponse
     *
     * @param  array  $mailboxes
     * @return self
     */
    public function __construct(array $mailboxes = [])
    {
        $this->setMailboxes($mailboxes);
    }

    /**
     * Add a mailbox
     *
     * @param  MailboxBlobConsistency $mailbox
     * @return self
     */
    public function addMailbox(MailboxBlobConsistency $mailbox): self
    {
        $this->mailboxes[] = $mailbox;
        return $this;
    }

    /**
     * Sets mailbox array
     *
     * @param  array $mailboxes
     * @return self
     */
    public function setMailboxes(array $mailboxes): self
    {
        $this->mailboxes = array_filter($mailboxes, static fn ($mailbox) => $mailbox instanceof MailboxBlobConsistency);
        return $this;
    }

    /**
     * Gets mailbox array
     *
     * @return array
     */
    public function getMailboxes(): array
    {
        return $this->mailboxes;
    }
}
