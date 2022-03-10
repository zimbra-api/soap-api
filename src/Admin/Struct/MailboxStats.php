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
 * MailboxStats class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MailboxStats
{
    /**
     * Total number of mailboxes
     * @Accessor(getter="getNumMboxes", setter="setNumMboxes")
     * @SerializedName("numMboxes")
     * @Type("integer")
     * @XmlAttribute
     */
    private $numMboxes;

    /**
     * Total size of all mailboxes
     * @Accessor(getter="getTotalSize", setter="setTotalSize")
     * @SerializedName("totalSize")
     * @Type("integer")
     * @XmlAttribute
     */
    private $totalSize;

    /**
     * Constructor method for MailboxStats
     *
     * @param int $numMboxes
     * @param int $totalSize
     * @return self
     */
    public function __construct(
        int $numMboxes,
        int $totalSize
    )
    {
        $this->setNumMboxes($numMboxes)
             ->setTotalSize($totalSize);
    }

    /**
     * Gets numMboxes
     *
     * @return int
     */
    public function getNumMboxes(): int
    {
        return $this->numMboxes;
    }

    /**
     * Sets numMboxes
     *
     * @param  int $target
     * @return self
     */
    public function setNumMboxes(int $numMboxes): self
    {
        $this->numMboxes = $numMboxes;
        return $this;
    }

    /**
     * Gets totalSize
     *
     * @return int
     */
    public function getTotalSize(): int
    {
        return $this->totalSize;
    }

    /**
     * Sets totalSize
     *
     * @param  int $totalSize
     * @return self
     */
    public function setTotalSize(int $totalSize): self
    {
        $this->totalSize = $totalSize;
        return $this;
    }
}
