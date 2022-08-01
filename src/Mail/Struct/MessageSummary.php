<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};

/**
 * MessageSummary class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MessageSummary extends MessageCommon
{
    /**
     * Message ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Auto send time
     * @Accessor(getter="getAutoSendTime", setter="setAutoSendTime")
     * @SerializedName("autoSendTime")
     * @Type("integer")
     * @XmlAttribute
     */
    private $autoSendTime;

    /**
     * Email address information
     * @Accessor(getter="getEmails", setter="setEmails")
     * @Type("array<Zimbra\Mail\Struct\EmailInfo>")
     * @XmlList(inline=true, entry="e", namespace="urn:zimbraMail")
     */
    private $emails = [];

    /**
     * Subject
     * @Accessor(getter="getSubject", setter="setSubject")
     * @SerializedName("su")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     */
    private $subject;

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     * @Accessor(getter="getFragment", setter="setFragment")
     * @SerializedName("fr")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     */
    private $fragment;

    /**
     * Invite information
     * @Accessor(getter="getInvite", setter="setInvite")
     * @SerializedName("inv")
     * @Type("Zimbra\Mail\Struct\InviteInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?InviteInfo $invite = NULL;

    /**
     * Constructor method for MessageSummary
     *
     * @param  string $id
     * @param  int $autoSendTime
     * @param  array $emails
     * @param  string $subject
     * @param  string $fragment
     * @param  InviteInfo $invite
     * @return self
     */
    public function __construct(
        string $id = '',
        ?int $autoSendTime = NULL,
        array $emails = [],
        ?string $subject = NULL,
        ?string $fragment = NULL,
        ?InviteInfo $invite = NULL
    )
    {
        $this->setId($id)
             ->setEmails($emails);
        if (NULL !== $autoSendTime) {
            $this->setAutoSendTime($autoSendTime);
        }
        if (NULL !== $subject) {
            $this->setSubject($subject);
        }
        if (NULL !== $fragment) {
            $this->setFragment($fragment);
        }
        if ($invite instanceof InviteInfo) {
            $this->setInvite($invite);
        }
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get autoSendTime
     *
     * @return int
     */
    public function getAutoSendTime(): ?int
    {
        return $this->autoSendTime;
    }

    /**
     * Set autoSendTime
     *
     * @param  int $autoSendTime
     * @return self
     */
    public function setAutoSendTime(int $autoSendTime): self
    {
        $this->autoSendTime = $autoSendTime;
        return $this;
    }

    /**
     * Set emails
     *
     * @param  array $emails
     * @return self
     */
    public function setEmails(array $emails): self
    {
        $this->emails = array_filter($emails, static fn ($email) => $email instanceof EmailInfo);
        return $this;
    }

    /**
     * Get emails
     *
     * @return array
     */
    public function getEmails(): array
    {
        return $this->emails;
    }

    /**
     * Add email
     *
     * @param  EmailInfo $email
     * @return self
     */
    public function addEmail(EmailInfo $email): self
    {
        $this->emails[] = $email;
        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * Set subject
     *
     * @param  string $subject
     * @return self
     */
    public function setSubject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Get fragment
     *
     * @return string
     */
    public function getFragment(): ?string
    {
        return $this->fragment;
    }

    /**
     * Set fragment
     *
     * @param  string $fragment
     * @return self
     */
    public function setFragment(string $fragment): self
    {
        $this->fragment = $fragment;
        return $this;
    }

    /**
     * Get invite
     *
     * @return InviteInfo
     */
    public function getInvite(): ?InviteInfo
    {
        return $this->invite;
    }

    /**
     * Set invite
     *
     * @param  InviteInfo $invite
     * @return self
     */
    public function setInvite(InviteInfo $invite): self
    {
        $this->invite = $invite;
        return $this;
    }
}
