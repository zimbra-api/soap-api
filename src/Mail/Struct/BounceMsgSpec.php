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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * BounceMsgSpec class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class BounceMsgSpec
{
    /**
     * ID of message to resend
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * Email addresses
     * 
     * @var array
     */
    #[Accessor(getter: 'getEmailAddresses', setter: 'setEmailAddresses')]
    #[Type(name: 'array<Zimbra\Mail\Struct\EmailAddrInfo>')]
    #[XmlList(inline: true, entry: 'e', namespace: 'urn:zimbraMail')]
    private $emailAddresses = [];

    /**
     * Constructor
     *
     * @param  string $id
     * @param  array $emailAddresses
     * @return self
     */
    public function __construct(
        string $id = '',
        array $emailAddresses = []
    )
    {
        $this->setId($id)
             ->setEmailAddresses($emailAddresses);
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set id
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
     * Set emailAddresses
     *
     * @param  array $addresses
     * @return self
     */
    public function setEmailAddresses(array $addresses): self
    {
        $this->emailAddresses = array_filter($addresses, static fn ($address) => $address instanceof EmailAddrInfo);
        return $this;
    }

    /**
     * Get emailAddresses
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
