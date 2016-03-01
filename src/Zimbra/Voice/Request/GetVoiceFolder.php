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
use Zimbra\Voice\Struct\StorePrincipalSpec;

/**
 * GetVoiceFolder request class
 * Get Voice Folders
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetVoiceFolder extends Base
{
    /**
     * Phone specification
     * @var TypedSequence<PhoneSpec>
     */
    private $_phones;

    /**
     * Constructor method for GetVoiceFolder
     * @param  StorePrincipalSpec $storeprincipal Store principal specification
     * @param  array $phones
     * @return self
     */
    public function __construct(
        StorePrincipalSpec $storeprincipal = null,
        array $phones = array()
    )
    {
        parent::__construct();
        if($storeprincipal instanceof StorePrincipalSpec)
        {
            $this->setChild('storeprincipal', $storeprincipal);
        }
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
     * Gets the storeprincipal.
     *
     * @return StorePrincipalSpec
     */
    public function getStorePrincipal()
    {
        return $this->getChild('storeprincipal');
    }

    /**
     * Sets the storeprincipal.
     *
     * @param  StorePrincipalSpec $storeprincipal
     * @return self
     */
    public function setStorePrincipal(StorePrincipalSpec $storeprincipal)
    {
        return $this->setChild('storeprincipal', $storeprincipal);
    }

    /**
     * Add a phone specification
     *
     * @param  PhoneSpec $phone
     * @return self
     */
    public function addPhone(PhoneSpec $phone)
    {
        $this->_phones->add($phone);
        return $this;
    }

    /**
     * Sets phone specification sequence
     *
     * @param  array $phones
     * @return self
     */
    public function setPhones(array $phones)
    {
        $this->_phones = new TypedSequence('Zimbra\Voice\Struct\PhoneSpec', $phones);
        return $this;
    }

    /**
     * Gets phone specification sequence
     *
     * @return Sequence
     */
    public function getPhones()
    {
        return $this->_phones;
    }
}
