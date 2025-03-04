<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\Pop3DataSource;

/**
 * MailPop3DataSource struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MailPop3DataSource extends MailDataSource implements Pop3DataSource
{
    /**
     * Specifies whether imported POP3 messages should be left on the server or deleted.
     *
     * @var bool
     */
    #[Accessor(getter: "isLeaveOnServer", setter: "setLeaveOnServer")]
    #[SerializedName("leaveOnServer")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $leaveOnServer = null;

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
