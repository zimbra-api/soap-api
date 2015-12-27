<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\DocumentSpec;

/**
 * SaveDocument request class
 * Save Document
 * One mechanism for Creating and updating a Document is:
 *   - Use FileUploadServlet to upload the document
 *   - Call SaveDocumentRequest using the upload-id returned from FileUploadServlet.
 * A Document represents a file.
 * A file can be created by uploading to FileUploadServlet.
 * Or it can refer to an attachment of an existing message. 
 * 
 * Documents are versioned.
 * The server maintains the metadata of each version, such as by who and when the version was edited, and the fragment. 
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SaveDocument extends Base
{
    /**
     * Constructor method for SaveDocument
     * @param  DocumentSpec $doc
     * @return self
     */
    public function __construct(DocumentSpec $doc)
    {
        parent::__construct();
        $this->setChild('doc', $doc);
    }

    /**
     * Gets document specification
     *
     * @return DocumentSpec
     */
    public function getDoc()
    {
        return $this->getChild('doc');
    }

    /**
     * Sets document specification
     *
     * @param  DocumentSpec $doc
     * @return self
     */
    public function setDoc(DocumentSpec $doc)
    {
        return $this->setChild('doc', $doc);
    }
}
