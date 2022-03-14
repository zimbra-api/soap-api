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
use Zimbra\Mail\Struct\ContactActionSelector;
use Zimbra\Soap\Request;

/**
 * ContactActionRequest class
 * Contact Action
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ContactActionRequest extends Request
{
    /**
     * Contact action selector
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\ContactActionSelector")
     * @XmlElement
     */
    private $action;

    /**
     * Constructor method for ContactActionRequest
     *
     * @param  ContactActionSelector $action
     * @return self
     */
    public function __construct(ContactActionSelector $action)
    {
        $this->setAction($action);
    }

    /**
     * Gets action
     *
     * @return ContactActionSelector
     */
    public function getAction(): ContactActionSelector
    {
        return $this->action;
    }

    /**
     * Sets action
     *
     * @param  ContactActionSelector $action
     * @return self
     */
    public function setAction(ContactActionSelector $action): self
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
        if (!($this->envelope instanceof ContactActionEnvelope)) {
            $this->envelope = new ContactActionEnvelope(
                new ContactActionBody($this)
            );
        }
    }
}
