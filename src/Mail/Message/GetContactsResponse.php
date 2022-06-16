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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Mail\Struct\ContactInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetContactsResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetContactsResponse implements ResponseInterface
{
    /**
     * Contact information
     * 
     * @Accessor(getter="getContacts", setter="setContacts")
     * @SerializedName("cn")
     * @Type("array<Zimbra\Mail\Struct\ContactInfo>")
     * @XmlList(inline = true, entry = "cn")
     */
    private $contacts = [];

    /**
     * Constructor method for GetContactsResponse
     *
     * @param  array $contacts
     * @return self
     */
    public function __construct(array $contacts = [])
    {
        $this->setContacts($contacts);
    }

    /**
     * Add contact
     *
     * @param  ContactInfo $contact
     * @return self
     */
    public function addContact(ContactInfo $contact): self
    {
        $this->contacts[] = $contact;
        return $this;
    }

    /**
     * Sets contacts
     *
     * @param  array $contacts
     * @return self
     */
    public function setContacts(array $contacts): self
    {
        $this->contacts = array_filter($contacts, static fn ($cn) => $cn instanceof ContactInfo);
        return $this;
    }

    /**
     * Gets contacts
     *
     * @return array
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }
}
