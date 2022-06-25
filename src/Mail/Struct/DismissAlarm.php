<?php declare(strict_types=1);
/**
 * This file is dismissedAt of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * DismissAlarm struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DismissAlarm
{
    /**
     * Calendar item ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Time alarm was dismissed, in millis
     * @Accessor(getter="getDismissedAt", setter="setDismissedAt")
     * @SerializedName("dismissedAt")
     * @Type("integer")
     * @XmlAttribute
     */
    private $dismissedAt;

    /**
     * Constructor method
     * @param string $id
     * @param int $dismissedAt
     * @return self
     */
    public function __construct(string $id, int $dismissedAt)
    {
        $this->setId($id)
             ->setDismissedAt($dismissedAt);
    }

    /**
     * Gets dismissedAt enum
     *
     * @return int
     */
    public function getDismissedAt(): int
    {
        return $this->dismissedAt;
    }

    /**
     * Sets dismissedAt enum
     *
     * @param  int $dismissedAt
     * @return self
     */
    public function setDismissedAt(int $dismissedAt): self
    {
        $this->dismissedAt = $dismissedAt;
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
