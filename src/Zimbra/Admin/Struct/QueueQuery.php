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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};

/**
 * QueueQuery struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="query")
 */
class QueueQuery
{
    /**
     * Queue query field
     * 
     * @Accessor(getter="getFields", setter="setFields")
     * @SerializedName("field")
     * @Type("array<Zimbra\Admin\Struct\QueueQueryField>")
     * @XmlList(inline = true, entry = "field")
     */
    private $fields;

    /**
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("integer")
     * @XmlAttribute
     */
    private $limit;

    /**
     * @Accessor(getter="getOffset", setter="setOffset")
     * @SerializedName("offset")
     * @Type("integer")
     * @XmlAttribute
     */
    private $offset;

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
    public function addField(QueueQueryField $field): self
    {
        $this->fields[] = $field;
        return $this;
    }

    /**
     * Sets field sequence
     *
     * @param  array $fields
     * @return self
     */
    public function setFields(array $fields): self
    {
        $this->fields = [];
        foreach ($fields as $field) {
            if ($field instanceof QueueQueryField) {
                $this->fields[] = $field;
            }
        }
        return $this;
    }

    /**
     * Gets field sequence
     *
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Gets the limit
     *
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * Sets the limit
     *
     * @param  int $limit
     * @return self
     */
    public function setLimit($limit): self
    {
        $this->limit = (int) $limit;
        return $this;
    }

    /**
     * Gets the offset
     *
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Sets the offset
     *
     * @param  int $offset
     * @return self
     */
    public function setOffset($offset): self
    {
        $this->offset = (int) $offset;
        return $this;
    }
}