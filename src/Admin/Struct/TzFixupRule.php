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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};

/**
 * TzFixupRule struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TzFixupRule
{
    /**
     * Match
     *
     * @Accessor(getter="getMatch", setter="setMatch")
     * @SerializedName("match")
     * @Type("Zimbra\Admin\Struct\TzFixupRuleMatch")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var TzFixupRuleMatch
     */
    #[Accessor(getter: "getMatch", setter: "setMatch")]
    #[SerializedName("match")]
    #[Type(TzFixupRuleMatch::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?TzFixupRuleMatch $match;

    /**
     * Need either "touch" or "replace" but not both
     *
     * @Accessor(getter="getTouch", setter="setTouch")
     * @SerializedName("touch")
     * @Type("Zimbra\Admin\Struct\SimpleElement")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var SimpleElement
     */
    #[Accessor(getter: "getTouch", setter: "setTouch")]
    #[SerializedName("touch")]
    #[Type(SimpleElement::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?SimpleElement $touch;

    /**
     * Replace any matching timezone with this timezone. Need either "touch" or "replace" but not both.
     *
     * @Accessor(getter="getReplace", setter="setReplace")
     * @SerializedName("replace")
     * @Type("Zimbra\Admin\Struct\TzReplaceInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var TzReplaceInfo
     */
    #[Accessor(getter: "getReplace", setter: "setReplace")]
    #[SerializedName("replace")]
    #[Type(TzReplaceInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?TzReplaceInfo $replace;

    /**
     * Constructor
     *
     * @param TzFixupRuleMatch $match
     * @param SimpleElement $touch
     * @param TzReplaceInfo $replace
     * @return self
     */
    public function __construct(
        ?TzFixupRuleMatch $match = null,
        ?SimpleElement $touch = null,
        ?TzReplaceInfo $replace = null
    ) {
        $this->match = $match;
        $this->touch = $touch;
        $this->replace = $replace;
    }

    /**
     * Get the match.
     *
     * @return TzFixupRuleMatch
     */
    public function getMatch(): ?TzFixupRuleMatch
    {
        return $this->match;
    }

    /**
     * Set the match.
     *
     * @param  TzFixupRuleMatch $match
     * @return self
     */
    public function setMatch(TzFixupRuleMatch $match): self
    {
        $this->match = $match;
        return $this;
    }

    /**
     * Get the touch.
     *
     * @return SimpleElement
     */
    public function getTouch(): ?SimpleElement
    {
        return $this->touch;
    }

    /**
     * Set the touch.
     *
     * @param  SimpleElement $touch
     * @return self
     */
    public function setTouch(SimpleElement $touch): self
    {
        $this->touch = $touch;
        return $this;
    }

    /**
     * Get the replace.
     *
     * @return TzReplaceInfo
     */
    public function getReplace(): ?TzReplaceInfo
    {
        return $this->replace;
    }

    /**
     * Set the replace.
     *
     * @param  TzReplaceInfo $replace
     * @return self
     */
    public function setReplace(TzReplaceInfo $replace): self
    {
        $this->replace = $replace;
        return $this;
    }
}
