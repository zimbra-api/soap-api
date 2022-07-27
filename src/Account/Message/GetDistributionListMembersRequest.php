<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetDistributionListMembersRequest class
 * Get the list of members of a distribution list.
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetDistributionListMembersRequest extends SoapRequest
{
    /**
     * The number of members to return (0 is default and means all)
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("integer")
     * @XmlAttribute
     */
    private $limit;

    /**
     * The starting offset (0, 25, etc)
     * @Accessor(getter="getOffset", setter="setOffset")
     * @SerializedName("offset")
     * @Type("integer")
     * @XmlAttribute
     */
    private $offset;

    /**
     * The name of the distribution list
     * @Accessor(getter="getDl", setter="setDl")
     * @SerializedName("dl")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $dl;

    /**
     * Constructor method for GetDistributionListMembersRequest
     * 
     * @param  string $dl
     * @param  int $limit
     * @param  int $offset
     * @return self
     */
    public function __construct(
        string $dl = '',
        ?int $limit = NULL,
        ?int $offset = NULL
    )
    {
        $this->setDl($dl);
        if (NULL !== $limit) {
            $this->setLimit($limit);
        }
        if (NULL !== $offset) {
            $this->setOffset($offset);
        }
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
     * Gets the dl.
     *
     * @return string
     */
    public function getDl(): string
    {
        return $this->dl;
    }

    /**
     * Sets the dl.
     *
     * @param  string $dl
     * @return self
     */
    public function setDl(string $dl): self
    {
        $this->dl = $dl;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetDistributionListMembersEnvelope(
            new GetDistributionListMembersBody($this)
        );
    }
}
