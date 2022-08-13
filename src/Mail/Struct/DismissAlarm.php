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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DismissAlarm
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
     * Time alarm was dismissed, in millis
     * 
     * @Accessor(getter="getDismissedAt", setter="setDismissedAt")
     * @SerializedName("dismissedAt")
     * @Type("int")
     * @XmlAttribute
     */
    private $dismissedAt;

    /**
     * Constructor
     * 
     * @param string $id
     * @param int $dismissedAt
     * @return self
     */
    public function __construct(string $id = '', int $dismissedAt = 0)
    {
        $this->setId($id)
             ->setDismissedAt($dismissedAt);
    }

    /**
     * Get dismissedAt enum
     *
     * @return int
     */
    public function getDismissedAt(): int
    {
        return $this->dismissedAt;
    }

    /**
     * Set dismissedAt enum
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
     * Get ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set ID
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
