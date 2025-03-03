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
 * ReindexProgressInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ReindexProgressInfo
{
    /**
     * Number of reindexes that succeeded
     *
     * @var int
     */
    #[Accessor(getter: "getNumSucceeded", setter: "setNumSucceeded")]
    #[SerializedName("numSucceeded")]
    #[Type("int")]
    #[XmlAttribute]
    private int $numSucceeded;

    /**
     * Number of reindexes that failed
     *
     * @var int
     */
    #[Accessor(getter: "getNumFailed", setter: "setNumFailed")]
    #[SerializedName("numFailed")]
    #[Type("int")]
    #[XmlAttribute]
    private int $numFailed;

    /**
     * Number of reindexes that remaining
     *
     * @var int
     */
    #[Accessor(getter: "getNumRemaining", setter: "setNumRemaining")]
    #[SerializedName("numRemaining")]
    #[Type("int")]
    #[XmlAttribute]
    private int $numRemaining;

    /**
     * Constructor
     *
     * @param int $numSucceeded
     * @param int $numFailed
     * @param int $numRemaining
     * @return self
     */
    public function __construct(
        int $numSucceeded = 0,
        int $numFailed = 0,
        int $numRemaining = 0
    ) {
        $this->setNumSucceeded($numSucceeded)
            ->setNumFailed($numFailed)
            ->setNumRemaining($numRemaining);
    }

    /**
     * Get numSucceeded
     *
     * @return int
     */
    public function getNumSucceeded(): int
    {
        return $this->numSucceeded;
    }

    /**
     * Set numSucceeded
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
     * Set numFailed
     *
     * @return int
     */
    public function getNumFailed(): int
    {
        return $this->numFailed;
    }

    /**
     * Set numFailed
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
     * Set numRemaining
     *
     * @return int
     */
    public function getNumRemaining(): int
    {
        return $this->numRemaining;
    }

    /**
     * Set numRemaining
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
