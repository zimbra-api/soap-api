<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Header;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * ChangeInfo struct class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="change")
 */
class ChangeInfo
{
    /**
     * @Accessor(getter="getChangeId", setter="setChangeId")
     * @SerializedName("token")
     * @Type("string")
     * @XmlAttribute
     */
    private $_changeId;

    /**
     * @Accessor(getter="getChangeType", setter="setChangeType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $_changeType;

    /**
     * Constructor method for ChangeInfo
     * @param string $changeId
     * @param string $changeType
     * @return self
     */
    public function __construct(
        $changeId = null,
        $changeType = null
    )
    {
        if(null !== $changeId)
        {
            $this->setChangeId($changeId);
        }
        if(null !== $changeType)
        {
            $this->setChangeType($changeType);
        }
    }

    /**
     * Gets the highest change ID the client knows about
     *
     * @return string
     */
    public function getChangeId()
    {
        return $this->_changeId;
    }

    /**
     * Sets the highest change ID the client knows about
     *
     * @param  string $changeId
     * @return string|self
     */
    public function setChangeId($changeId)
    {
        $this->_changeId = trim($changeId);
        return $this;
    }

    /**
     * Gets change type. Valid values "mod" (default) and "new"
     *
     * @return string
     */
    public function getChangeType()
    {
        return $this->_changeType;
    }

    /**
     * Sets change type. Valid values "mod" (default) and "new"
     *
     * @param  string $changeType
     * @return self
     */
    public function setChangeType($changeType)
    {
        $this->_changeType = trim($changeType);
        return $this;
    }
}
