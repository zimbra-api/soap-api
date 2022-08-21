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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DeleteMailboxRequest extends SoapRequest
{
    /**
     * Mailbox
     * 
     * @Accessor(getter="getMbox", setter="setMbox")
     * @SerializedName("mbox")
     * @Type("Zimbra\Admin\Struct\MailboxByAccountIdSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var Mailbox
     */
    #[Accessor(getter: 'getMbox', setter: 'setMbox')]
    #[SerializedName('mbox')]
    #[Type(Mailbox::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?Mailbox $mbox;

    /**
     * Constructor
     * 
     * @param  Mailbox $mbox
     * @return self
     */
    public function __construct(?Mailbox $mbox = NULL)
    {
        $this->mbox = $mbox;
    }

    /**
     * Set the mbox.
     *
     * @return Mailbox
     */
    public function getMbox(): ?Mailbox
    {
        return $this->mbox;
    }

    /**
     * Set the mbox.
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
        return new DeleteMailboxEnvelope(
            new DeleteMailboxBody($this)
        );
    }
}
