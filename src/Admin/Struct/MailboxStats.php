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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MailboxStats
{
    /**
     * Total number of mailboxes
     *
     * @var int
     */
    #[Accessor(getter: "getNumMboxes", setter: "setNumMboxes")]
    #[SerializedName("numMboxes")]
    #[Type("int")]
    #[XmlAttribute]
    private $numMboxes;

    /**
     * Total size of all mailboxes
     *
     * @var int
     */
    #[Accessor(getter: "getTotalSize", setter: "setTotalSize")]
    #[SerializedName("totalSize")]
    #[Type("int")]
    #[XmlAttribute]
    private $totalSize;

    /**
     * Constructor
     *
     * @param int $numMboxes
     * @param int $totalSize
     * @return self
     */
    public function __construct(int $numMboxes = 0, int $totalSize = 0)
    {
        $this->setNumMboxes($numMboxes)->setTotalSize($totalSize);
    }

    /**
     * Get numMboxes
     *
     * @return int
     */
    public function getNumMboxes(): int
    {
        return $this->numMboxes;
    }

    /**
     * Set numMboxes
     *
     * @param  int $numMboxes
     * @return self
     */
    public function setNumMboxes(int $numMboxes): self
    {
        $this->numMboxes = $numMboxes;
        return $this;
    }

    /**
     * Get totalSize
     *
     * @return int
     */
    public function getTotalSize(): int
    {
        return $this->totalSize;
    }

    /**
     * Set totalSize
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
