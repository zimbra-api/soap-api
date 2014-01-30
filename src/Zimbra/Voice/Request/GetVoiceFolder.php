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
use Zimbra\Soap\Request;
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
class GetVoiceFolder extends Request
{
    /**
     * Phone specification
     * @var TypedSequence<PhoneSpec>
     */
    private $_phone;

    /**
     * Constructor method for GetVoiceFolder
     * @param  StorePrincipalSpec $storeprincipal
     * @param  array $phone
     * @return self
     */
    public function __construct(
        StorePrincipalSpec $storeprincipal = null,
        array $phone = array()
    )
    {
        parent::__construct();
        if($storeprincipal instanceof StorePrincipalSpec)
        {
            $this->child('storeprincipal', $storeprincipal);
        }
        $this->_phone = new TypedSequence('Zimbra\Voice\Struct\PhoneSpec', $phone);

        $this->addHook(function($sender)
        {
            if(count($sender->phone()))
            {
                $sender->child('phone', $sender->phone()->all());
            }
        });
    }

    /**
     * Gets or sets storeprincipal
     * Store Principal specification
     *
     * @param  StorePrincipalSpec $storeprincipal
     * @return StorePrincipalSpec|self
     */
    public function storeprincipal(StorePrincipalSpec $storeprincipal = null)
    {
        if(null === $storeprincipal)
        {
            return $this->child('storeprincipal');
        }
        return $this->child('storeprincipal', $storeprincipal);
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
