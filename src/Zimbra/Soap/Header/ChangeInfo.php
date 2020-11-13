<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Header;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * ChangeInfo struct class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
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
    private $changeId;

    /**
     * @Accessor(getter="getChangeType", setter="setChangeType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $changeType;

    /**
     * Constructor method for ChangeInfo
     * @param string $changeId
     * @param string $changeType
     * @return self
     */
    public function __construct(
        $changeId = NULL,
        $changeType = NULL
    )
    {
        if(NULL !== $changeId)
        {
            $this->setChangeId($changeId);
        }
        if(NULL !== $changeType)
        {
            $this->setChangeType($changeType);
        }
    }

    /**
     * Gets the highest change ID the client knows about
     *
     * @return string
     */
    public function getChangeId(): string
    {
        return $this->changeId;
    }

    /**
     * Sets the highest change ID the client knows about
     *
     * @param  string $changeId
     * @return self
     */
    public function setChangeId($changeId): self
    {
        $this->changeId = trim($changeId);
        return $this;
    }

    /**
     * Gets change type. Valid values "mod" (default) and "new"
     *
     * @return string
     */
    public function getChangeType(): string
    {
        return $this->changeType;
    }

    /**
     * Sets change type. Valid values "mod" (default) and "new"
     *
     * @param  string $changeType
     * @return self
     */
    public function setChangeType($changeType): self
    {
        $this->changeType = trim($changeType);
        return $this;
    }
}
