<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\IdsAttr;
use Zimbra\Common\Struct\SoapResponse;

/**
 * ApplyFilterRulesResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ApplyFilterRulesResponse extends SoapResponse
{
    /**
     * Comma-separated list of message IDs that were affected
     * 
     * @var IdsAttr
     */
    #[Accessor(getter: 'getMsgIds', setter: 'setMsgIds')]
    #[SerializedName('m')]
    #[Type(IdsAttr::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?IdsAttr $msgIds;

    /**
     * Constructor
     *
     * @param  IdsAttr $msgIds
     * @return self
     */
    public function __construct(?IdsAttr $msgIds = NULL)
    {
        $this->msgIds = $msgIds;
    }

    /**
     * Get msgIds
     *
     * @return IdsAttr
     */
    public function getMsgIds(): ?IdsAttr
    {
        return $this->msgIds;
    }

    /**
     * Set msgIds
     *
     * @param  IdsAttr $msgIds
     * @return self
     */
    public function setMsgIds(IdsAttr $msgIds): self
    {
        $this->msgIds = $msgIds;
        return $this;
    }
}
