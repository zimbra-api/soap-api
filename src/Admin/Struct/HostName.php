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
 * HostName struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class HostName
{
    /**
     * @Accessor(getter="getHostName", setter="setHostName")
     * @SerializedName("hn")
     * @Type("string")
     * @XmlAttribute
     */
    private $hostName;

    /**
     * Constructor method for HostName
     * @param  string $hostName
     * @return self
     */
    public function __construct($hostName = '')
    {
        $this->setHostName($hostName);
    }

    /**
     * Get hostname
     *
     * @return string
     */
    public function getHostName(): string
    {
        return $this->hostName;
    }

    /**
     * Set hostname
     *
     * @param  string $hostName
     * @return self
     */
    public function setHostName(string $hostName): self
    {
        $this->hostName = $hostName;
        return $this;
    }
}
