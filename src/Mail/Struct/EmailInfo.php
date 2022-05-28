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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Struct\EmailInfoInterface;

/**
 * EmailInfo struct class
 * Email information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class EmailInfo implements EmailInfoInterface
{
    /**
     * Email address
     * @Accessor(getter="getAddress", setter="setAddress")
     * @SerializedName("a")
     * @Type("string")
     * @XmlAttribute
     */
    private $address;

    /**
     * Display name. If we have personal name, first word in "word1 word2" format, or last
     * word in "word1, word2" format.  If no personal name, take string before "@" in email-address.
     * @Accessor(getter="getDisplay", setter="setDisplay")
     * @SerializedName("d")
     * @Type("string")
     * @XmlAttribute
     */
    private $display;

    /**
     * The comment/name part of an address
     * @Accessor(getter="getPersonal", setter="setPersonal")
     * @SerializedName("p")
     * @Type("string")
     * @XmlAttribute
     */
    private $personal;

    /**
     * Optional Address type - (f)rom, (t)o, (c)c, (b)cc, (r)eply-to,
     * (s)ender, read-receipt (n)otification, (rf) resent-from
     * @Accessor(getter="getAddressType", setter="setAddressType")
     * @SerializedName("t")
     * @Type("Zimbra\Common\Enum\AddressType")
     * @XmlAttribute
     */
    private ?AddressType $addressType = NULL;

    /**
     * Set if the email address is a group
     * @Accessor(getter="getGroup", setter="setGroup")
     * @SerializedName("isGroup")
     * @Type("bool")
     * @XmlAttribute
     */
    private $group;

    /**
     * Flags whether can expand group members
     * @Accessor(getter="getCanExpandGroupMembers", setter="setCanExpandGroupMembers")
     * @SerializedName("exp")
     * @Type("bool")
     * @XmlAttribute
     */
    private $canExpandGroupMembers;

    /**
     * Constructor method
     *
     * @param string $address
     * @param string $display
     * @param string $personal
     * @param AddressType $addressType
     * @return self
     */
    public function __construct(
        ?string $address = NULL,
        ?string $display = NULL,
        ?string $personal = NULL,
        ?AddressType $addressType = NULL
    )
    {
        if (NULL !== $address) {
            $this->setAddress($address);
        }
        if (NULL !== $display) {
            $this->setDisplay($display);
        }
        if (NULL !== $personal) {
            $this->setPersonal($personal);
        }
        if ($addressType instanceof AddressType) {
            $this->setAddressType($addressType);
        }
    }

    /**
     * Gets addressType
     *
     * @return AddressType
     */
    public function getAddressType(): ?AddressType
    {
        return $this->addressType;
    }

    /**
     * Sets addressType
     *
     * @param  AddressType $addressType
     * @return self
     */
    public function setAddressType(AddressType $addressType): self
    {
        $this->addressType = $addressType;
        return $this;
    }

    /**
     * Gets address
     *
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * Sets address
     *
     * @param  string $address
     * @return self
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Gets the personal
     *
     * @return string
     */
    public function getPersonal(): ?string
    {
        return $this->personal;
    }

    /**
     * Sets the personal
     *
     * @param  string $personal
     * @return self
     */
    public function setPersonal(string $personal): self
    {
        $this->personal = $personal;
        return $this;
    }

    /**
     * Gets the display
     *
     * @return string
     */
    public function getDisplay(): ?string
    {
        return $this->display;
    }

    /**
     * Sets the display
     *
     * @param  string $display
     * @return self
     */
    public function setDisplay(string $display): self
    {
        $this->display = $display;
        return $this;
    }

    /**
     * Gets group
     *
     * @return bool
     */
    public function getGroup(): ?bool
    {
        return $this->group;
    }

    /**
     * Sets group
     *
     * @param  bool $group
     * @return self
     */
    public function setGroup(bool $group): self
    {
        $this->group = $group;
        return $this;
    }

    /**
     * Gets canExpandGroupMembers
     *
     * @return bool
     */
    public function getCanExpandGroupMembers(): ?bool
    {
        return $this->canExpandGroupMembers;
    }

    /**
     * Sets canExpandGroupMembers
     *
     * @param  bool $canExpandGroupMembers
     * @return self
     */
    public function setCanExpandGroupMembers(bool $canExpandGroupMembers): self
    {
        $this->canExpandGroupMembers = $canExpandGroupMembers;
        return $this;
    }
}
