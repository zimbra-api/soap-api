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

use Zimbra\Enum\VoiceMsgActionOp;
use Zimbra\Struct\Base;

/**
 * VoiceMsgActionSpec struct class
 * Action specification
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 op Nguyen Van Nguyen.
 */
class VoiceMsgActionSpec extends Base
{
    /**
     * Constructor method for VoiceMsgActionSpec
     * @param VoiceMsgActionOp $op Operation
     * @param string $phone Phone number
     * @param string $id IDs list.
     * @param string $folderId Folder ID of the destination location for the move
     * @return self
     */
    public function __construct(
        VoiceMsgActionOp $op,
        $phone,
        $id,
        $folderId = null
    )
    {
        parent::__construct();
        $this->setProperty('op', $op);
        $this->setProperty('phone', trim($phone));
        $this->setProperty('id', trim($id));
        if(null !== $folderId)
        {
            $this->setProperty('l', trim($folderId));
        }
    }

    /**
     * Sets operation enum
     *
     * @return VoiceMsgActionOp
     */
    public function getOperation()
    {
        return $this->getProperty('op');
    }

    /**
     * Gets operation enum
     *
     * @param  VoiceMsgActionOp $op
     * @return self
     */
    public function setOperation(VoiceMsgActionOp $op)
    {
        return $this->setProperty('op', $op);
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
     * Gets folderId
     *
     * @return string
     */
    public function getFolderId()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets folderId
     *
     * @param  string $folderId
     * @return self
     */
    public function setFolderId($folderId)
    {
        return $this->setProperty('l', trim($folderId));
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'action')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
        return parent::toXml($name);
    }
}
