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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Admin\Struct\MailboxWithMailboxId;
use Zimbra\Soap\ResponseInterface;

/**
 * PurgeMessagesResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class PurgeMessagesResponse implements ResponseInterface
{
    /**
     * Information about mailboxes where aged messages have been purged
     * 
     * @Accessor(getter="getMailboxes", setter="setMailboxes")
     * @SerializedName("mbox")
     * @Type("array<Zimbra\Admin\Struct\MailboxWithMailboxId>")
     * @XmlList(inline = true, entry = "mbox")
     */
    private $mailboxes = [];

    /**
     * Constructor method for PurgeMessagesResponse
     *
     * @param array $mailboxes
     * @return self
     */
    public function __construct(array $mailboxes = [])
    {
        $this->setMailboxes($mailboxes);
    }

    /**
     * Add mailboxes
     *
     * @param  MailboxWithMailboxId $mbox
     * @return self
     */
    public function addMailbox(MailboxWithMailboxId $mbox): self
    {
        $this->mailboxes[] = $mbox;
        return $this;
    }

    /**
     * Sets mailboxes
     *
     * @param  array $mailboxes
     * @return self
     */
    public function setMailboxes(array $mailboxes): self
    {
        $this->mailboxes = [];
        foreach ($mailboxes as $mbox) {
            if ($mbox instanceof MailboxWithMailboxId) {
                $this->mailboxes[] = $mbox;
            }
        }
        return $this;
    }

    /**
     * Gets mailboxes
     *
     * @return array
     */
    public function getMailboxes(): array
    {
        return $this->mailboxes;
    }
}
