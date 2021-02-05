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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};

/**
 * BounceMsgSpec class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="msg")
 */
class BounceMsgSpec
{
    /**
     * ID of message to resend
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Email addresses
     * @Accessor(getter="getEmailAddresses", setter="setEmailAddresses")
     * @SerializedName("e")
     * @Type("array<Zimbra\Mail\Struct\EmailAddrInfo>")
     * @XmlList(inline = true, entry = "e")
     */
    private $emailAddresses = [];

    /**
     * Constructor method for BounceMsgSpec
     *
     * @param  string $id
     * @param  array $emailAddresses
     * @return self
     */
    public function __construct(
        string $id,
        array $emailAddresses = []
    )
    {
        $this->setId($id)
             ->setEmailAddresses($emailAddresses);
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Sets emailAddresses
     *
     * @param  array $emailAddresses
     * @return self
     */
    public function setEmailAddresses(array $emailAddresses): self
    {
        $this->emailAddresses = [];
        foreach ($emailAddresses as $emailAddress) {
            if ($emailAddress instanceof EmailAddrInfo) {
                $this->emailAddresses[] = $emailAddress;
            }
        }
        return $this;
    }

    /**
     * Gets emailAddresses
     *
     * @return array
     */
    public function getEmailAddresses(): array
    {
        return $this->emailAddresses;
    }

    /**
     * Add emailAddress
     *
     * @param  EmailAddrInfo $emailAddress
     * @return self
     */
    public function addEmailAddress(EmailAddrInfo $emailAddress): self
    {
        $this->emailAddresses[] = $emailAddress;
        return $this;
    }
}