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
use Zimbra\Mail\Struct\DocumentSpec;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * SaveDocumentRequest class
 * Save Document
 * One mechanism for Creating and updating a Document is:
 * - Use FileUploadServlet to upload the document
 * - Call SaveDocumentRequest using the upload-id returned from FileUploadServlet.
 * 
 * A Document represents a file.  A file can be created by uploading to FileUploadServlet.  Or it can refer to an
 * attachment of an existing message.
 * 
 * Documents are versioned.  The server maintains the metadata of each version, such as by who and when the version
 * was edited, and the fragment.
 * 
 * When updating an existing Document, the client must supply the id of Document, and the last known version of the
 * document in the 'ver' attribute.  This is used to prevent blindly overwriting someone else's change made after
 * the version this update was based upon.  The update will succeed only when the last known version supplied by the
 * client matches the current version of the item identified by item-id.
 * 
 * Saving a new document, as opposed to adding a revision of existing document, should leave the id and ver fields
 * empty in the request.  Then the server checks and see if the named document already exists, if so returns an error.
 * 
 * The request should contain either an <upload> element or a <msg> element, but not both.
 * When <upload> is used, the document should first be uploaded to FileUploadServlet, and then use the
 * upload-id from the FileUploadResponse.
 * 
 * When <m> is used, the document is retrieved from an existing message in the mailbox, identified by the
 * msg-id and part-id.  The content of the document can be inlined in the <content> element.
 * The content can come from another document / revision specified in the <doc> sub element.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SaveDocumentRequest extends Request
{
    /**
     * Document specification
     * 
     * @Accessor(getter="getDoc", setter="setDoc")
     * @SerializedName("doc")
     * @Type("Zimbra\Mail\Struct\DocumentSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private DocumentSpec $doc;

    /**
     * Constructor method for SaveDocumentRequest
     *
     * @param  DocumentSpec $doc
     * @return self
     */
    public function __construct(DocumentSpec $doc)
    {
        $this->setDoc($doc);
    }

    /**
     * Gets doc
     *
     * @return DocumentSpec
     */
    public function getDoc(): DocumentSpec
    {
        return $this->doc;
    }

    /**
     * Sets doc
     *
     * @param  DocumentSpec $doc
     * @return self
     */
    public function setDoc(DocumentSpec $doc): self
    {
        $this->doc = $doc;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new SaveDocumentEnvelope(
            new SaveDocumentBody($this)
        );
    }
}