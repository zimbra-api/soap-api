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
use Zimbra\Mail\Struct\DocumentActionResult;
use Zimbra\Common\Struct\SoapResponse;

/**
 * DocumentActionResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DocumentActionResponse extends SoapResponse
{
    /**
     * Details of action
     * 
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\DocumentActionResult")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var DocumentActionResult
     */
    #[Accessor(getter: 'getAction', setter: 'setAction')]
    #[SerializedName('action')]
    #[Type(DocumentActionResult::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?DocumentActionResult $action;

    /**
     * Constructor
     *
     * @param  DocumentActionResult $action
     * @return self
     */
    public function __construct(?DocumentActionResult $action = NULL)
    {
        $this->action = $action;
    }

    /**
     * Get action
     *
     * @return DocumentActionResult
     */
    public function getAction(): ?DocumentActionResult
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param  DocumentActionResult $action
     * @return self
     */
    public function setAction(DocumentActionResult $action): self
    {
        $this->action = $action;
        return $this;
    }
}
