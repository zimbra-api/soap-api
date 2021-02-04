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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Mail\Struct\ConvActionSelector;
use Zimbra\Soap\Request;

/**
 * ConvActionRequest class
 * Conv Action
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="ConvActionRequest")
 */
class ConvActionRequest extends Request
{
    /**
     * Conversation action selector
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\ConvActionSelector")
     * @XmlElement
     */
    private $action;

    /**
     * Constructor method for ConvActionRequest
     *
     * @param  ConvActionSelector $action
     * @return self
     */
    public function __construct(ConvActionSelector $action)
    {
        $this->setAction($action);
    }

    /**
     * Gets action
     *
     * @return ConvActionSelector
     */
    public function getAction(): ConvActionSelector
    {
        return $this->action;
    }

    /**
     * Sets action
     *
     * @param  ConvActionSelector $action
     * @return self
     */
    public function setAction(ConvActionSelector $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof ConvActionEnvelope)) {
            $this->envelope = new ConvActionEnvelope(
                new ConvActionBody($this)
            );
        }
    }
}
