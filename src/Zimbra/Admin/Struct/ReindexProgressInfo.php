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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * ReindexProgressInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="progress")
 */
class ReindexProgressInfo
{
    /**
     * Number of reindexes that succeeded
     * @Accessor(getter="getNumSucceeded", setter="setNumSucceeded")
     * @SerializedName("numSucceeded")
     * @Type("integer")
     * @XmlAttribute
     */
    private $numSucceeded;

    /**
     * Number of reindexes that failed
     * @Accessor(getter="getNumFailed", setter="setNumFailed")
     * @SerializedName("numFailed")
     * @Type("integer")
     * @XmlAttribute
     */
    private $numFailed;

    /**
     * Number of reindexes that remaining
     * @Accessor(getter="getNumRemaining", setter="setNumRemaining")
     * @SerializedName("numRemaining")
     * @Type("integer")
     * @XmlAttribute
     */
    private $numRemaining;

    /**
     * Constructor method for ReindexProgressInfo
     *
     * @param int $numSucceeded
     * @param string $numFailed
     * @param string $numRemaining
     * @return self
     */
    public function __construct(
        int $numSucceeded, int $numFailed, int $numRemaining
    )
    {
        $this->setNumSucceeded($numSucceeded)
            ->setNumFailed($numFailed)
            ->setNumRemaining($numRemaining);
    }

    /**
     * Gets numSucceeded
     *
     * @return int
     */
    public function getNumSucceeded(): int
    {
        return $this->numSucceeded;
    }

    /**
     * Sets numSucceeded
     *
     * @param  int $numSucceeded
     * @return self
     */
    public function setNumSucceeded(int $numSucceeded): self
    {
        $this->numSucceeded = $numSucceeded;
        return $this;
    }

    /**
     * Sets numFailed
     *
     * @return int
     */
    public function getNumFailed(): int
    {
        return $this->numFailed;
    }

    /**
     * Sets numFailed
     *
     * @param  int $numFailed
     * @return self
     */
    public function setNumFailed(int $numFailed): self
    {
        $this->numFailed = $numFailed;
        return $this;
    }

    /**
     * Sets numRemaining
     *
     * @return int
     */
    public function getNumRemaining(): int
    {
        return $this->numRemaining;
    }

    /**
     * Sets numRemaining
     *
     * @param  int $numRemaining
     * @return self
     */
    public function setNumRemaining(int $numRemaining): self
    {
        $this->numRemaining = $numRemaining;
        return $this;
    }
}
