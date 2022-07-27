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
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * VerifyStoreManagerResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class VerifyStoreManagerResponse implements SoapResponseInterface
{
    /**
     * storeManagerClass
     * @Accessor(getter="getStoreManagerClass", setter="setStoreManagerClass")
     * @SerializedName("storeManagerClass")
     * @Type("string")
     * @XmlAttribute
     */
    private $storeManagerClass;

    /**
     * incomingTime
     * @Accessor(getter="getIncomingTime", setter="setIncomingTime")
     * @SerializedName("incomingTime")
     * @Type("integer")
     * @XmlAttribute
     */
    private $incomingTime;

    /**
     * stageTime
     * @Accessor(getter="getStageTime", setter="setStageTime")
     * @SerializedName("stageTime")
     * @Type("integer")
     * @XmlAttribute
     */
    private $stageTime;

    /**
     * linkTime
     * @Accessor(getter="getLinkTime", setter="setLinkTime")
     * @SerializedName("linkTime")
     * @Type("integer")
     * @XmlAttribute
     */
    private $linkTime;

    /**
     * fetchTime
     * @Accessor(getter="getFetchTime", setter="setFetchTime")
     * @SerializedName("fetchTime")
     * @Type("integer")
     * @XmlAttribute
     */
    private $fetchTime;

    /**
     * deleteTime
     * @Accessor(getter="getDeleteTime", setter="setDeleteTime")
     * @SerializedName("deleteTime")
     * @Type("integer")
     * @XmlAttribute
     */
    private $deleteTime;

    /**
     * Constructor method for VerifyStoreManagerResponse
     * 
     * @param string  $storeManagerClass
     * @param int  $incomingTime
     * @param int  $stageTime
     * @param int  $linkTime
     * @param int  $fetchTime
     * @param int  $deleteTime
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
     * Gets WaitSet ID
     *
     * @return string
     */
    public function getStoreManagerClass(): ?string
    {
        return $this->storeManagerClass;
    }

    /**
     * Sets WaitSet ID
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
     * Gets incomingTime
     *
     * @return int
     */
    public function getIncomingTime(): ?int
    {
        return $this->incomingTime;
    }

    /**
     * Sets incomingTime
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
     * Gets stageTime
     *
     * @return int
     */
    public function getStageTime(): ?int
    {
        return $this->stageTime;
    }

    /**
     * Sets stageTime
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
     * Gets linkTime
     *
     * @return int
     */
    public function getLinkTime(): ?int
    {
        return $this->linkTime;
    }

    /**
     * Sets linkTime
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
     * Gets fetchTime
     *
     * @return int
     */
    public function getFetchTime(): ?int
    {
        return $this->fetchTime;
    }

    /**
     * Sets fetchTime
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
     * Gets deleteTime
     *
     * @return int
     */
    public function getDeleteTime(): ?int
    {
        return $this->deleteTime;
    }

    /**
     * Sets deleteTime
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
