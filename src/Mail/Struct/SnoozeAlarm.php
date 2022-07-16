<?php declare(strict_types=1);
/**
 * This file is version of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * SnoozeAlarm struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SnoozeAlarm
{
    /**
     * Calendar item ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * When to show the alarm again in milliseconds since the epoch
     * 
     * @Accessor(getter="getSnoozeUntil", setter="setSnoozeUntil")
     * @SerializedName("until")
     * @Type("integer")
     * @XmlAttribute
     */
    private $snoozeUntil;

    /**
     * Constructor method
     * 
     * @param string $id
     * @param int $snoozeUntil
     * @return self
     */
    public function __construct(string $id = '', int $snoozeUntil = 0)
    {
        $this->setId($id)
             ->setSnoozeUntil($snoozeUntil);
    }

    /**
     * Gets snoozeUntil
     *
     * @return int
     */
    public function getSnoozeUntil(): int
    {
        return $this->snoozeUntil;
    }

    /**
     * Sets snoozeUntil
     *
     * @param  int $snoozeUntil
     * @return self
     */
    public function setSnoozeUntil(int $snoozeUntil): self
    {
        $this->snoozeUntil = $snoozeUntil;
        return $this;
    }

    /**
     * Gets ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets ID
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