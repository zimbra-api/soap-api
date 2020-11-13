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
use Zimbra\Enum\ReindexType;

/**
 * ReindexMailboxInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="mbox")
 */
class ReindexMailboxInfo
{
    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * @Accessor(getter="getTypes", setter="setTypes")
     * @SerializedName("types")
     * @Type("string")
     * @XmlAttribute
     */
    private $types;

    /**
     * @Accessor(getter="getIds", setter="setIds")
     * @SerializedName("ids")
     * @Type("string")
     * @XmlAttribute
     */
    private $ids;

    /**
     * Constructor method for ReindexMailboxInfo
     * @param string $id Account ID
     * @param string $types Comma separated list of types. Legal values are: conversation|message|contact|appointment|task|note|wiki|document
     * @param string $ids Comma separated list of IDs to re-index
     * @return self
     */
    public function __construct($id, $types = NULL, $ids = NULL)
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
    public function setId($id): self
    {
        $this->id = trim($id);
        return $this;
    }

    /**
     * Gets types
     *
     * @return string
     */
    public function getTypes(): string
    {
        return $this->types;
    }

    /**
     * Sets types
     *
     * @param  string $types
     * @return self
     */
    public function setTypes($types): self
    {
        $arrType = [];
        $types = explode(',', trim($types));
        foreach ($types as $type) {
            $type = trim($type);
            if (ReindexType::isValid($type) && !in_array($type, $arrType)) {
                $arrType[] = trim($type);
            }
        }
        $this->types = implode(',', $arrType);
        return $this;
    }

    /**
     * Sets the Standard Time component's timezone name
     *
     * @return string
     */
    public function getIds(): string
    {
        return $this->ids;
    }

    /**
     * Sets the Standard Time component's timezone name
     *
     * @param  string $ids
     * @return self
     */
    public function setIds($ids): self
    {
        $this->ids = trim($ids);
        return $this;
    }
}
