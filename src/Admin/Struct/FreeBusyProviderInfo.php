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
 * FreeBusyProviderInfo class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class FreeBusyProviderInfo
{
    /**
     * Provider name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Propagate flag
     * @Accessor(getter="getPropagate", setter="setPropagate")
     * @SerializedName("propagate")
     * @Type("bool")
     * @XmlAttribute
     */
    private $propagate;

    /**
     * Free/Busy cache start time in seconds since the epoch
     * @Accessor(getter="getStart", setter="setStart")
     * @SerializedName("start")
     * @Type("integer")
     * @XmlAttribute
     */
    private $start;

    /**
     * Free/Busy cache end time in seconds since the epoch
     * @Accessor(getter="getEnd", setter="setEnd")
     * @SerializedName("end")
     * @Type("integer")
     * @XmlAttribute
     */
    private $end;

    /**
     * Queue location
     * @Accessor(getter="getQueue", setter="setQueue")
     * @SerializedName("queue")
     * @Type("string")
     * @XmlAttribute
     */
    private $queue;

    /**
     * Prefix used in Zimbra ForeignPrincipal
     * @Accessor(getter="getPrefix", setter="setPrefix")
     * @SerializedName("prefix")
     * @Type("string")
     * @XmlAttribute
     */
    private $prefix;

    /**
     * Constructor method for FreeBusyProviderInfo
     * @param string $name
     * @param bool $propagate
     * @param int $start
     * @param int $end
     * @param string $queue
     * @param string $prefix
     * @return self
     */
    public function __construct(
        string $name,
        bool $propagate,
        int $start,
        int $end,
        string $queue,
        string $prefix
    )
    {
        $this->setName($name)
             ->setPropagate($propagate)
             ->setStart($start)
             ->setEnd($end)
             ->setQueue($queue)
             ->setPrefix($prefix);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets propagate
     *
     * @return bool
     */
    public function getPropagate(): bool
    {
        return $this->propagate;
    }

    /**
     * Sets propagate
     *
     * @param  string $propagate
     * @return self
     */
    public function setPropagate(bool $propagate): self
    {
        $this->propagate = $propagate;
        return $this;
    }

    /**
     * Gets start
     *
     * @return int
     */
    public function getStart(): int
    {
        return $this->start;
    }

    /**
     * Sets start
     *
     * @param  int $start
     * @return self
     */
    public function setStart(int $start): self
    {
        $this->start = $start;
        return $this;
    }

    /**
     * Gets int
     *
     * @return int
     */
    public function getEnd(): int
    {
        return $this->end;
    }

    /**
     * Sets end
     *
     * @param  int $end
     * @return self
     */
    public function setEnd(int $end): self
    {
        $this->end = $end;
        return $this;
    }

    /**
     * Gets queue
     *
     * @return string
     */
    public function getQueue(): string
    {
        return $this->queue;
    }

    /**
     * Sets queue
     *
     * @param  string $target
     * @return self
     */
    public function setQueue($queue): self
    {
        $this->queue = $queue;
        return $this;
    }

    /**
     * Gets prefix
     *
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * Sets prefix
     *
     * @param  string $prefix
     * @return self
     */
    public function setPrefix($prefix): self
    {
        $this->prefix = $prefix;
        return $this;
    }
}
