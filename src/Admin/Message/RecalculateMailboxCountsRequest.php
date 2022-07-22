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
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * RecalculateMailboxCountsRequest class
 * Recalculate Mailbox counts.
 * Forces immediate recalculation of total mailbox quota usage and all folder unread and size counts
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RecalculateMailboxCountsRequest extends Request
{
    /**
     * Mailbox selector
     * @Accessor(getter="getMbox", setter="setMbox")
     * @SerializedName("mbox")
     * @Type("Zimbra\Admin\Struct\MailboxByAccountIdSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?Mailbox $mbox = NULL;

    /**
     * Constructor method for RecalculateMailboxCountsRequest
     *
     * @param  Mailbox $mbox
     * @return self
     */
    public function __construct(?Mailbox $mbox = NULL)
    {
        if ($mbox instanceof Mailbox) {
            $this->setMbox($mbox);
        }
    }

    /**
     * Gets zimbra mbox
     *
     * @return MailboxByAccountIdSelector
     */
    public function getMbox(): ?Mailbox
    {
        return $this->mbox;
    }

    /**
     * Sets zimbra mbox
     *
     * @param  MailboxByAccountIdSelector $mbox
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
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new RecalculateMailboxCountsEnvelope(
            new RecalculateMailboxCountsBody($this)
        );
    }
}
