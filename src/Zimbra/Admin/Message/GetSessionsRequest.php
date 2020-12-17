<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\GetSessionsSortBy;
use Zimbra\Enum\SessionType;
use Zimbra\Soap\Request;

/**
 * GetSessionsRequest class
 * Get Quota Usage
 * The target server should be specified in the soap header (see soap.txt, targetServer).
 * When sorting by "quotaLimit", 0 is treated as the highest value possible.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetSessionsRequest")
 */
class GetSessionsRequest extends Request
{
    /**
     * Type - valid values soap|imap|admin
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Enum\SessionType")
     * @XmlAttribute
     */
    private $type;

    /**
     * SortBy - valid values: nameAsc|nameDesc|createdAsc|createdDesc|accessedAsc|accessedDesc
     * @Accessor(getter="getSortBy", setter="setSortBy")
     * @SerializedName("sortBy")
     * @Type("Zimbra\Enum\GetSessionsSortBy")
     * @XmlAttribute
     */
    private $sortBy;

    /**
     * Offset - the starting offset (0, 25, etc)
     * @Accessor(getter="getOffset", setter="setOffset")
     * @SerializedName("offset")
     * @Type("integer")
     * @XmlAttribute
     */
    private $offset;

    /**
     * Limit - the number of sessions to return per page (0 is default and means all)
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("integer")
     * @XmlAttribute
     */
    private $limit;

    /**
     * Refresh. If 1 (true), ignore any cached results and start fresh.
     * @Accessor(getter="getRefresh", setter="setRefresh")
     * @SerializedName("refresh")
     * @Type("bool")
     * @XmlAttribute
     */
    private $refresh;

    /**
     * Constructor method for GetSessionsRequest
     *
     * @param  SessionType $type
     * @param  string $sortBy
     * @param  int $offset
     * @param  int $limit
     * @param  boo $sortAscending
     * @param  boo $refresh
     * @return self
     */
    public function __construct(
        SessionType $type,
        ?GetSessionsSortBy $sortBy = NULL,
        ?int $offset = NULL,
        ?int $limit = NULL,
        ?bool $refresh = NULL
    )
    {
        $this->setType($type);
        if ($sortBy instanceof GetSessionsSortBy) {
            $this->setSortBy($sortBy);
        }
        if (NULL !== $offset) {
            $this->setOffset($offset);
        }
        if (NULL !== $limit) {
            $this->setLimit($limit);
        }
        if (NULL !== $refresh) {
            $this->setRefresh($refresh);
        }
    }

    /**
     * Gets type
     *
     * @return SessionType
     */
    public function getType(): SessionType
    {
        return $this->type;
    }

    /**
     * Sets type
     *
     * @param  SessionType $type
     * @return self
     */
    public function setType(SessionType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets limit
     *
     * @return int
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Sets limit
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
     * Gets offset
     *
     * @return int
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * Sets offset
     *
     * @param  int $offset
     * @return self
     */
    public function setOffset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * Gets sortBy
     *
     * @return GetSessionsSortBy
     */
    public function getSortBy(): ?GetSessionsSortBy
    {
        return $this->sortBy;
    }

    /**
     * Sets sortBy
     *
     * @param  GetSessionsSortBy $sortBy
     * @return self
     */
    public function setSortBy(GetSessionsSortBy $sortBy): self
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    /**
     * Gets refresh
     *
     * @return bool
     */
    public function getRefresh(): ?bool
    {
        return $this->refresh;
    }

    /**
     * Sets refresh
     *
     * @param  bool $refresh
     * @return self
     */
    public function setRefresh(bool $refresh): self
    {
        $this->refresh = $refresh;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetSessionsEnvelope)) {
            $this->envelope = new GetSessionsEnvelope(
                new GetSessionsBody($this)
            );
        }
    }
}
