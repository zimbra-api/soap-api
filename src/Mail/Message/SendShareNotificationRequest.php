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
    Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList
};
use Zimbra\Common\Enum\ShareAction;
use Zimbra\Common\Struct\Id;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * SendShareNotificationRequest class
 * Send share notification
 * The client can list the recipient email addresses for the share, along with the itemId of the item being shared.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SendShareNotificationRequest extends SoapRequest
{
    /**
     * Item ID
     * 
     * @Accessor(getter="getItem", setter="setItem")
     * @SerializedName("item")
     * @Type("Zimbra\Common\Struct\Id")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private Id $item;

    /**
     * Email addresses
     * 
     * @Accessor(getter="getEmailAddresses", setter="setEmailAddresses")
     * @Type("array<Zimbra\Mail\Struct\EmailAddrInfo>")
     * @XmlList(inline=true, entry="e", namespace="urn:zimbraMail")
     */
    private $emailAddresses = [];

    /**
     * Set to "revoke" if it is a grant revoke notification. It is set to "expire"
     * by the system to send notification for a grant expiry.
     * 
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Enum<Zimbra\Common\Enum\ShareAction>")
     * @XmlAttribute
     */
    private $action;

    /**
     * Notes
     * 
     * @Accessor(getter="getNotes", setter="setNotes")
     * @SerializedName("notes")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     */
    private $notes;

    /**
     * Constructor
     * 
     * @param Id $item
     * @param array $emailAddresses
     * @param ShareAction $action
     * @param string $notes
     * @return self
     */
    public function __construct(
        Id $item, array $emailAddresses = [], ?ShareAction $action = NULL, ?string $notes = NULL
    )
    {
        $this->setItem($item)
             ->setEmailAddresses($emailAddresses);
        if ($action instanceof ShareAction) {
            $this->setAction($action);
        }
        if (NULL !== $notes) {
            $this->setNotes($notes);
        }
    }

    /**
     * Get the item.
     *
     * @return Id
     */
    public function getItem(): Id
    {
        return $this->item;
    }

    /**
     * Set the item.
     *
     * @param  Id $item
     * @return self
     */
    public function setItem(Id $item): self
    {
        $this->item = $item;
        return $this;
    }

    /**
     * Add email address
     *
     * @param  EmailAddrInfo $emailAddress
     * @return self
     */
    public function addEmailAddress(EmailAddrInfo $emailAddress): self
    {
        $this->emailAddresses[] = $emailAddress;
        return $this;
    }

    /**
     * Set email address array
     *
     * @param array  $addresses
     * @return self
     */
    public function setEmailAddresses(array $addresses): self
    {
        $this->emailAddresses = array_filter($addresses, static fn($address) => $address instanceof EmailAddrInfo);
        return $this;
    }

    /**
     * Get email address array
     *
     * @return array
     */
    public function getEmailAddresses(): array
    {
        return $this->emailAddresses;
    }

    /**
     * Get action
     *
     * @return ShareAction
     */
    public function getAction(): ?ShareAction
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param  ShareAction $action
     * @return self
     */
    public function setAction(ShareAction $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * Set notes
     *
     * @param  string $notes
     * @return self
     */
    public function setNotes(string $notes): self
    {
        $this->notes = $notes;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SendShareNotificationEnvelope(
            new SendShareNotificationBody($this)
        );
    }
}
