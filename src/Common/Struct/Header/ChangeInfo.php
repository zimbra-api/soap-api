<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct\Header;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * ChangeInfo struct class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ChangeInfo
{
    /**
     * @Accessor(getter="getChangeId", setter="setChangeId")
     * @SerializedName("token")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getChangeId', setter: 'setChangeId')]
    #[SerializedName('token')]
    #[Type('string')]
    #[XmlAttribute]
    private $changeId;

    /**
     * @Accessor(getter="getChangeType", setter="setChangeType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getChangeType', setter: 'setChangeType')]
    #[SerializedName('type')]
    #[Type('string')]
    #[XmlAttribute]
    private $changeType;

    /**
     * Constructor
     * 
     * @param string $changeId
     * @param string $changeType
     * @return self
     */
    public function __construct(?string $changeId = NULL, ?string $changeType = NULL)
    {
        if (NULL !== $changeId) {
            $this->setChangeId($changeId);
        }
        if (NULL !== $changeType) {
            $this->setChangeType($changeType);
        }
    }

    /**
     * Get the highest change ID the client knows about
     *
     * @return string
     */
    public function getChangeId(): ?string
    {
        return $this->changeId;
    }

    /**
     * Set the highest change ID the client knows about
     *
     * @param  string $changeId
     * @return self
     */
    public function setChangeId(string $changeId): self
    {
        $this->changeId = $changeId;
        return $this;
    }

    /**
     * Get change type. Valid values "mod" (default) and "new"
     *
     * @return string
     */
    public function getChangeType(): ?string
    {
        return $this->changeType;
    }

    /**
     * Set change type. Valid values "mod" (default) and "new"
     *
     * @param  string $changeType
     * @return self
     */
    public function setChangeType(string $changeType): self
    {
        $this->changeType = $changeType;
        return $this;
    }
}
