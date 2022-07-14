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
use Zimbra\Mail\Struct\NoteActionSelector;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * NoteActionRequest class
 * Perform an action on an note
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class NoteActionRequest extends Request
{
    /**
     * Specify the action to perform
     * 
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\NoteActionSelector")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private NoteActionSelector $action;

    /**
     * Constructor method for NoteActionRequest
     *
     * @param  NoteActionSelector $action
     * @return self
     */
    public function __construct(NoteActionSelector $action)
    {
        $this->setAction($action);
    }

    /**
     * Gets action
     *
     * @return NoteActionSelector
     */
    public function getAction(): NoteActionSelector
    {
        return $this->action;
    }

    /**
     * Sets action
     *
     * @param  NoteActionSelector $action
     * @return self
     */
    public function setAction(NoteActionSelector $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new NoteActionEnvelope(
            new NoteActionBody($this)
        );
    }
}