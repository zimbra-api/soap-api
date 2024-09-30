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
use Zimbra\Admin\Struct\GranteeSelector;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetAllEffectiveRightsRequest request class
 * Get all effective Admin rights
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllEffectiveRightsRequest extends SoapRequest
{
    const EXPAND_GET_ATTRS = "getAttrs";
    const EXPAND_SET_ATTRS = "setAttrs";

    /**
     * Expand all attributes
     *
     * @var string
     */
    #[Accessor(getter: "getExpandAllAttrs", setter: "setExpandAllAttrs")]
    #[SerializedName("expandAllAttrs")]
    #[Type("string")]
    #[XmlAttribute]
    private $expandAllAttrs;

    /**
     * Grantee
     *
     * @var GranteeSelector
     */
    #[Accessor(getter: "getGrantee", setter: "setGrantee")]
    #[SerializedName("grantee")]
    #[Type(GranteeSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?GranteeSelector $grantee;

    /**
     * Constructor
     *
     * @param  GranteeSelector $grantee
     * @param  bool $expandSetAttrs
     * @param  bool $expandGetAttrs
     * @return self
     */
    public function __construct(
        ?GranteeSelector $grantee = null,
        ?bool $expandSetAttrs = null,
        ?bool $expandGetAttrs = null
    ) {
        $this->grantee = $grantee;
        $attrs = [];
        if (null !== $expandSetAttrs) {
            $attrs[self::EXPAND_SET_ATTRS] = self::EXPAND_SET_ATTRS;
        }
        if (null !== $expandGetAttrs) {
            $attrs[self::EXPAND_GET_ATTRS] = self::EXPAND_GET_ATTRS;
        }
        if (!empty($attrs)) {
            $this->setExpandAllAttrs(implode(",", $attrs));
        }
    }

    /**
     * Get expandAllAttrs
     *
     * @return string
     */
    public function getExpandAllAttrs(): ?string
    {
        return $this->expandAllAttrs;
    }

    /**
     * Set expandAllAttrs
     *
     * @param  string $expandAllAttrs
     * @return self
     */
    public function setExpandAllAttrs(string $expandAllAttrs): self
    {
        $this->expandAllAttrs = "";
        $attrs = [];
        foreach (explode(",", $expandAllAttrs) as $attr) {
            if ($attr === self::EXPAND_SET_ATTRS) {
                $attrs[self::EXPAND_SET_ATTRS] = self::EXPAND_SET_ATTRS;
            }
            if ($attr === self::EXPAND_GET_ATTRS) {
                $attrs[self::EXPAND_GET_ATTRS] = self::EXPAND_GET_ATTRS;
            }
        }
        if (!empty($attrs)) {
            $this->expandAllAttrs = implode(",", $attrs);
        }
        return $this;
    }

    /**
     * Set the grantee.
     *
     * @return GranteeSelector
     */
    public function getGrantee(): ?GranteeSelector
    {
        return $this->grantee;
    }

    /**
     * Set the grantee.
     *
     * @param  GranteeSelector $grantee
     * @return self
     */
    public function setGrantee(GranteeSelector $grantee): self
    {
        $this->grantee = $grantee;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetAllEffectiveRightsEnvelope(
            new GetAllEffectiveRightsBody($this)
        );
    }
}
