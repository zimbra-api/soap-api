<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * ImportContact class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ImportContact
{
    /**
     * Comma-separated list of created IDs
     * 
     * @Accessor(getter="getListOfCreatedIds", setter="setListOfCreatedIds")
     * @SerializedName("ids")
     * @Type("string")
     * @XmlAttribute
     */
    private $listOfCreatedIds;

    /**
     * Number imported
     * 
     * @Accessor(getter="getNumImported", setter="setNumImported")
     * @SerializedName("n")
     * @Type("integer")
     * @XmlAttribute
     */
    private $numImported;

    /**
     * Constructor method for ImportContact
     *
     * @param  string $listOfCreatedIds
     * @param  int $numImported
     * @return self
     */
    public function __construct(
        ?string $listOfCreatedIds = NULL, ?int $numImported = NULL
    )
    {
        if (NULL !== $listOfCreatedIds) {
            $this->setListOfCreatedIds($listOfCreatedIds);
        }
        if (NULL !== $numImported) {
            $this->setNumImported($numImported);
        }
    }

    /**
     * Gets listOfCreatedIds
     *
     * @return string
     */
    public function getListOfCreatedIds(): string
    {
        return $this->listOfCreatedIds;
    }

    /**
     * Sets listOfCreatedIds
     *
     * @param  string $listOfCreatedIds
     * @return self
     */
    public function setListOfCreatedIds(string $listOfCreatedIds): self
    {
        $this->listOfCreatedIds = $listOfCreatedIds;
        return $this;
    }

    /**
     * Gets numImported
     *
     * @return int
     */
    public function getNumImported(): int
    {
        return $this->numImported;
    }

    /**
     * Sets numImported
     *
     * @param  int $numImported
     * @return self
     */
    public function setNumImported(int $numImported): self
    {
        $this->numImported = $numImported;
        return $this;
    }
}
