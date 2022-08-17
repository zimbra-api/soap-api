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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Mail\Struct\ModifyContactSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ModifyContactRequest class
 * Modify Contact
 * When modifying tags, all specified tags are set and all others are unset.  If tn="{tag-names}" is NOT specified
 * then any existing tags will remain set.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyContactRequest extends SoapRequest
{
    /**
     * If set, all attrs and group members in the specified contact are replaced with
     * specified attrs and group members, otherwise the attrs and group members are merged with the existing contact.
     * Unset by default.
     * 
     * @Accessor(getter="getReplace", setter="setReplace")
     * @SerializedName("replace")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getReplace', setter: 'setReplace')]
    #[SerializedName(name: 'replace')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $replace;

    /**
     * If unset, the returned <cn> is just a placeholder containing the contact ID
     * (i.e. <cn id="{id}">). {verbose} is set by default.
     * 
     * @Accessor(getter="getVerbose", setter="setVerbose")
     * @SerializedName("verbose")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getVerbose', setter: 'setVerbose')]
    #[SerializedName(name: 'verbose')]
    #[Type(name: 'bool')]
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
    #[Accessor(getter: 'getWantImapUid', setter: 'setWantImapUid')]
    #[SerializedName(name: 'wantImapUid')]
    #[Type(name: 'bool')]
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
    #[Accessor(getter: 'getWantModifiedSequence', setter: 'setWantModifiedSequence')]
    #[SerializedName(name: 'wantModSeq')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $wantModifiedSequence;

    /**
     * Specification of contact modifications
     * 
     * @Accessor(getter="getContact", setter="setContact")
     * @SerializedName("cn")
     * @Type("Zimbra\Mail\Struct\ModifyContactSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ModifyContactSpec
     */
    #[Accessor(getter: "getContact", setter: "setContact")]
    #[SerializedName(name: 'cn')]
    #[Type(name: ModifyContactSpec::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $contact;

    /**
     * Constructor
     *
     * @param  ModifyContactSpec $contact
     * @param  bool $replace
     * @param  bool $verbose
     * @param  bool $wantImapUid
     * @param  bool $wantModifiedSequence
     * @return self
     */
    public function __construct(
        ModifyContactSpec $contact,
        ?bool $replace = NULL,
        ?bool $verbose = NULL,
        ?bool $wantImapUid = NULL,
        ?bool $wantModifiedSequence = NULL
    )
    {
        $this->setContact($contact);
        if (NULL !== $replace) {
            $this->setReplace($replace);
        }
        if (NULL !== $verbose) {
            $this->setVerbose($verbose);
        }
        if (NULL !== $wantImapUid) {
            $this->setWantImapUid($wantImapUid);
        }
        if (NULL !== $wantModifiedSequence) {
            $this->setWantModifiedSequence($wantModifiedSequence);
        }
    }

    /**
     * Set replace
     *
     * @param  bool $replace
     * @return self
     */
    public function setReplace(bool $replace): self
    {
        $this->replace = $replace;
        return $this;
    }

    /**
     * Get replace
     *
     * @return bool
     */
    public function getReplace(): ?bool
    {
        return $this->replace;
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
     * @return ModifyContactSpec
     */
    public function getContact(): ModifyContactSpec
    {
        return $this->contact;
    }

    /**
     * Set contact
     *
     * @param  ModifyContactSpec $contact
     * @return self
     */
    public function setContact(ModifyContactSpec $contact): self
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ModifyContactEnvelope(
            new ModifyContactBody($this)
        );
    }
}
