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
 * CreateItemNotification class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 */
class CreateItemNotification
{
    /**
     * Message info of created item
     * 
     * @Accessor(getter="getMessageInfo", setter="setMessageInfo")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\ImapMessageInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ImapMessageInfo
     */
    #[Accessor(getter: "getMessageInfo", setter: "setMessageInfo")]
    #[SerializedName('m')]
    #[Type(ImapMessageInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ImapMessageInfo $msgInfo;

    /**
     * Constructor
     * 
     * @param  ImapMessageInfo $msgInfo
     * @return self
     */
    public function __construct(ImapMessageInfo $msgInfo)
    {
        $this->setMessageInfo($msgInfo);
    }

    /**
     * Get message info
     *
     * @return ImapMessageInfo
     */
    public function getMessageInfo(): ImapMessageInfo
    {
        return $this->msgInfo;
    }

    /**
     * Set message info
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
