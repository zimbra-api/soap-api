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

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Enum\ZimletStatus;

/**
 * ZimletPrefsSpec struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="zimlet")
 */
class ZimletPrefsSpec
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $_name;

    /**
     * @Accessor(getter="getPresence", setter="setPresence")
     * @SerializedName("presence")
     * @Type("string")
     * @XmlAttribute
     */
    private $_presence;

    /**
     * Constructor method for ZimletPrefsSpec
     * @param  string $name
     * @param  string $presence
     * @return self
     */
    public function __construct($name, $presence)
    {
        $this->setName($name)->setPresence($presence);
    }

    /**
     * Gets zimlet name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets zimlet name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Gets presence
     *
     * @return ZimletStatus
     */
    public function getPresence()
    {
        return $this->_presence;
    }

    /**
     * Sets presence
     *
     * @param  string $presence
     * @return self
     */
    public function setPresence($presence)
    {
        if (ZimletStatus::has(trim($presence))) {
            $this->_presence = $presence;
        }
        return $this;
    }
}
