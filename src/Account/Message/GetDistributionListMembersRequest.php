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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetDistributionListMembersRequest extends SoapRequest
{
    /**
     * The number of members to return (0 is default and means all)
     * 
     * @var int
     */
    #[Accessor(getter: 'getLimit', setter: 'setLimit')]
    #[SerializedName('limit')]
    #[Type('int')]
    #[XmlAttribute]
    private $limit;

    /**
     * The starting offset (0, 25, etc)
     * 
     * @var int
     */
    #[Accessor(getter: 'getOffset', setter: 'setOffset')]
    #[SerializedName('offset')]
    #[Type('int')]
    #[XmlAttribute]
    private $offset;

    /**
     * The name of the distribution list
     * 
     * @var string
     */
    #[Accessor(getter: 'getDl', setter: 'setDl')]
    #[SerializedName('dl')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAccount')]
    private $dl;

    /**
     * Constructor
     * 
     * @param  string $dl
     * @param  int $limit
     * @param  int $offset
     * @return self
     */
    public function __construct(
        string $dl = '',
        ?int $limit = null,
        ?int $offset = null
    )
    {
        $this->setDl($dl);
        if (null !== $limit) {
            $this->setLimit($limit);
        }
        if (null !== $offset) {
            $this->setOffset($offset);
        }
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
     * Get the dl.
     *
     * @return string
     */
    public function getDl(): string
    {
        return $this->dl;
    }

    /**
     * Set the dl.
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetDistributionListMembersEnvelope(
            new GetDistributionListMembersBody($this)
        );
    }
}
