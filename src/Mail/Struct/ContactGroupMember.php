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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Common\Enum\MemberType;
use Zimbra\Common\Struct\{ContactGroupMemberInterface, ContactInterface};

/**
 * ContactGroupMember struct class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ContactGroupMember implements ContactGroupMemberInterface
{
    /**
     * Member type
     * C: reference to another contact
     * G: reference to a GAL entry
     * I: inlined member (member name and email address is embeded in the contact group)
     * 
     * @var MemberType
     */
    #[Accessor(getter: 'getType', setter: 'setType')]
    #[SerializedName('type')]
    #[XmlAttribute]
    private MemberType $type;

    /**
     * Member value
     * type="C"     Item ID of another contact.
     * If the referenced contact is in a shared folder, the item ID must be qualified by zimbraId of the owner. e.g. {zimbraId}:{itemId}
     * type="G"     GAL entry reference (returned in SearchGalResponse)
     * type="I"     name and email address in the form of: "{name}" <{email}>
     * 
     * @var string
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[SerializedName('value')]
    #[Type('string')]
    #[XmlAttribute]
    private $value;

    /**
     * Contact information for dereferenced member.
     * 
     * @var ContactInterface
     */
    #[Accessor(getter: 'getContact', setter: 'setContact')]
    #[SerializedName('cn')]
    #[Type(ContactInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?ContactInterface $contact;

    /**
     * Constructor
     * 
     * @param  MemberType $type
     * @param  string $value
     * @param  ContactInfo $contact
     * @return self
     */
    public function __construct(
        ?MemberType $type = NULL, string $value = '', ?ContactInfo $contact = NULL
    )
    {
        $this->setType($type ?? MemberType::CONTACT)
             ->setValue($value);
        $this->contact = $contact;
    }

    /**
     * Get contact group member type
     *
     * @return MemberType
     */
    public function getType(): MemberType
    {
        return $this->type;
    }

    /**
     * Set contact group member type
     *
     * @param  MemberType $type
     * @return self
     */
    public function setType(MemberType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get contact group member value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Set contact group member value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get contact
     *
     * @return ContactInterface
     */
    public function getContact(): ?ContactInterface
    {
        return $this->contact;
    }

    /**
     * Set contact
     *
     * @param  ContactInterface $contact
     * @return self
     */
    public function setContact(ContactInterface $contact): self
    {
        $this->contact = $contact;
        return $this;
    }
}
