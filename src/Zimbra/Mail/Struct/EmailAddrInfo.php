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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\AddressType;

/**
 * EmailAddrInfo struct class
 * Email Address Information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="email")
 */
class EmailAddrInfo
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
     * Optional Address type - (f)rom, (t)o, (c)c, (b)cc, (r)eply-to,
     * (s)ender, read-receipt (n)otification, (rf) resent-from
     * @Accessor(getter="getAddressType", setter="setAddressType")
     * @SerializedName("t")
     * @Type("Zimbra\Enum\AddressType")
     * @XmlAttribute
     */
    private $addressType;

    /**
     * The comment/name part of an address
     * @Accessor(getter="getPersonal", setter="setPersonal")
     * @SerializedName("p")
     * @Type("string")
     * @XmlAttribute
     */
    private $personal;

    /**
     * Constructor method
     * @param string $address
     * @param AddressType $addressType
     * @param string $personal
     * @return self
     */
    public function __construct(
        string $address, ?AddressType $addressType = NULL, ?string $personal = NULL
    )
    {
        $this->setAddress($address);
        if ($addressType instanceof AddressType) {
            $this->setAddressType($addressType);
        }
        if (NULL !== $personal) {
            $this->setPersonal($personal);
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
}
