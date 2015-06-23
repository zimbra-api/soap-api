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

use Zimbra\Struct\Base;

/**
 * TzFixupRule struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class TzFixupRule extends Base
{
    /**
     * Constructor method for TzFixupRule
     * @param TzFixupRuleMatch $match Match
     * @param SimpleElement $touch Need either "touch" or "replace" but not both 
     * @param TzReplaceInfo $replace Replace any matching timezone with this timezone. Need either "touch" or "replace" but not both.
     * @return self
     */
    public function __construct(
        TzFixupRuleMatch $match = null,
        SimpleElement $touch = null,
        TzReplaceInfo $replace = null
    )
    {
        parent::__construct();
        if($match instanceof TzFixupRuleMatch)
        {
            $this->setChild('match', $match);
        }
        if($touch instanceof SimpleElement)
        {
            $this->setChild('touch', $touch);
        }
        if($replace instanceof TzReplaceInfo)
        {
            $this->setChild('replace', $replace);
        }
    }

    /**
     * Gets the match.
     *
     * @return TzFixupRuleMatch
     */
    public function getMatch()
    {
        return $this->getChild('match');
    }

    /**
     * Sets the match.
     *
     * @param  TzFixupRuleMatch $match
     * @return self
     */
    public function setMatch(TzFixupRuleMatch $match)
    {
        return $this->setChild('match', $match);
    }

    /**
     * Gets the touch.
     *
     * @return SimpleElement
     */
    public function getTouch()
    {
        return $this->getChild('touch');
    }

    /**
     * Sets the touch.
     *
     * @param  SimpleElement $touch
     * @return self
     */
    public function setTouch(SimpleElement $touch)
    {
        return $this->setChild('touch', $touch);
    }

    /**
     * Gets the replace.
     *
     * @return TzReplaceInfo
     */
    public function getReplace()
    {
        return $this->getChild('replace');
    }

    /**
     * Sets the replace.
     *
     * @param  TzReplaceInfo $replace
     * @return self
     */
    public function setReplace(TzReplaceInfo $replace)
    {
        return $this->setChild('replace', $replace);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'fixupRule')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'fixupRule')
    {
        return parent::toXml($name);
    }
}
