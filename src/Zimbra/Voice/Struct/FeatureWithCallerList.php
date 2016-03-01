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
     * Phones
     * @var TypedSequence<CallerListEntry>
     */
    private $_phones;

    /**
     * Constructor method for FeatureWithCallerList
     * @param bool $subscribed Flag whether subscribed or not
     * @param bool $active Flag whether active or not
     * @param array $phones
     * @return self
     */
    public function __construct($subscribed, $active, array $phones = [])
    {
    	parent::__construct($subscribed, $active);
        $this->setPhones($phones);

        $this->on('before', function(Base $sender)
        {
            if($sender->getPhones()->count())
            {
                $sender->setChild('phone', $sender->getPhones()->all());
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
        $this->_phones->add($phone);
        return $this;
    }

    /**
     * Sets phone sequence
     *
     * @param array $phones
     * @return self
     */
    public function setPhones(array $phones)
    {
        $this->_phones = new TypedSequence('Zimbra\Voice\Struct\CallerListEntry', $phones);
        return $this;
    }

    /**
     * Gets phone sequence
     *
     * @return Sequence
     */
    public function getPhones()
    {
        return $this->_phones;
    }
}
