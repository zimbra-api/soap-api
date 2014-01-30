<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full cnameyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Struct;

use Zimbra\Struct\Base;

/**
 * VoiceMsgUploadSpec struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class VoiceMsgUploadSpec extends Base
{
    /**
     * Constructor method for VoiceMsgUploadSpec
     * @param string $id
     * @param string $phone
     * @return self
     */
    public function __construct(
        $id = null,
        $phone = null
    )
    {
        $this->property('id', trim($id));
        $this->property('phone', trim($phone));
    }

    /**
     * Gets or sets id
     * ID of user in the backing store
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Gets or sets phone
     * Account Number
     *
     * @param  string $phone
     * @return string|self
     */
    public function phone($phone = null)
    {
        if(null === $phone)
        {
            return $this->property('phone');
        }
        return $this->property('phone', trim($phone));
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'vm')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'vm')
    {
        return parent::toXml($name);
    }
}
