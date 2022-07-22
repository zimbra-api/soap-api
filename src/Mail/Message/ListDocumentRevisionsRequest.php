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
use Zimbra\Mail\Struct\ListDocumentRevisionsSpec;
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * ListDocumentRevisionsRequest class
 * Returns {num} number of revisions starting from {version} of the requested document.
 * {num} defaults to 1.  {version} defaults to the current version.
 * Documents that have multiple revisions have the flag "/", which indicates that the document is versioned.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ListDocumentRevisionsRequest extends Request
{
    /**
     * Specification for the list of document revisions
     * 
     * @Accessor(getter="getDoc", setter="setDoc")
     * @SerializedName("doc")
     * @Type("Zimbra\Mail\Struct\ListDocumentRevisionsSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ListDocumentRevisionsSpec $doc;

    /**
     * Constructor method for ListDocumentRevisionsRequest
     *
     * @param  ListDocumentRevisionsSpec $doc
     * @return self
     */
    public function __construct(ListDocumentRevisionsSpec $doc)
    {
        $this->setDoc($doc);
    }

    /**
     * Gets doc
     *
     * @return ListDocumentRevisionsSpec
     */
    public function getDoc(): ListDocumentRevisionsSpec
    {
        return $this->doc;
    }

    /**
     * Sets doc
     *
     * @param  ListDocumentRevisionsSpec $doc
     * @return self
     */
    public function setDoc(ListDocumentRevisionsSpec $doc): self
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
        return new ListDocumentRevisionsEnvelope(
            new ListDocumentRevisionsBody($this)
        );
    }
}
