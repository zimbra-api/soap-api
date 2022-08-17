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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EmailInfo implements EmailInfoInterface
{
    /**
     * Email address
     * 
     * @var string
     */
    #[Accessor(getter: 'getAddress', setter: 'setAddress')]
    #[SerializedName(name: 'a')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $address;

    /**
     * Display name. If we have personal name, first word in "word1 word2" format, or last
     * word in "word1, word2" format.  If no personal name, take string before "@" in email-address.
     * 
     * @var string
     */
    #[Accessor(getter: 'getDisplay', setter: 'setDisplay')]
    #[SerializedName(name: 'd')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $display;

    /**
     * The comment/name part of an address
     * 
     * @var string
     */
    #[Accessor(getter: 'getPersonal', setter: 'setPersonal')]
    #[SerializedName(name: 'p')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $personal;

    /**
     * Optional Address type - (f)rom, (t)o, (c)c, (b)cc, (r)eply-to,
     * (s)ender, read-receipt (n)otification, (rf) resent-from
     * 
     * @var AddressType
     */
    #[Accessor(getter: 'getAddressType', setter: 'setAddressType')]
    #[SerializedName(name: 't')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\AddressType>')]
    #[XmlAttribute]
    private $addressType;

    /**
     * Set if the email address is a group
     * 
     * @var bool
     */
    #[Accessor(getter: 'getGroup', setter: 'setGroup')]
    #[SerializedName(name: 'isGroup')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $group;

    /**
     * Flags whether can expand group members
     * 
     * @var bool
     */
    #[Accessor(getter: 'getCanExpandGroupMembers', setter: 'setCanExpandGroupMembers')]
    #[SerializedName(name: 'exp')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $canExpandGroupMembers;

    /**
     * Constructor
     *
     * @param string $address
     * @param string $display
     * @param string $personal
     * @param AddressType $addressType
     * @param bool $group
     * @param bool $canExpandGroupMembers
     * @return self
     */
    public function __construct(
        ?string $address = NULL,
        ?string $display = NULL,
        ?string $personal = NULL,
        ?AddressType $addressType = NULL,
        ?bool $group = NULL,
        ?bool $canExpandGroupMembers = NULL
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
        if (NULL !== $group) {
            $this->setGroup($group);
        }
        if (NULL !== $canExpandGroupMembers) {
            $this->setCanExpandGroupMembers($canExpandGroupMembers);
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

    /**
     * Get the display
     *
     * @return string
     */
    public function getDisplay(): ?string
    {
        return $this->display;
    }

    /**
     * Set the display
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
     * Get group
     *
     * @return bool
     */
    public function getGroup(): ?bool
    {
        return $this->group;
    }

    /**
     * Set group
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
     * Get canExpandGroupMembers
     *
     * @return bool
     */
    public function getCanExpandGroupMembers(): ?bool
    {
        return $this->canExpandGroupMembers;
    }

    /**
     * Set canExpandGroupMembers
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
