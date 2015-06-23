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
     * @param string $id Message id of the voice mail.  It can only be a voice mail in the INBOX, not the trash folder.
     * @param string $phone Phone number of the voice mail
     * @return self
     */
    public function __construct(
        $id = null,
        $phone = null
    )
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        $this->setProperty('phone', trim($phone));
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->getProperty('phone');
    }

    /**
     * Sets phone
     *
     * @param  string $phone
     * @return self
     */
    public function setPhone($phone)
    {
        return $this->setProperty('phone', trim($phone));
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
