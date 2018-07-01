<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Enum\ReindexType;

/**
 * ReindexMailboxInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
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
    private $_id;

    /**
     * @Accessor(getter="getTypes", setter="setTypes")
     * @SerializedName("types")
     * @Type("string")
     * @XmlAttribute
     */
    private $_types;

    /**
     * @Accessor(getter="getIds", setter="setIds")
     * @SerializedName("ids")
     * @Type("string")
     * @XmlAttribute
     */
    private $_ids;

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
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Gets types
     *
     * @return string
     */
    public function getTypes()
    {
        return $this->_types;
    }

    /**
     * Sets types
     *
     * @param  string $types
     * @return self
     */
    public function setTypes($types)
    {
        $arrType = [];
        $types = explode(',', trim($types));
        foreach ($types as $type) {
            $type = trim($type);
            if (ReindexType::has($type) && !in_array($type, $arrType)) {
                $arrType[] = trim($type);
            }
        }
        $this->_types = implode(',', $arrType);
        return $this;
    }

    /**
     * Sets the Standard Time component's timezone name
     *
     * @return string
     */
    public function getIds()
    {
        return $this->_ids;
    }

    /**
     * Sets the Standard Time component's timezone name
     *
     * @param  string $ids
     * @return self
     */
    public function setIds($ids)
    {
        $this->_ids = trim($ids);
        return $this;
    }
}
