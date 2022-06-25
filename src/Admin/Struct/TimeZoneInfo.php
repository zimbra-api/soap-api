<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * TimeZoneInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class TimeZoneInfo
{
    /**
     * timezone ID. e.g "America/Los_Angeles"
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Timezone display name, e.g. "Pacific Standard Time"
     * @Accessor(getter="getDisplayName", setter="setDisplayName")
     * @SerializedName("displayName")
     * @Type("string")
     * @XmlAttribute
     */
    private $displayName;

    /**
     * Constructor method for TimeZoneInfo
     * 
     * @param  string $id
     * @param  string $displayName
     * @return self
     */
    public function __construct(string $id, string $displayName)
    {
        $this->setId($id)
             ->setDisplayName($displayName);
    }

    /**
     * Gets Zimbra ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets Zimbra ID
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets displayName
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * Sets displayName
     *
     * @param  string $displayName
     * @return self
     */
    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;
        return $this;
    }
}
