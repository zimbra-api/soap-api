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
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetNoteResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetNoteResponse extends SoapResponse
{
    /**
     * Note information
     *
     * @var NoteInfo
     */
    #[Accessor(getter: "getNote", setter: "setNote")]
    #[SerializedName("note")]
    #[Type(NoteInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?NoteInfo $note;

    /**
     * Constructor
     *
     * @param  NoteInfo $note
     * @return self
     */
    public function __construct(?NoteInfo $note = null)
    {
        $this->note = $note;
    }

    /**
     * Get note
     *
     * @return NoteInfo
     */
    public function getNote(): ?NoteInfo
    {
        return $this->note;
    }

    /**
     * Set note
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
