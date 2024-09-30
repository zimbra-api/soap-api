<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Mail\Struct\ContactSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CreateContactRequest class
 * Create a contact
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateContactRequest extends SoapRequest
{
    /**
     * If set (defaults to unset) The returned <cn> is just a placeholder
     * containing the new contact ID (i.e. <cn id="{id}"/>)
     *
     * @Accessor(getter="getVerbose", setter="setVerbose")
     * @SerializedName("verbose")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getVerbose", setter: "setVerbose")]
    #[SerializedName("verbose")]
    #[Type("bool")]
    #[XmlAttribute]
    private $verbose;

    /**
     * Set to return IMAP UID.  (default is unset.)
     *
     * @Accessor(getter="getWantImapUid", setter="setWantImapUid")
     * @SerializedName("wantImapUid")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getWantImapUid", setter: "setWantImapUid")]
    #[SerializedName("wantImapUid")]
    #[Type("bool")]
    #[XmlAttribute]
    private $wantImapUid;

    /**
     * Set to return Modified Sequence.  (default is unset.)
     *
     * @Accessor(getter="getWantModifiedSequence", setter="setWantModifiedSequence")
     * @SerializedName("wantModSeq")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[
        Accessor(
            getter: "getWantModifiedSequence",
            setter: "setWantModifiedSequence"
        )
    ]
    #[SerializedName("wantModSeq")]
    #[Type("bool")]
    #[XmlAttribute]
    private $wantModifiedSequence;

    /**
     * Contact specification
     *
     * @Accessor(getter="getContact", setter="setContact")
     * @SerializedName("cn")
     * @Type("Zimbra\Mail\Struct\ContactSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var ContactSpec
     */
    #[Accessor(getter: "getContact", setter: "setContact")]
    #[SerializedName("cn")]
    #[Type(ContactSpec::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ContactSpec $contact;

    /**
     * Constructor
     *
     * @param  ContactSpec $contact
     * @param  bool $verbose
     * @param  bool $wantImapUid
     * @param  bool $wantModifiedSequence
     * @return self
     */
    public function __construct(
        ContactSpec $contact,
        ?bool $verbose = null,
        ?bool $wantImapUid = null,
        ?bool $wantModifiedSequence = null
    ) {
        $this->setContact($contact);
        if (null !== $verbose) {
            $this->setVerbose($verbose);
        }
        if (null !== $wantImapUid) {
            $this->setWantImapUid($wantImapUid);
        }
        if (null !== $wantModifiedSequence) {
            $this->setWantModifiedSequence($wantModifiedSequence);
        }
    }

    /**
     * Set wantImapUid
     *
     * @param  bool $wantImapUid
     * @return self
     */
    public function setWantImapUid(bool $wantImapUid): self
    {
        $this->wantImapUid = $wantImapUid;
        return $this;
    }

    /**
     * Get wantImapUid
     *
     * @return bool
     */
    public function getWantImapUid(): ?bool
    {
        return $this->wantImapUid;
    }

    /**
     * Set wantModifiedSequence
     *
     * @param  bool $wantModifiedSequence
     * @return self
     */
    public function setWantModifiedSequence(bool $wantModifiedSequence): self
    {
        $this->wantModifiedSequence = $wantModifiedSequence;
        return $this;
    }

    /**
     * Get wantModifiedSequence
     *
     * @return bool
     */
    public function getWantModifiedSequence(): ?bool
    {
        return $this->wantModifiedSequence;
    }

    /**
     * Get verbose
     *
     * @return bool
     */
    public function getVerbose(): ?bool
    {
        return $this->verbose;
    }

    /**
     * Set verbose
     *
     * @param  bool $verbose
     * @return self
     */
    public function setVerbose(bool $verbose): self
    {
        $this->verbose = $verbose;
        return $this;
    }

    /**
     * Get contact
     *
     * @return ContactSpec
     */
    public function getContact(): ContactSpec
    {
        return $this->contact;
    }

    /**
     * Set contact
     *
     * @param  ContactSpec $contact
     * @return self
     */
    public function setContact(ContactSpec $contact): self
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CreateContactEnvelope(new CreateContactBody($this));
    }
}
