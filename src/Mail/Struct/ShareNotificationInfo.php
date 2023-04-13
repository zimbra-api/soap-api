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

/**
 * ShareNotificationInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ShareNotificationInfo
{
    /**
     * Status - "new" if the message is unread or "seen" if the message is read.
     * 
     * @var string
     */
    #[Accessor(getter: 'getStatus', setter: 'setStatus')]
    #[SerializedName('status')]
    #[Type('string')]
    #[XmlAttribute]
    private $status;

    /**
     * The item ID of the share notification message.
     * The message must be in the Inbox folder.
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * Date
     * 
     * @var int
     */
    #[Accessor(getter: 'getDate', setter: 'setDate')]
    #[SerializedName('d')]
    #[Type('int')]
    #[XmlAttribute]
    private $date;

    /**
     * Grantor information
     * 
     * @var Grantor
     */
    #[Accessor(getter: 'getGrantor', setter: 'setGrantor')]
    #[SerializedName('grantor')]
    #[Type(Grantor::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?Grantor $grantor;

    /**
     * Link information
     * 
     * @var LinkInfo
     */
    #[Accessor(getter: 'getLink', setter: 'setLink')]
    #[SerializedName('link')]
    #[Type(LinkInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?LinkInfo $link;

    /**
     * Constructor
     *
     * @param string $status
     * @param string $id
     * @param int $date
     * @param Grantor $grantor
     * @param LinkInfo $link
     * @return self
     */
    public function __construct(
        string $status = '',
        string $id = '',
        int $date = 0,
        ?Grantor $grantor = NULL,
        ?LinkInfo $link = NULL
    )
    {
        $this->setId($id)
             ->setStatus($status)
             ->setDate($date);
        $this->grantor = $grantor;
        $this->link = $link;
    }

    /**
     * Get address
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
     * Get addressType
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param  string $status
     * @return self
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get the date
     *
     * @return int
     */
    public function getDate(): int
    {
        return $this->date;
    }

    /**
     * Set the date
     *
     * @param  int $date
     * @return self
     */
    public function setDate(int $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get the grantor
     *
     * @return Grantor
     */
    public function getGrantor(): ?Grantor
    {
        return $this->grantor;
    }

    /**
     * Set the grantor
     *
     * @param  Grantor $grantor
     * @return self
     */
    public function setGrantor(Grantor $grantor): self
    {
        $this->grantor = $grantor;
        return $this;
    }

    /**
     * Get the link
     *
     * @return LinkInfo
     */
    public function getLink(): ?LinkInfo
    {
        return $this->link;
    }

    /**
     * Set the link
     *
     * @param  LinkInfo $link
     * @return self
     */
    public function setLink(LinkInfo $link): self
    {
        $this->link = $link;
        return $this;
    }
}
