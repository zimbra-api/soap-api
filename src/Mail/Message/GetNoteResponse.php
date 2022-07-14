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
use Zimbra\Mail\Struct\NoteInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetNoteResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetNoteResponse implements ResponseInterface
{
    /**
     * Note information
     * 
     * @Accessor(getter="getNote", setter="setNote")
     * @SerializedName("note")
     * @Type("Zimbra\Mail\Struct\NoteInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?NoteInfo $note = NULL;

    /**
     * Constructor method for GetNoteResponse
     *
     * @param  NoteInfo $note
     * @return self
     */
    public function __construct(?NoteInfo $note = NULL)
    {
        if ($note instanceof NoteInfo) {
            $this->setNote($note);
        }
    }

    /**
     * Gets note
     *
     * @return NoteInfo
     */
    public function getNote(): ?NoteInfo
    {
        return $this->note;
    }

    /**
     * Sets note
     *
     * @param  NoteInfo $note
     * @return self
     */
    public function setNote(NoteInfo $note): self
    {
        $this->note = $note;
        return $this;
    }
}