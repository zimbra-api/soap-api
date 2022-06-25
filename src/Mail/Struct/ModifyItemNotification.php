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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};

/**
 * ModifyItemNotification struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 */
class ModifyItemNotification extends ModifyNotification
{
    /**
     * Modified IMAP message
     * @Accessor(getter="getMessageInfo", setter="setMessageInfo")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\ImapMessageInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ImapMessageInfo $msgInfo;

    /**
     * Constructor method for ModifyItemNotification
     * @param  ImapMessageInfo $msgInfo
     * @param  int $changeBitmask
     * @return self
     */
    public function __construct(ImapMessageInfo $msgInfo, $changeBitmask)
    {
        parent::__construct($changeBitmask);
        $this->setMessageInfo($msgInfo);
    }

    /**
     * Gets modified IMAP message
     *
     * @return ImapMessageInfo
     */
    public function getMessageInfo(): ImapMessageInfo
    {
        return $this->msgInfo;
    }

    /**
     * Sets modified IMAP message
     *
     * @param  ImapMessageInfo $msgInfo
     * @return self
     */
    public function setMessageInfo(ImapMessageInfo $msgInfo): self
    {
        $this->msgInfo = $msgInfo;
        return $this;
    }
}
