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
use Zimbra\Mail\Struct\ActionSelector;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ItemActionRequest class
 * Perform an action on an item
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ItemActionRequest extends SoapRequest
{
    /**
     * Specify the action to perform
     * 
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\ActionSelector")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ActionSelector
     */
    #[Accessor(getter: "getAction", setter: "setAction")]
    #[SerializedName('action')]
    #[Type(ActionSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $action;

    /**
     * Constructor
     *
     * @param  ActionSelector $action
     * @return self
     */
    public function __construct(ActionSelector $action)
    {
        $this->setAction($action);
    }

    /**
     * Get action
     *
     * @return ActionSelector
     */
    public function getAction(): ActionSelector
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param  ActionSelector $action
     * @return self
     */
    public function setAction(ActionSelector $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ItemActionEnvelope(
            new ItemActionBody($this)
        );
    }
}
