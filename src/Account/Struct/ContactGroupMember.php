<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * ContactGroupMember struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ContactGroupMember
{
    /**
     * Contact group member type
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $type;

    /**
     * Contact group member value
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("value")
     * @Type("string")
     * @XmlAttribute
     */
    private $value;

    /**
     * Contact
     * @Accessor(getter="getContact", setter="setContact")
     * @SerializedName("cn")
     * @Type("Zimbra\Account\Struct\ContactInfo")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private ?ContactInfo $contact = NULL;

    /**
     * Constructor method for ContactGroupMember
     * @param  string $type
     * @param  string $value
     * @param  ContactInfo $contact
     * @return self
     */
    public function __construct(string $type, string $value, ?ContactInfo $contact = NULL)
    {
        $this->setType($type)
             ->setValue($value);
        if ($contact instanceof ContactInfo) {
            $this->setContact($contact);
        }
    }

    /**
     * Gets contact group member type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets contact group member type
     *
     * @param  string $type
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets contact group member value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Sets contact group member value
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
     * Gets contact
     *
     * @return ContactInfo
     */
    public function getContact(): ?ContactInfo
    {
        return $this->contact;
    }

    /**
     * Sets contact
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
