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
 * ActionResult class
 * Action response
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ActionResult
{
    /**
     * Comma-separated list of ids which have been successfully processed
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * Operation
     * 
     * @Accessor(getter="getOperation", setter="setOperation")
     * @SerializedName("op")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getOperation', setter: 'setOperation')]
    #[SerializedName(name: 'op')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $operation;

    /**
     * Comma-separated list of non-existent ids (if requested)
     * 
     * @Accessor(getter="getNonExistentIds", setter="setNonExistentIds")
     * @SerializedName("nei")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getNonExistentIds', setter: 'setNonExistentIds')]
    #[SerializedName(name: 'nei')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $nonExistentIds;

    /**
     * Comma-separated list of newly created ids (if requested)
     * 
     * @Accessor(getter="getNewlyCreatedIds", setter="setNewlyCreatedIds")
     * @SerializedName("nci")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getNewlyCreatedIds', setter: 'setNewlyCreatedIds')]
    #[SerializedName(name: 'nci')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $newlyCreatedIds;

    /**
     * Constructor
     *
     * @param  string $id
     * @param  string $operation
     * @param  string $nonExistentIds
     * @param  string $newlyCreatedIds
     * @return self
     */
    public function __construct(
        string $id = '',
        string $operation = '',
        ?string $nonExistentIds = NULL,
        ?string $newlyCreatedIds = NULL
    )
    {
        $this->setId($id)
             ->setOperation($operation);
        if (NULL !== $nonExistentIds) {
            $this->setNonExistentIds($nonExistentIds);
        }
        if (NULL !== $newlyCreatedIds) {
            $this->setNewlyCreatedIds($newlyCreatedIds);
        }
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get operation
     *
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * Set operation
     *
     * @param  string $operation
     * @return self
     */
    public function setOperation(string $operation): self
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     * Get nonExistentIds
     *
     * @return string
     */
    public function getNonExistentIds(): ?string
    {
        return $this->nonExistentIds;
    }

    /**
     * Set nonExistentIds
     *
     * @param  string $nonExistentIds
     * @return self
     */
    public function setNonExistentIds(string $nonExistentIds): self
    {
        $this->nonExistentIds = $nonExistentIds;
        return $this;
    }

    /**
     * Get newlyCreatedIds
     *
     * @return string
     */
    public function getNewlyCreatedIds(): ?string
    {
        return $this->newlyCreatedIds;
    }

    /**
     * Set newlyCreatedIds
     *
     * @param  string $newlyCreatedIds
     * @return self
     */
    public function setNewlyCreatedIds(string $newlyCreatedIds): self
    {
        $this->newlyCreatedIds = $newlyCreatedIds;
        return $this;
    }
}
