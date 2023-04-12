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
     * @var TzFixupRuleMatch
     */
    #[Accessor(getter: 'getMatch', setter: 'setMatch')]
    #[SerializedName('match')]
    #[Type(TzFixupRuleMatch::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $match;

    /**
     * Need either "touch" or "replace" but not both 
     * 
     * @var SimpleElement
     */
    #[Accessor(getter: 'getTouch', setter: 'setTouch')]
    #[SerializedName('touch')]
    #[Type(SimpleElement::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $touch;

    /**
     * Replace any matching timezone with this timezone. Need either "touch" or "replace" but not both.
     * 
     * @var TzReplaceInfo
     */
    #[Accessor(getter: 'getReplace', setter: 'setReplace')]
    #[SerializedName('replace')]
    #[Type(TzReplaceInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $replace;

    /**
     * Constructor
     * 
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
