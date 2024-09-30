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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\{GetSessionsSortBy, SessionType};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetSessionsRequest class
 * Get Sessions
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetSessionsRequest extends SoapRequest
{
    /**
     * Type - valid values soap|imap|admin
     *
     * @var SessionType
     */
    #[Accessor(getter: "getType", setter: "setType")]
    #[SerializedName("type")]
    #[XmlAttribute]
    private SessionType $type;

    /**
     * SortBy - valid values: nameAsc|nameDesc|createdAsc|createdDesc|accessedAsc|accessedDesc
     *
     * @var GetSessionsSortBy
     */
    #[Accessor(getter: "getSortBy", setter: "setSortBy")]
    #[SerializedName("sortBy")]
    #[XmlAttribute]
    private ?GetSessionsSortBy $sortBy;

    /**
     * Offset - the starting offset (0, 25, etc)
     *
     * @var int
     */
    #[Accessor(getter: "getOffset", setter: "setOffset")]
    #[SerializedName("offset")]
    #[Type("int")]
    #[XmlAttribute]
    private $offset;

    /**
     * Limit - the number of sessions to return per page (0 is default and means all)
     *
     * @var int
     */
    #[Accessor(getter: "getLimit", setter: "setLimit")]
    #[SerializedName("limit")]
    #[Type("int")]
    #[XmlAttribute]
    private $limit;

    /**
     * Refresh. If 1 (true), ignore any cached results and start fresh.
     *
     * @var bool
     */
    #[Accessor(getter: "getRefresh", setter: "setRefresh")]
    #[SerializedName("refresh")]
    #[Type("bool")]
    #[XmlAttribute]
    private $refresh;

    /**
     * Constructor
     *
     * @param  SessionType $type
     * @param  GetSessionsSortBy $sortBy
     * @param  int $offset
     * @param  int $limit
     * @param  bool $refresh
     * @return self
     */
    public function __construct(
        ?SessionType $type = null,
        ?GetSessionsSortBy $sortBy = null,
        ?int $offset = null,
        ?int $limit = null,
        ?bool $refresh = null
    ) {
        $this->setType($type ?? SessionType::SOAP);
        $this->sortBy = $sortBy;
        if (null !== $offset) {
            $this->setOffset($offset);
        }
        if (null !== $limit) {
            $this->setLimit($limit);
        }
        if (null !== $refresh) {
            $this->setRefresh($refresh);
        }
    }

    /**
     * Get type
     *
     * @return SessionType
     */
    public function getType(): SessionType
    {
        return $this->type;
    }

    /**
     * Set type
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
     * Get limit
     *
     * @return int
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Set limit
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
     * Get offset
     *
     * @return int
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * Set offset
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
     * Get sortBy
     *
     * @return GetSessionsSortBy
     */
    public function getSortBy(): ?GetSessionsSortBy
    {
        return $this->sortBy;
    }

    /**
     * Set sortBy
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
     * Get refresh
     *
     * @return bool
     */
    public function getRefresh(): ?bool
    {
        return $this->refresh;
    }

    /**
     * Set refresh
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetSessionsEnvelope(new GetSessionsBody($this));
    }
}
