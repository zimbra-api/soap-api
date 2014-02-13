<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Request;

use Zimbra\Common\TypedSequence;
use Zimbra\Voice\Struct\PhoneSpec;

/**
 * GetVoiceInfo request class
 *  Get voice information 
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetVoiceInfo extends Base
{
    /**
     * Phone specification
     * @var TypedSequence<PhoneSpec>
     */
    private $_phone;

    /**
     * Constructor method for GetVoiceInfo
     * @param  array $phones
     * @return self
     */
    public function __construct(array $phones = array())
    {
        parent::__construct();
        $this->_phone = new TypedSequence('Zimbra\Voice\Struct\PhoneSpec', $phones);

        $this->addHook(function($sender)
        {
            if(count($sender->phone()))
            {
                $sender->child('phone', $sender->phone()->all());
            }
        });
    }

    /**
     * Add a phone specification
     *
     * @param  PhoneSpec $phone
     * @return self
     */
    public function addPhone(PhoneSpec $phone)
    {
        $this->_phone->add($phone);
        return $this;
    }

    /**
     * Gets phone specification sequence
     *
     * @return Sequence
     */
    public function phone()
    {
        return $this->_phone;
    }
}
