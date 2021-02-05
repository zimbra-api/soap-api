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
 * IndexStats struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="stats")
 */
class IndexStats
{
    /**
     * total number of docs in this index
     * @Accessor(getter="getMaxDocs", setter="setMaxDocs")
     * @SerializedName("maxDocs")
     * @Type("integer")
     * @XmlAttribute
     */
    private $maxDocs;

    /**
     * number of deleted docs for the index
     * @Accessor(getter="getNumDeletedDocs", setter="setNumDeletedDocs")
     * @SerializedName("deletedDocs")
     * @Type("integer")
     * @XmlAttribute
     */
    private $numDeletedDocs;

    /**
     * Constructor method for IndexStats
     *
     * @param int $maxDocs
     * @param string $numDeletedDocs
     * @return self
     */
    public function __construct(int $maxDocs, int $numDeletedDocs)
    {
        $this->setMaxDocs($maxDocs)
            ->setNumDeletedDocs($numDeletedDocs);
    }

    /**
     * Gets maxDocs
     *
     * @return int
     */
    public function getMaxDocs(): int
    {
        return $this->maxDocs;
    }

    /**
     * Sets maxDocs
     *
     * @param  int $maxDocs
     * @return self
     */
    public function setMaxDocs(int $maxDocs): self
    {
        $this->maxDocs = $maxDocs;
        return $this;
    }

    /**
     * Sets numDeletedDocs
     *
     * @return int
     */
    public function getNumDeletedDocs(): int
    {
        return $this->numDeletedDocs;
    }

    /**
     * Sets numDeletedDocs
     *
     * @param  int $numDeletedDocs
     * @return self
     */
    public function setNumDeletedDocs(int $numDeletedDocs): self
    {
        $this->numDeletedDocs = $numDeletedDocs;
        return $this;
    }
}