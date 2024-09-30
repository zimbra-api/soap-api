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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetRightRequest class
 * Get definition of a right
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetRightRequest extends SoapRequest
{
    /**
     * whether to include all attribute names in the <attrs> elements in the response if the right is meant for all attributes
     * 0 (false) [default]: do not include all attribute names in the <attrs> elements
     * 1 (true): include all attribute names in the <attrs> elements
     *
     * @Accessor(getter="getExpandAllAttrs", setter="setExpandAllAttrs")
     * @SerializedName("expandAllAttrs")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getExpandAllAttrs", setter: "setExpandAllAttrs")]
    #[SerializedName("expandAllAttrs")]
    #[Type("bool")]
    #[XmlAttribute]
    private $expandAllAttrs;

    /**
     * Right name
     *
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     *
     * @var string
     */
    #[Accessor(getter: "getRight", setter: "setRight")]
    #[SerializedName("right")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAdmin")]
    private $right;

    /**
     * Constructor
     *
     * @param  string $right
     * @param  bool $expandAllAttrs
     * @return self
     */
    public function __construct(
        string $right = "",
        ?bool $expandAllAttrs = null
    ) {
        $this->setRight($right);
        if (null !== $expandAllAttrs) {
            $this->setExpandAllAttrs($expandAllAttrs);
        }
    }

    /**
     * Get right
     *
     * @return string
     */
    public function getRight(): string
    {
        return $this->right;
    }

    /**
     * Set right
     *
     * @param  string $right
     * @return self
     */
    public function setRight(string $right): self
    {
        $this->right = $right;
        return $this;
    }

    /**
     * Get expandAllAttrs
     *
     * @return bool
     */
    public function getExpandAllAttrs(): ?bool
    {
        return $this->expandAllAttrs;
    }

    /**
     * Set expandAllAttrs
     *
     * @param  bool $expandAllAttrs
     * @return self
     */
    public function setExpandAllAttrs(bool $expandAllAttrs): self
    {
        $this->expandAllAttrs = $expandAllAttrs;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetRightEnvelope(new GetRightBody($this));
    }
}
