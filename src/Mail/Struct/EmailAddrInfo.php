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

/**
 * EmailAddrInfo struct class
 * Email Address Information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EmailAddrInfo
{
    /**
     * Email address
     *
     * @var string
     */
    #[Accessor(getter: "getAddress", setter: "setAddress")]
    #[SerializedName("a")]
    #[Type("string")]
    #[XmlAttribute]
    private string $address;

    /**
     * Optional Address type - (f)rom, (t)o, (c)c, (b)cc, (r)eply-to,
     * (s)ender, read-receipt (n)otification, (rf) resent-from
     *
     * @var AddressType
     */
    #[Accessor(getter: "getAddressType", setter: "setAddressType")]
    #[SerializedName("t")]
    #[XmlAttribute]
    private ?AddressType $addressType;

    /**
     * The comment/name part of an address
     *
     * @var string
     */
    #[Accessor(getter: "getPersonal", setter: "setPersonal")]
    #[SerializedName("p")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $personal = null;

    /**
     * Constructor
     *
     * @param string $address
     * @param AddressType $addressType
     * @param string $personal
     * @return self
     */
    public function __construct(
        string $address = "",
        ?AddressType $addressType = null,
        ?string $personal = null
    ) {
        $this->setAddress($address);
        $this->addressType = $addressType;
        if (null !== $personal) {
            $this->setPersonal($personal);
        }
    }

    /**
     * Get addressType
     *
     * @return AddressType
     */
    public function getAddressType(): ?AddressType
    {
        return $this->addressType;
    }

    /**
     * Set addressType
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
     * Get address
     *
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * Set address
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
     * Get the personal
     *
     * @return string
     */
    public function getPersonal(): ?string
    {
        return $this->personal;
    }

    /**
     * Set the personal
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
