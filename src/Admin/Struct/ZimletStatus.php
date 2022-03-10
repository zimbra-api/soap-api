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
use Zimbra\Enum\ZimletStatusSetting;

/**
 * ZimletStatus struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ZimletStatus
{
    /**
     * Zimlet name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Status
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Zimbra\Enum\ZimletStatusSetting")
     * @XmlAttribute
     */
    private $status;

    /**
     * Extension
     * @Accessor(getter="getExtension", setter="setExtension")
     * @SerializedName("extension")
     * @Type("bool")
     * @XmlAttribute
     */
    private $extension;

    /**
     * Priority
     * @Accessor(getter="getPriority", setter="setPriority")
     * @SerializedName("priority")
     * @Type("integer")
     * @XmlAttribute
     */
    private $priority;

    /**
     * Constructor method for ZimletStatus
     *
     * @param  string $name
     * @param  ZimletStatusSetting $status
     * @param  bool $extension
     * @param  int $priority
     * @return self
     */
    public function __construct(
        string $name, ZimletStatusSetting $status, bool $extension, ?int $priority = NULL
    )
    {
        $this->setName($name)
             ->setStatus($status)
             ->setExtension($extension);
        if (NULL !== $priority) {
            $this->setPriority($priority);
        }
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets status
     *
     * @return ZimletStatusSetting
     */
    public function getStatus(): ZimletStatusSetting
    {
        return $this->status;
    }

    /**
     * Sets status
     *
     * @param  ZimletStatusSetting $status
     * @return self
     */
    public function setStatus(ZimletStatusSetting $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Gets extension
     *
     * @return bool
     */
    public function getExtension(): bool
    {
        return $this->extension;
    }

    /**
     * Sets extension
     *
     * @param  bool $extension
     * @return self
     */
    public function setExtension(bool $extension): self
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * Gets priority
     *
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * Sets priority
     *
     * @param  int $priority
     * @return self
     */
    public function setPriority(int $priority): self
    {
        $this->priority = $priority;
        return $this;
    }
}
