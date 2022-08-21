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
use Zimbra\Mail\Struct\NewNoteSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CreateNoteRequest class
 * Create a note
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateNoteRequest extends SoapRequest
{
    /**
     * New note specification
     * 
     * @Accessor(getter="getNote", setter="setNote")
     * @SerializedName("note")
     * @Type("Zimbra\Mail\Struct\NewNoteSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var NewNoteSpec
     */
    #[Accessor(getter: "getNote", setter: "setNote")]
    #[SerializedName('note')]
    #[Type(NewNoteSpec::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private NewNoteSpec $note;

    /**
     * Constructor
     *
     * @param  NewNoteSpec $note
     * @return self
     */
    public function __construct(NewNoteSpec $note)
    {
        $this->setNote($note);
    }

    /**
     * Get note
     *
     * @return NewNoteSpec
     */
    public function getNote(): NewNoteSpec
    {
        return $this->note;
    }

    /**
     * Set note
     *
     * @param  NewNoteSpec $note
     * @return self
     */
    public function setNote(NewNoteSpec $note): self
    {
        $this->note = $note;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CreateNoteEnvelope(
            new CreateNoteBody($this)
        );
    }
}
