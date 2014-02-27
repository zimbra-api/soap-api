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

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * TzFixup struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class TzFixup extends Base
{
    /**
     * Attributes
     * @var TypedSequence<TzFixupRule>
     */
    private $_fixupRule;

    /**
     * Constructor method for TzFixup
     * @param array $fixupRule
     * @return self
     */
    public function __construct(array $fixupRule = array())
    {
        parent::__construct();
        $this->_fixupRule = new TypedSequence('Zimbra\Admin\Struct\TzFixupRule', $fixupRule);

        $this->on('before', function(Base $sender)
        {
            if($sender->fixupRule()->count())
            {
                $sender->child('fixupRule', $sender->fixupRule()->all());
            }
        });
    }

    /**
     * Add fixup rule
     *
     * @param  TzFixupRule $fixupRule
     * @return self
     */
    public function addFixupRule(TzFixupRule $fixupRule)
    {
        $this->_fixupRule->add($fixupRule);
        return $this;
    }

    /**
     * Get WaitSet sequence
     *
     * @return TypedSequence<TzFixupRule>
     */
    public function fixupRule()
    {
        return $this->_fixupRule;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'tzfixup')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'tzfixup')
    {
        return parent::toXml($name);
    }
}
