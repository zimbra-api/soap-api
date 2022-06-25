<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\MailboxWithMailboxId as MailboxId;
use Zimbra\Soap\ResponseInterface;

/**
 * DeleteMailboxResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DeleteMailboxResponse implements ResponseInterface
{
    /**
     * Details of the deleted mailbox.
     * @Accessor(getter="getMbox", setter="setMbox")
     * @SerializedName("mbox")
     * @Type("Zimbra\Admin\Struct\MailboxWithMailboxId")
     * @XmlElement
     */
    private MailboxId $mbox;

    /**
     * Constructor method for DeleteMailboxResponse
     *
     * @param MailboxId $mbox
     * @return self
     */
    public function __construct(MailboxId $mbox)
    {
        $this->setMbox($mbox);
    }

    /**
     * Gets the mbox.
     *
     * @return MailboxId
     */
    public function getMbox(): MailboxId
    {
        return $this->mbox;
    }

    /**
     * Sets the mbox.
     *
     * @param  MailboxId $mbox
     * @return self
     */
    public function setMbox(MailboxId $mbox)
    {
        $this->mbox = $mbox;
        return $this;
    }
}
