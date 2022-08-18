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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
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
     * 
     * @var string
     */
    #[Accessor(getter: 'getListOfCreatedIds', setter: 'setListOfCreatedIds')]
    #[SerializedName('ids')]
    #[Type('string')]
    #[XmlAttribute]
    private $listOfCreatedIds;

    /**
     * Number imported
     * 
     * @Accessor(getter="getNumImported", setter="setNumImported")
     * @SerializedName("n")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getNumImported', setter: 'setNumImported')]
    #[SerializedName('n')]
    #[Type('int')]
    #[XmlAttribute]
    private $numImported;

    /**
     * Constructor
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
     * Get listOfCreatedIds
     *
     * @return string
     */
    public function getListOfCreatedIds(): string
    {
        return $this->listOfCreatedIds;
    }

    /**
     * Set listOfCreatedIds
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
     * Get numImported
     *
     * @return int
     */
    public function getNumImported(): int
    {
        return $this->numImported;
    }

    /**
     * Set numImported
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
