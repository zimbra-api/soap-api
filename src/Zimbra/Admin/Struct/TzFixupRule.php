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
            $this->child('match', $match);
        }
        if($touch instanceof SimpleElement)
        {
            $this->child('touch', $touch);
        }
        if($replace instanceof TzReplaceInfo)
        {
            $this->child('replace', $replace);
        }
    }

    /**
     * Gets or sets match
     *
     * @param  TzFixupRuleMatch $match
     * @return TzFixupRuleMatch|self
     */
    public function match(TzFixupRuleMatch $match = null)
    {
        if(null === $match)
        {
            return $this->child('match');
        }
        return $this->child('match', $match);
    }

    /**
     * Gets or sets touch
     *
     * @param  SimpleElement $touch
     * @return SimpleElement|self
     */
    public function touch(SimpleElement $touch = null)
    {
        if(null === $touch)
        {
            return $this->child('touch');
        }
        return $this->child('touch', $touch);
    }

    /**
     * Gets or sets replace
     *
     * @param  TzReplaceInfo $replace
     * @return TzReplaceInfo|self
     */
    public function replace(TzReplaceInfo $replace = null)
    {
        if(null === $replace)
        {
            return $this->child('replace');
        }
        return $this->child('replace', $replace);
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
