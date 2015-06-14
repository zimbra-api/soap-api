<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use Zimbra\Enum\ZimletStatus;
use Zimbra\Struct\Base;

/**
 * ZimletPrefsSpec struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ZimletPrefsSpec extends Base
{
    /**
     * Constructor method for ZimletPrefsSpec
     * @param  string $name
     * @param  ZimletStatus $presence
     * @return self
     */
    public function __construct($name, ZimletStatus $presence)
    {
        parent::__construct();
        $this->setProperty('name', trim($name));
        $this->setProperty('presence', $presence);
    }

    /**
     * Gets zimlet name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets zimlet name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets presence
     *
     * @return ZimletStatus
     */
    public function getPresence()
    {
        return $this->getProperty('presence');
    }

    /**
     * Sets presence
     *
     * @param  ZimletStatus $presence
     * @return self
     */
    public function setPresence(ZimletStatus $presence)
    {
        return $this->setProperty('presence', $presence);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'zimlet')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'zimlet')
    {
        return parent::toXml($name);
    }
}
