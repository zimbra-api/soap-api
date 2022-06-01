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
use Zimbra\Admin\Struct\MailboxByAccountIdSelector as Mailbox;
use Zimbra\Soap\Request;

/**
 * GetMailboxRequest request class
 * Get a Mailbox
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetMailboxRequest extends Request
{
    /**
     * Mailbox selector
     * @Accessor(getter="getMbox", setter="setMbox")
     * @SerializedName("mbox")
     * @Type("Zimbra\Admin\Struct\MailboxByAccountIdSelector")
     * @XmlElement
     */
    private ?Mailbox $mbox = NULL;

    /**
     * Constructor method for GetMailboxRequest
     *
     * @param  Mailbox $mbox
     * @return self
     */
    public function __construct(
        ?Mailbox $mbox = NULL
    )
    {
        if ($mbox instanceof Mailbox) {
            $this->setMbox($mbox);
        }
    }

    /**
     * Gets the mbox.
     *
     * @return Mailbox
     */
    public function getMbox(): ?Mailbox
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
        if (!($this->envelope instanceof GetMailboxEnvelope)) {
            $this->envelope = new GetMailboxEnvelope(
                new GetMailboxBody($this)
            );
        }
    }
}
