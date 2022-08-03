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

/**
 * NewContactGroupMember struct class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class NewContactGroupMember
{
    /**
     * Member type
     * C: reference to another contact
     * G: reference to a GAL entry
     * I: inlined member (member name and email address is embeded in the contact group)
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Enum<Zimbra\Common\Enum\MemberType>")
     * @XmlAttribute
     */
    private MemberType $type;

    /**
     * Member value
     * type="C"     Item ID of another contact.
     * If the referenced contact is in a shared folder, the item ID must be qualified by zimbraId of the owner. e.g. {zimbraId}:{itemId}
     * type="G"     GAL entry reference (returned in SearchGalResponse)
     * type="I"     name and email address in the form of: "{name}" <{email}>
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("value")
     * @Type("string")
     * @XmlAttribute
     */
    private $value;

    /**
     * Constructor method for NewContactGroupMember
     * @param  MemberType $type
     * @param  string $value
     * @return self
     */
    public function __construct(
        ?MemberType $type = NULL, string $value = ''
    )
    {
        $this->setType($type ?? MemberType::CONTACT())
             ->setValue($value);
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
}
