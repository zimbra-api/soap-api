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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * RecalculateMailboxCountsRequest class
 * Recalculate Mailbox counts.
 * Forces immediate recalculation of total mailbox quota usage and all folder unread and size counts
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RecalculateMailboxCountsRequest extends SoapRequest
{
    /**
     * Mailbox by account id selector
     *
     * @Accessor(getter="getMbox", setter="setMbox")
     * @SerializedName("mbox")
     * @Type("Zimbra\Admin\Struct\MailboxByAccountIdSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var Mailbox
     */
    #[Accessor(getter: "getMbox", setter: "setMbox")]
    #[SerializedName("mbox")]
    #[Type(Mailbox::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?Mailbox $mbox;

    /**
     * Constructor
     *
     * @param  Mailbox $mbox
     * @return self
     */
    public function __construct(?Mailbox $mbox = null)
    {
        $this->mbox = $mbox;
    }

    /**
     * Get zimbra mbox
     *
     * @return Mailbox
     */
    public function getMbox(): ?Mailbox
    {
        return $this->mbox;
    }

    /**
     * Set zimbra mbox
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new RecalculateMailboxCountsEnvelope(
            new RecalculateMailboxCountsBody($this)
        );
    }
}
