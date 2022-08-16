<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * QueueItem class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class QueueItem
{
    /**
     * id
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * Arrival time
     * 
     * @var string
     */
    #[Accessor(getter: 'getTime', setter: 'setTime')]
    #[SerializedName(name: 'time')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $time;

    /**
     * From domain
     * 
     * @var string
     */
    #[Accessor(getter: 'getFromdomain', setter: 'setFromdomain')]
    #[SerializedName(name: 'fromdomain')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $fromdomain;

    /**
     * Size
     * 
     * @var string
     */
    #[Accessor(getter: 'getSize', setter: 'setSize')]
    #[SerializedName(name: 'size')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $size;

    /**
     * Sender
     * 
     * @var string
     */
    #[Accessor(getter: 'getFrom', setter: 'setFrom')]
    #[SerializedName(name: 'from')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $from;

    /**
     * Comma separated list of recipients
     * 
     * @var string
     */
    #[Accessor(getter: 'getTo', setter: 'setTo')]
    #[SerializedName(name: 'to')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $to;

    /**
     * Hostname of origin
     * 
     * @var string
     */
    #[Accessor(getter: 'getHost', setter: 'setHost')]
    #[SerializedName(name: 'host')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $host;

    /**
     * IP address of origin
     * 
     * @var string
     */
    #[Accessor(getter: 'getAddr', setter: 'setAddr')]
    #[SerializedName(name: 'addr')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $addr;

    /**
     * Reason
     * 
     * @var string
     */
    #[Accessor(getter: 'getReason', setter: 'setReason')]
    #[SerializedName(name: 'reason')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $reason;

    /**
     * Content filter
     * 
     * @var string
     * @XmlAttribute
     */
    #[Accessor(getter: 'getFilter', setter: 'setFilter')]
    #[SerializedName(name: 'filter')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $filter;

    /**
     * To domain
     * 
     * @var string
     */
    #[Accessor(getter: 'getTodomain', setter: 'setTodomain')]
    #[SerializedName(name: 'todomain')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $todomain;

    /**
     * IP address message received from
     * 
     * @var string
     */
    #[Accessor(getter: 'getReceived', setter: 'setReceived')]
    #[SerializedName(name: 'received')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $received;

    /**
     * Constructor
     * 
     * @param string $id
     * @param string $time
     * @param string $fromdomain
     * @param string $size
     * @param string $from
     * @param string $to
     * @param string $host
     * @param string $addr
     * @param string $reason
     * @param string $filter
     * @param string $todomain
     * @param string $received
     * @return self
     */
    public function __construct(
        string $id = '',
        string $time = '',
        string $fromdomain = '',
        string $size = '',
        string $from = '',
        string $to = '',
        string $host = '',
        string $addr = '',
        string $reason = '',
        string $filter = '',
        string $todomain = '',
        string $received = ''
    )
    {
        $this->setId($id)
             ->setTime($time)
             ->setFromdomain($fromdomain)
             ->setSize($size)
             ->setFrom($from)
             ->setTo($to)
             ->setHost($host)
             ->setAddr($addr)
             ->setReason($reason)
             ->setFilter($filter)
             ->setTodomain($todomain)
             ->setReceived($received);
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
     * Get time
     *
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * Set time
     *
     * @param  string $time
     * @return self
     */
    public function setTime(string $time): self
    {
        $this->time = $time;
        return $this;
    }

    /**
     * Get fromdomain
     *
     * @return string
     */
    public function getFromdomain(): string
    {
        return $this->fromdomain;
    }

    /**
     * Set fromdomain
     *
     * @param  string $fromdomain
     * @return self
     */
    public function setFromdomain(string $fromdomain): self
    {
        $this->fromdomain = $fromdomain;
        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * Set size
     *
     * @param  string $size
     * @return self
     */
    public function setSize(string $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Get from
     *
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * Set from
     *
     * @param  string $from
     * @return self
     */
    public function setFrom(string $from): self
    {
        $this->from = $from;
        return $this;
    }

    /**
     * Get to
     *
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * Set to
     *
     * @param  string $to
     * @return self
     */
    public function setTo(string $to): self
    {
        $this->to = $to;
        return $this;
    }

    /**
     * Get host
     *
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * Set host
     *
     * @param  string $host
     * @return self
     */
    public function setHost(string $host): self
    {
        $this->host = $host;
        return $this;
    }

    /**
     * Get addr
     *
     * @return string
     */
    public function getAddr(): string
    {
        return $this->addr;
    }

    /**
     * Set addr
     *
     * @param  string $addr
     * @return self
     */
    public function setAddr(string $addr): self
    {
        $this->addr = $addr;
        return $this;
    }

    /**
     * Get reason
     *
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }

    /**
     * Set reason
     *
     * @param  string $reason
     * @return self
     */
    public function setReason(string $reason): self
    {
        $this->reason = $reason;
        return $this;
    }

    /**
     * Get filter
     *
     * @return string
     */
    public function getFilter(): string
    {
        return $this->filter;
    }

    /**
     * Set filter
     *
     * @param  string $filter
     * @return self
     */
    public function setFilter(string $filter): self
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * Get todomain
     *
     * @return string
     */
    public function getTodomain(): string
    {
        return $this->todomain;
    }

    /**
     * Set todomain
     *
     * @param  string $todomain
     * @return self
     */
    public function setTodomain(string $todomain): self
    {
        $this->todomain = $todomain;
        return $this;
    }

    /**
     * Get received
     *
     * @return string
     */
    public function getReceived(): string
    {
        return $this->received;
    }

    /**
     * Set received
     *
     * @param  string $received
     * @return self
     */
    public function setReceived(string $received): self
    {
        $this->received = $received;
        return $this;
    }
}
