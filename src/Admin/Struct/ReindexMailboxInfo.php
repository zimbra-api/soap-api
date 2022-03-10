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
use Zimbra\Enum\ReindexType;

/**
 * ReindexMailboxInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ReindexMailboxInfo
{
    /**
     * Account ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Comma separated list of types. Legal values are: conversation|message|contact|appointment|task|note|wiki|document
     * @Accessor(getter="getTypes", setter="setTypes")
     * @SerializedName("types")
     * @Type("string")
     * @XmlAttribute
     */
    private $types;

    /**
     * Comma separated list of IDs to re-index
     * @Accessor(getter="getIds", setter="setIds")
     * @SerializedName("ids")
     * @Type("string")
     * @XmlAttribute
     */
    private $ids;

    /**
     * Constructor method for ReindexMailboxInfo
     * @param string $id
     * @param string $types
     * @param string $ids
     * @return self
     */
    public function __construct(string $id, ?string $types = NULL, ?string $ids = NULL)
    {
        $this->setId($id);
        if (NULL !== $types) {
            $this->setTypes($types);
        }
        if (NULL !== $ids) {
            $this->setIds($ids);
        }
    }

    /**
     * Gets ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets ID
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
     * Gets types
     *
     * @return string
     */
    public function getTypes(): ?string
    {
        return $this->types;
    }

    /**
     * Sets types
     *
     * @param  string $types
     * @return self
     */
    public function setTypes(string $types): self
    {
        $arrType = [];
        $types = explode(',', $types);
        foreach ($types as $type) {
            $type = trim($type);
            if (ReindexType::isValid($type) && !in_array($type, $arrType)) {
                $arrType[] = $type;
            }
        }
        $this->types = implode(',', $arrType);
        return $this;
    }

    /**
     * Sets ids
     *
     * @return string
     */
    public function getIds(): ?string
    {
        return $this->ids;
    }

    /**
     * Sets ids
     *
     * @param  string $ids
     * @return self
     */
    public function setIds(string $ids): self
    {
        $this->ids = $ids;
        return $this;
    }
}
