<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\SoapResponse;

/**
 * VerifyStoreManagerResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class VerifyStoreManagerResponse extends SoapResponse
{
    /**
     * Store manager class
     * 
     * @var string
     */
    #[Accessor(getter: 'getStoreManagerClass', setter: 'setStoreManagerClass')]
    #[SerializedName(name: 'storeManagerClass')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $storeManagerClass;

    /**
     * Incoming time
     * 
     * @var int
     */
    #[Accessor(getter: 'getIncomingTime', setter: 'setIncomingTime')]
    #[SerializedName(name: 'incomingTime')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $incomingTime;

    /**
     * Stage time
     * 
     * @var int
     */
    #[Accessor(getter: 'getStageTime', setter: 'setStageTime')]
    #[SerializedName(name: 'stageTime')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $stageTime;

    /**
     * Link time
     * 
     * @var int
     */
    #[Accessor(getter: 'getLinkTime', setter: 'setLinkTime')]
    #[SerializedName(name: 'linkTime')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $linkTime;

    /**
     * Fetch time
     * 
     * @var int
     */
    #[Accessor(getter: 'getFetchTime', setter: 'setFetchTime')]
    #[SerializedName(name: 'fetchTime')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $fetchTime;

    /**
     * Delete time
     * 
     * @var int
     */
    #[Accessor(getter: 'getDeleteTime', setter: 'setDeleteTime')]
    #[SerializedName(name: 'deleteTime')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $deleteTime;

    /**
     * Constructor
     * 
     * @param string $storeManagerClass
     * @param int $incomingTime
     * @param int $stageTime
     * @param int $linkTime
     * @param int $fetchTime
     * @param int $deleteTime
     * @return self
     */
    public function __construct(
        ?string $storeManagerClass = NULL,
        ?int $incomingTime = NULL,
        ?int $stageTime = NULL,
        ?int $linkTime = NULL,
        ?int $fetchTime = NULL,
        ?int $deleteTime = NULL
    )
    {
        if (NULL !== $storeManagerClass) {
            $this->setStoreManagerClass($storeManagerClass);
        }
        if (NULL !== $incomingTime) {
            $this->setIncomingTime($incomingTime);
        }
        if (NULL !== $stageTime) {
            $this->setStageTime($stageTime);
        }
        if (NULL !== $linkTime) {
            $this->setLinkTime($linkTime);
        }
        if (NULL !== $fetchTime) {
            $this->setFetchTime($fetchTime);
        }
        if (NULL !== $deleteTime) {
            $this->setDeleteTime($deleteTime);
        }
    }

    /**
     * Get WaitSet ID
     *
     * @return string
     */
    public function getStoreManagerClass(): ?string
    {
        return $this->storeManagerClass;
    }

    /**
     * Set WaitSet ID
     *
     * @param  string $storeManagerClass
     * @return self
     */
    public function setStoreManagerClass(string $storeManagerClass): self
    {
        $this->storeManagerClass = $storeManagerClass;
        return $this;
    }

    /**
     * Get incomingTime
     *
     * @return int
     */
    public function getIncomingTime(): ?int
    {
        return $this->incomingTime;
    }

    /**
     * Set incomingTime
     *
     * @param  int $incomingTime
     * @return self
     */
    public function setIncomingTime(int $incomingTime): self
    {
        $this->incomingTime = $incomingTime;
        return $this;
    }

    /**
     * Get stageTime
     *
     * @return int
     */
    public function getStageTime(): ?int
    {
        return $this->stageTime;
    }

    /**
     * Set stageTime
     *
     * @param  int $stageTime
     * @return self
     */
    public function setStageTime(int $stageTime): self
    {
        $this->stageTime = $stageTime;
        return $this;
    }

    /**
     * Get linkTime
     *
     * @return int
     */
    public function getLinkTime(): ?int
    {
        return $this->linkTime;
    }

    /**
     * Set linkTime
     *
     * @param  int $linkTime
     * @return self
     */
    public function setLinkTime(int $linkTime): self
    {
        $this->linkTime = $linkTime;
        return $this;
    }

    /**
     * Get fetchTime
     *
     * @return int
     */
    public function getFetchTime(): ?int
    {
        return $this->fetchTime;
    }

    /**
     * Set fetchTime
     *
     * @param  int $fetchTime
     * @return self
     */
    public function setFetchTime(int $fetchTime): self
    {
        $this->fetchTime = $fetchTime;
        return $this;
    }

    /**
     * Get deleteTime
     *
     * @return int
     */
    public function getDeleteTime(): ?int
    {
        return $this->deleteTime;
    }

    /**
     * Set deleteTime
     *
     * @param  int $deleteTime
     * @return self
     */
    public function setDeleteTime(int $deleteTime): self
    {
        $this->deleteTime = $deleteTime;
        return $this;
    }
}
