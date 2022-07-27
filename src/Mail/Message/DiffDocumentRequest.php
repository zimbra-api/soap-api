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
use Zimbra\Mail\Struct\DiffDocumentVersionSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * DiffDocumentRequest class
 * Performs line by line diff of two revisions of a Document then returns a list of
 * <chunk> containing the result.  Sections of text that are identical to both versions are indicated with
 * disp="common".  For each conflict the chunk will show disp="first", disp="second" or both.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DiffDocumentRequest extends SoapRequest
{
    /**
     * Diff document version specification
     * 
     * @Accessor(getter="getDoc", setter="setDoc")
     * @SerializedName("doc")
     * @Type("Zimbra\Mail\Struct\DiffDocumentVersionSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?DiffDocumentVersionSpec $doc = NULL;

    /**
     * Constructor method for DiffDocumentRequest
     *
     * @param  DiffDocumentVersionSpec $doc
     * @return self
     */
    public function __construct(?DiffDocumentVersionSpec $doc = NULL)
    {
        if ($doc instanceof DiffDocumentVersionSpec) {
            $this->setDoc($doc);
        }
    }

    /**
     * Gets doc
     *
     * @return DiffDocumentVersionSpec
     */
    public function getDoc(): ?DiffDocumentVersionSpec
    {
        return $this->doc;
    }

    /**
     * Sets doc
     *
     * @param  DiffDocumentVersionSpec $doc
     * @return self
     */
    public function setDoc(DiffDocumentVersionSpec $doc): self
    {
        $this->doc = $doc;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new DiffDocumentEnvelope(
            new DiffDocumentBody($this)
        );
    }
}
