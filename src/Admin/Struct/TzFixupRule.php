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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class TzFixupRule
{
    /**
     * Match
     * @Accessor(getter="getMatch", setter="setMatch")
     * @SerializedName("match")
     * @Type("Zimbra\Admin\Struct\TZFixupRuleMatch")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?TZFixupRuleMatch $match = NULL;

    /**
     * Need either "touch" or "replace" but not both 
     * @Accessor(getter="getTouch", setter="setTouch")
     * @SerializedName("touch")
     * @Type("Zimbra\Admin\Struct\SimpleElement")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?SimpleElement $touch = NULL;

    /**
     * Replace any matching timezone with this timezone. Need either "touch" or "replace" but not both.
     * @Accessor(getter="getReplace", setter="setReplace")
     * @SerializedName("replace")
     * @Type("Zimbra\Admin\Struct\TzReplaceInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?TzReplaceInfo $replace = NULL;

    /**
     * Constructor method for TzFixupRule
     * @param TzFixupRuleMatch $match
     * @param SimpleElement $touch
     * @param TzReplaceInfo $replace
     * @return self
     */
    public function __construct(
        ?TzFixupRuleMatch $match = NULL,
        ?SimpleElement $touch = NULL,
        ?TzReplaceInfo $replace = NULL
    )
    {
        if ($match instanceof TzFixupRuleMatch) {
            $this->setMatch($match);
        }
        if ($touch instanceof SimpleElement) {
            $this->setTouch($touch);
        }
        if ($replace instanceof TzReplaceInfo) {
            $this->setReplace($replace);
        }
    }

    /**
     * Gets the match.
     *
     * @return TzFixupRuleMatch
     */
    public function getMatch(): ?TzFixupRuleMatch
    {
        return $this->match;
    }

    /**
     * Sets the match.
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
     * Gets the touch.
     *
     * @return SimpleElement
     */
    public function getTouch(): ?SimpleElement
    {
        return $this->touch;
    }

    /**
     * Sets the touch.
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
     * Gets the replace.
     *
     * @return TzReplaceInfo
     */
    public function getReplace(): ?TzReplaceInfo
    {
        return $this->replace;
    }

    /**
     * Sets the replace.
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
