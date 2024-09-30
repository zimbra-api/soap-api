<?php declare(strict_types=1);
/**
 * This file is showReminders of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * SharedReminderMount struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SharedReminderMount
{
    /**
     * Mountpoint ID
     *
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private $id;

    /**
     * Set to enable (or unset to disable) reminders for shared appointments/tasks
     *
     * @Accessor(getter="getShowReminders", setter="setShowReminders")
     * @SerializedName("reminder")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getShowReminders", setter: "setShowReminders")]
    #[SerializedName("reminder")]
    #[Type("bool")]
    #[XmlAttribute]
    private $showReminders;

    /**
     * Constructor
     *
     * @param string $id
     * @param bool $showReminders
     * @return self
     */
    public function __construct(string $id = "", ?bool $showReminders = null)
    {
        $this->setId($id);
        if (null !== $showReminders) {
            $this->setShowReminders($showReminders);
        }
    }

    /**
     * Get showReminders
     *
     * @return bool
     */
    public function getShowReminders(): ?bool
    {
        return $this->showReminders;
    }

    /**
     * Set showReminders
     *
     * @param  bool $showReminders
     * @return self
     */
    public function setShowReminders(bool $showReminders): self
    {
        $this->showReminders = $showReminders;
        return $this;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
}
