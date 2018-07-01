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
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * QueueQuery struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="query")
 */
class QueueQuery
{
    /**
     * Queue query field
     * @Accessor(getter="getFields", setter="setFields")
     * @Type("array<Zimbra\Admin\Struct\QueueQueryField>")
     * @XmlList(inline = true, entry = "field")
     */
    private $_fields;

    /**
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_limit;

    /**
     * @Accessor(getter="getOffset", setter="setOffset")
     * @SerializedName("offset")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_offset;

    /**
     * Constructor method for QueueQuery
     * @param  array $fields Queue query field
     * @param  int $limit Limit the number of queue items to return in the response
     * @param  int $offset Offset
     * @return self
     */
    public function __construct(array $fields = [], $limit = NULL, $offset = NULL)
    {
        $this->setFields($fields);
        if (NULL !== $limit) {
            $this->setLimit($limit);
        }
        if (NULL !== $offset) {
            $this->setOffset($offset);
        }
    }

    /**
     * Add a field
     *
     * @param  QueueQueryField $field
     * @return self
     */
    public function addField(QueueQueryField $field)
    {
        $this->_fields[] = $field;
        return $this;
    }

    /**
     * Sets field sequence
     *
     * @param  array $fields
     * @return self
     */
    public function setFields(array $fields)
    {
        $this->_fields = [];
        foreach ($fields as $field) {
            if ($field instanceof QueueQueryField) {
                $this->_fields[] = $field;
            }
        }
        return $this;
    }

    /**
     * Gets field sequence
     *
     * @return array
     */
    public function getFields()
    {
        return $this->_fields;
    }

    /**
     * Gets the limit
     *
     * @return int
     */
    public function getLimit()
    {
        return $this->_limit;
    }

    /**
     * Sets the limit
     *
     * @param  int $limit
     * @return self
     */
    public function setLimit($limit)
    {
        $this->_limit = (int) $limit;
        return $this;
    }

    /**
     * Gets the offset
     *
     * @return int
     */
    public function getOffset()
    {
        return $this->_offset;
    }

    /**
     * Sets the offset
     *
     * @param  int $offset
     * @return self
     */
    public function setOffset($offset)
    {
        $this->_offset = (int) $offset;
        return $this;
    }
}