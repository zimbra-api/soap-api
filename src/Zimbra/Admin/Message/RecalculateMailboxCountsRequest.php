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
 * RecalculateMailboxCountsRequest class
 * Recalculate Mailbox counts.
 * Forces immediate recalculation of total mailbox quota usage and all folder unread and size counts
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="RecalculateMailboxCountsRequest")
 */
class RecalculateMailboxCountsRequest extends Request
{
    /**
     * Mailbox selector
     * @Accessor(getter="getMbox", setter="setMbox")
     * @SerializedName("mbox")
     * @Type("Zimbra\Admin\Struct\MailboxByAccountIdSelector")
     * @XmlElement
     */
    private $mbox;

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
    public function getMbox(): Mailbox
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
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof RecalculateMailboxCountsEnvelope)) {
            $this->envelope = new RecalculateMailboxCountsEnvelope(
                new RecalculateMailboxCountsBody($this)
            );
        }
    }
}
