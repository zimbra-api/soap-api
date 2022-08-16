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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FreeBusyProviderInfo
{
    /**
     * Provider name
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName(name: 'name')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $name;

    /**
     * Propagate flag
     * 
     * @var bool
     */
    #[Accessor(getter: 'getPropagate', setter: 'setPropagate')]
    #[SerializedName(name: 'propagate')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $propagate;

    /**
     * Free/Busy cache start time in seconds since the epoch
     * 
     * @var int
     */
    #[Accessor(getter: 'getStart', setter: 'setStart')]
    #[SerializedName(name: 'start')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $start;

    /**
     * Free/Busy cache end time in seconds since the epoch
     * 
     * @var int
     */
    #[Accessor(getter: 'getEnd', setter: 'setEnd')]
    #[SerializedName(name: 'end')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $end;

    /**
     * Queue location
     * 
     * @var string
     */
    #[Accessor(getter: 'getQueue', setter: 'setQueue')]
    #[SerializedName(name: 'queue')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $queue;

    /**
     * Prefix used in Zimbra ForeignPrincipal
     * 
     * @var string
     */
    #[Accessor(getter: 'getPrefix', setter: 'setPrefix')]
    #[SerializedName(name: 'prefix')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $prefix;

    /**
     * Constructor
     * 
     * @param string $name
     * @param bool $propagate
     * @param int $start
     * @param int $end
     * @param string $queue
     * @param string $prefix
     * @return self
     */
    public function __construct(
        string $name = '',
        bool $propagate = FALSE,
        int $start = 0,
        int $end = 0,
        string $queue = '',
        string $prefix = ''
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
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Get propagate
     *
     * @return bool
     */
    public function getPropagate(): bool
    {
        return $this->propagate;
    }

    /**
     * Set propagate
     *
     * @param  bool $propagate
     * @return self
     */
    public function setPropagate(bool $propagate): self
    {
        $this->propagate = $propagate;
        return $this;
    }

    /**
     * Get start
     *
     * @return int
     */
    public function getStart(): int
    {
        return $this->start;
    }

    /**
     * Set start
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
     * Get int
     *
     * @return int
     */
    public function getEnd(): int
    {
        return $this->end;
    }

    /**
     * Set end
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
     * Get queue
     *
     * @return string
     */
    public function getQueue(): string
    {
        return $this->queue;
    }

    /**
     * Set queue
     *
     * @param  string $queue
     * @return self
     */
    public function setQueue(string $queue): self
    {
        $this->queue = $queue;
        return $this;
    }

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * Set prefix
     *
     * @param  string $prefix
     * @return self
     */
    public function setPrefix(string $prefix): self
    {
        $this->prefix = $prefix;
        return $this;
    }
}
