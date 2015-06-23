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
    private $_fixupRules;

    /**
     * Constructor method for TzFixup
     * @param array $fixupRules
     * @return self
     */
    public function __construct(array $fixupRules = [])
    {
        parent::__construct();
        $this->setFixupRules($fixupRules);

        $this->on('before', function(Base $sender)
        {
            if($sender->getFixupRules()->count())
            {
                $sender->setChild('fixupRule', $sender->getFixupRules()->all());
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
        $this->_fixupRules->add($fixupRule);
        return $this;
    }

    /**
     * Sets fixup rule sequence
     *
     * @param array $fixupRules
     * @return self
     */
    public function setFixupRules(array $fixupRules)
    {
        $this->_fixupRules = new TypedSequence('Zimbra\Admin\Struct\TzFixupRule', $fixupRules);
        return $this;
    }

    /**
     * Gets fixup rule sequence
     *
     * @return TypedSequence<TzFixupRule>
     */
    public function getFixupRules()
    {
        return $this->_fixupRules;
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
