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
use Zimbra\Admin\Struct\MailboxByAccountIdSelector as Mailbox;
use Zimbra\Soap\Request;

/**
 * DeleteMailboxRequest class
 * Delete a mailbox
 * The request includes the account ID (uuid) of the target mailbox on success, the response includes the mailbox
 * ID (numeric) of the deleted mailbox the mbox element is left out of the response if no mailbox existed
 * for that account.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="DeleteMailboxRequest")
 */
class DeleteMailboxRequest extends Request
{
    /**
     * Mailbox
     * @Accessor(getter="getMbox", setter="setMbox")
     * @SerializedName("mbox")
     * @Type("Zimbra\Admin\Struct\MailboxByAccountIdSelector")
     * @XmlElement
     */
    private $mbox;

    /**
     * Constructor method for DeleteMailboxRequest
     * @param  Mailbox $mbox
     * @return self
     */
    public function __construct(Mailbox $mbox = NULL)
    {
        if ($mbox instanceof Mailbox) {
            $this->setMbox($mbox);
        }
    }

    /**
     * Sets the mbox.
     *
     * @return Mailbox
     */
    public function getMbox(): Mailbox
    {
        return $this->mbox;
    }

    /**
     * Sets the mbox.
     *
     * @param  Mailbox $mbox
     * @return self
     */
    public function setMbox(Mailbox $mbox): self
    {
        $this->mbox = $mbox;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof DeleteMailboxEnvelope)) {
            $this->envelope = new DeleteMailboxEnvelope(
                new DeleteMailboxBody($this)
            );
        }
    }
}
