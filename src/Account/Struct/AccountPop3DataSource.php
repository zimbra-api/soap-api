<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\Pop3DataSource;

/**
 * AccountPop3DataSource struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AccountPop3DataSource extends AccountDataSource implements Pop3DataSource
{
    /**
     * Specifies whether imported POP3 messages should be left on the server or deleted.
     * 
     * @Accessor(getter="isLeaveOnServer", setter="setLeaveOnServer")
     * @SerializedName("leaveOnServer")
     * @Type("bool")
     * @XmlAttribute
     */
    private $leaveOnServer;

    /**
     * Get leaveOnServer
     *
     * @return bool
     */
    public function isLeaveOnServer(): ?bool
    {
        return $this->leaveOnServer;
    }

    /**
     * Set leaveOnServer
     *
     * @param  bool $leaveOnServer
     * @return self
     */
    public function setLeaveOnServer(bool $leaveOnServer): self
    {
        $this->leaveOnServer = $leaveOnServer;
        return $this;
    }
}
