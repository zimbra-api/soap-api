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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * QueueQuery struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class QueueQuery
{
    /**
     * Queue query field
     * 
     * @Accessor(getter="getFields", setter="setFields")
     * @Type("array<Zimbra\Admin\Struct\QueueQueryField>")
     * @XmlList(inline=true, entry="field", namespace="urn:zimbraAdmin")
     */
    private $fields = [];

    /**
     * Limit the number of queue items to return in the response
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("integer")
     * @XmlAttribute
     */
    private $limit;

    /**
     * Offset
     * @Accessor(getter="getOffset", setter="setOffset")
     * @SerializedName("offset")
     * @Type("integer")
     * @XmlAttribute
     */
    private $offset;

    /**
     * Constructor method for QueueQuery
     * @param  array $fields
     * @param  int $limit
     * @param  int $offset
     * @return self
     */
    public function __construct(array $fields = [], ?int $limit = NULL, ?int $offset = NULL)
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
     * Set field sequence
     *
     * @param  array $fields
     * @return self
     */
    public function setFields(array $fields): self
    {
        $this->fields = array_filter($fields, static fn ($field) => $field instanceof QueueQueryField);
        return $this;
    }

    /**
     * Get field sequence
     *
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Get the limit
     *
     * @return int
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Set the limit
     *
     * @param  int $limit
     * @return self
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Get the offset
     *
     * @return int
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * Set the offset
     *
     * @param  int $offset
     * @return self
     */
    public function setOffset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }
}