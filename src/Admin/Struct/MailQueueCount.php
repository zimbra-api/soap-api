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
 * MailQueueCount class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MailQueueCount
{
    /**
     * Queue name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Count of the number of files in a queue directory
     * @Accessor(getter="getCount", setter="setCount")
     * @SerializedName("n")
     * @Type("integer")
     * @XmlAttribute
     */
    private $count;

    /**
     * Constructor method for MailQueueCount
     *
     * @param string $name
     * @param int $count
     * @return self
     */
    public function __construct(
        string $name,
        int $count
    )
    {
        $this->setName($name)
             ->setCount($count);
    }

    /**
     * Gets count
     *
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * Sets count
     *
     * @param  int $target
     * @return self
     */
    public function setCount(int $count): self
    {
        $this->count = $count;
        return $this;
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
}
