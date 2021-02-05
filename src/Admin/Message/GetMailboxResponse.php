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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\MailboxWithMailboxId as Mailbox;
use Zimbra\Soap\ResponseInterface;

/**
 * GetMailboxResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetMailboxResponse")
 */
class GetMailboxResponse implements ResponseInterface
{
    /**
     * Information about mailbox
     * @Accessor(getter="getMbox", setter="setMbox")
     * @SerializedName("mbox")
     * @Type("Zimbra\Admin\Struct\MailboxWithMailboxId")
     * @XmlElement
     */
    private $mbox;

    /**
     * Constructor method for GetMailboxResponse
     *
     * @param Mailbox $mbox
     * @return self
     */
    public function __construct(Mailbox $mbox)
    {
        $this->setMbox($mbox);
    }

    /**
     * Gets the mailbox
     *
     * @return Mailbox
     */
    public function getMbox(): Mailbox
    {
        return $this->mbox;
    }

    /**
     * Sets mailbox
     *
     * @param  Mailbox $mbox
     * @return self
     */
    public function setMbox(Mailbox $mbox): self
    {
        $this->mbox = $mbox;
        return $this;
    }
}