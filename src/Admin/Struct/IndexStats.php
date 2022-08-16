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
 * IndexStats struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class IndexStats
{
    /**
     * total number of docs in this index
     * 
     * @var int
     */
    #[Accessor(getter: 'getMaxDocs', setter: 'setMaxDocs')]
    #[SerializedName(name: 'maxDocs')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $maxDocs;

    /**
     * number of deleted docs for the index
     * 
     * @var int
     */
    #[Accessor(getter: 'getNumDeletedDocs', setter: 'setNumDeletedDocs')]
    #[SerializedName(name: 'deletedDocs')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $numDeletedDocs;

    /**
     * Constructor
     *
     * @param int $maxDocs
     * @param int $numDeletedDocs
     * @return self
     */
    public function __construct(int $maxDocs = 0, int $numDeletedDocs = 0)
    {
        $this->setMaxDocs($maxDocs)
             ->setNumDeletedDocs($numDeletedDocs);
    }

    /**
     * Get maxDocs
     *
     * @return int
     */
    public function getMaxDocs(): int
    {
        return $this->maxDocs;
    }

    /**
     * Set maxDocs
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
     * Set numDeletedDocs
     *
     * @return int
     */
    public function getNumDeletedDocs(): int
    {
        return $this->numDeletedDocs;
    }

    /**
     * Set numDeletedDocs
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
