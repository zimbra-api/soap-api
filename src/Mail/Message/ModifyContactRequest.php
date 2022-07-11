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
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * ModifyContactRequest class
 * Create a contact
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ModifyContactRequest extends Request
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
     */
    private $replace;

    /**
     * If unset, the returned <cn> is just a placeholder containing the contact ID
     * (i.e. <cn id="{id}">). {verbose} is set by default.
     * 
     * @Accessor(getter="getVerbose", setter="setVerbose")
     * @SerializedName("verbose")
     * @Type("bool")
     * @XmlAttribute
     */
    private $verbose;

    /**
     * Set to return IMAP UID.  (default is unset.)
     * 
     * @Accessor(getter="getWantImapUid", setter="setWantImapUid")
     * @SerializedName("wantImapUid")
     * @Type("bool")
     * @XmlAttribute
     */
    private $wantImapUid;

    /**
     * Set to return Modified Sequence.  (default is unset.)
     * 
     * @Accessor(getter="getWantModifiedSequence", setter="setWantModifiedSequence")
     * @SerializedName("wantModSeq")
     * @Type("bool")
     * @XmlAttribute
     */
    private $wantModifiedSequence;

    /**
     * Specification of contact modifications
     * 
     * @Accessor(getter="getContact", setter="setContact")
     * @SerializedName("cn")
     * @Type("Zimbra\Mail\Struct\ModifyContactSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ModifyContactSpec $contact;

    /**
     * Constructor method for ModifyContactRequest
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
     * Sets replace
     *
     * @param  array $replace
     * @return self
     */
    public function setReplace(bool $replace): self
    {
        $this->replace = $replace;
        return $this;
    }

    /**
     * Gets replace
     *
     * @return bool
     */
    public function getReplace(): ?bool
    {
        return $this->replace;
    }

    /**
     * Sets wantImapUid
     *
     * @param  array $wantImapUid
     * @return self
     */
    public function setWantImapUid(bool $wantImapUid): self
    {
        $this->wantImapUid = $wantImapUid;
        return $this;
    }

    /**
     * Gets wantImapUid
     *
     * @return bool
     */
    public function getWantImapUid(): ?bool
    {
        return $this->wantImapUid;
    }

    /**
     * Sets wantModifiedSequence
     *
     * @param  array $wantModifiedSequence
     * @return self
     */
    public function setWantModifiedSequence(bool $wantModifiedSequence): self
    {
        $this->wantModifiedSequence = $wantModifiedSequence;
        return $this;
    }

    /**
     * Gets wantModifiedSequence
     *
     * @return bool
     */
    public function getWantModifiedSequence(): ?bool
    {
        return $this->wantModifiedSequence;
    }

    /**
     * Gets verbose
     *
     * @return bool
     */
    public function getVerbose(): ?bool
    {
        return $this->verbose;
    }

    /**
     * Sets verbose
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
     * Gets contact
     *
     * @return ModifyContactSpec
     */
    public function getContact(): ModifyContactSpec
    {
        return $this->contact;
    }

    /**
     * Sets contact
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new ModifyContactEnvelope(
            new ModifyContactBody($this)
        );
    }
}
