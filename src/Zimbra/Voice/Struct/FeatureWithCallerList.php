<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Struct;

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * FeatureWithCallerList struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class FeatureWithCallerList extends CallFeatureInfo
{
    /**
     * Preferences
     * @var TypedSequence<CallerListEntry>
     */
    private $_phone;

    /**
     * Constructor method for FeatureWithCallerList
     * @param bool  $s
     * @param bool  $a
     * @param array $phone
     * @return self
     */
    public function __construct($s, $a, array $phone = array())
    {
    	parent::__construct($s, $a);
        $this->_phone = new TypedSequence('Zimbra\Voice\Struct\CallerListEntry', $phone);

        $this->addHook(function($sender)
        {
            if(count($sender->phone()))
            {
                $sender->child('phone', $sender->phone()->all());
            }
        });
    }


    /**
     * Add a phone
     *
     * @param  CallerListEntry $phone
     * @return self
     */
    public function addPhone(CallerListEntry $phone)
    {
        $this->_phone->add($phone);
        return $this;
    }

    /**
     * Gets phone sequence
     *
     * @return Sequence
     */
    public function phone()
    {
        return $this->_phone;
    }
}
