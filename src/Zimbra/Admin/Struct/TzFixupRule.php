<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * TzFixupRule struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="fixupRule")
 */
class TzFixupRule
{
    /**
     * @Accessor(getter="getMatch", setter="setMatch")
     * @SerializedName("match")
     * @Type("Zimbra\Admin\Struct\TZFixupRuleMatch")
     * @XmlElement
     */
    private $_match;

    /**
     * @Accessor(getter="getTouch", setter="setTouch")
     * @SerializedName("touch")
     * @Type("Zimbra\Admin\Struct\SimpleElement")
     * @XmlElement
     */
    private $_touch;

    /**
     * @Accessor(getter="getReplace", setter="setReplace")
     * @SerializedName("replace")
     * @Type("Zimbra\Admin\Struct\TzReplaceInfo")
     * @XmlElement
     */
    private $_replace;

    /**
     * Constructor method for TzFixupRule
     * @param TzFixupRuleMatch $match Match
     * @param SimpleElement $touch Need either "touch" or "replace" but not both 
     * @param TzReplaceInfo $replace Replace any matching timezone with this timezone. Need either "touch" or "replace" but not both.
     * @return self
     */
    public function __construct(
        TzFixupRuleMatch $match = NULL,
        SimpleElement $touch = NULL,
        TzReplaceInfo $replace = NULL
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
    public function getMatch()
    {
        return $this->_match;
    }

    /**
     * Sets the match.
     *
     * @param  TzFixupRuleMatch $match
     * @return self
     */
    public function setMatch(TzFixupRuleMatch $match)
    {
        $this->_match = $match;
        return $this;
    }

    /**
     * Gets the touch.
     *
     * @return SimpleElement
     */
    public function getTouch()
    {
        return $this->_touch;
    }

    /**
     * Sets the touch.
     *
     * @param  SimpleElement $touch
     * @return self
     */
    public function setTouch(SimpleElement $touch)
    {
        $this->_touch = $touch;
        return $this;
    }

    /**
     * Gets the replace.
     *
     * @return TzReplaceInfo
     */
    public function getReplace()
    {
        return $this->_replace;
    }

    /**
     * Sets the replace.
     *
     * @param  TzReplaceInfo $replace
     * @return self
     */
    public function setReplace(TzReplaceInfo $replace)
    {
        $this->_replace = $replace;
        return $this;
    }
}
