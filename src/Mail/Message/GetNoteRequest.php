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
use Zimbra\Common\Struct\Id;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetNoteRequest class
 * Get Note
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetNoteRequest extends SoapRequest
{
    /**
     * Specification for note
     * 
     * @Accessor(getter="getNote", setter="setNote")
     * @SerializedName("note")
     * @Type("Zimbra\Common\Struct\Id")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var Id
     */
    #[Accessor(getter: "getNote", setter: "setNote")]
    #[SerializedName('note')]
    #[Type(Id::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $note;

    /**
     * Constructor
     *
     * @param  Id $note
     * @return self
     */
    public function __construct(Id $note)
    {
        $this->setNote($note);
    }

    /**
     * Get note
     *
     * @return Id
     */
    public function getNote(): Id
    {
        return $this->note;
    }

    /**
     * Set note
     *
     * @param  Id $note
     * @return self
     */
    public function setNote(Id $note): self
    {
        $this->note = $note;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetNoteEnvelope(
            new GetNoteBody($this)
        );
    }
}
