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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * NoteActionRequest class
 * Perform an action on an note
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class NoteActionRequest extends SoapRequest
{
    /**
     * Specify the action to perform
     * 
     * @var NoteActionSelector
     */
    #[Accessor(getter: 'getAction', setter: 'setAction')]
    #[SerializedName('action')]
    #[Type(NoteActionSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private NoteActionSelector $action;

    /**
     * Constructor
     *
     * @param  NoteActionSelector $action
     * @return self
     */
    public function __construct(NoteActionSelector $action)
    {
        $this->setAction($action);
    }

    /**
     * Get action
     *
     * @return NoteActionSelector
     */
    public function getAction(): NoteActionSelector
    {
        return $this->action;
    }

    /**
     * Set action
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new NoteActionEnvelope(
            new NoteActionBody($this)
        );
    }
}
