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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\ContactInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * CreateContactResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateContactResponse extends SoapResponse
{
    /**
     * Details of the contact.  Note that if verbose was not set in the request,
     * the returned <cn> is just a placeholder containing the new contact ID (i.e. <cn id="{id}"/>)
     *
     * @Accessor(getter="getContact", setter="setContact")
     * @SerializedName("cn")
     * @Type("Zimbra\Mail\Struct\ContactInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var ContactInfo
     */
    #[Accessor(getter: "getContact", setter: "setContact")]
    #[SerializedName("cn")]
    #[Type(ContactInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?ContactInfo $contact;

    /**
     * Constructor
     *
     * @param  ContactInfo $contact
     * @return self
     */
    public function __construct(?ContactInfo $contact = null)
    {
        $this->contact = $contact;
    }

    /**
     * Get contact
     *
     * @return ContactInfo
     */
    public function getContact(): ?ContactInfo
    {
        return $this->contact;
    }

    /**
     * Set contact
     *
     * @param  ContactInfo $contact
     * @return self
     */
    public function setContact(ContactInfo $contact): self
    {
        $this->contact = $contact;
        return $this;
    }
}
