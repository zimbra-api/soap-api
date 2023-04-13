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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ListDocumentRevisionsRequest extends SoapRequest
{
    /**
     * Specification for the list of document revisions
     * 
     * @var ListDocumentRevisionsSpec
     */
    #[Accessor(getter: 'getDoc', setter: 'setDoc')]
    #[SerializedName('doc')]
    #[Type(ListDocumentRevisionsSpec::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ListDocumentRevisionsSpec $doc;

    /**
     * Constructor
     *
     * @param  ListDocumentRevisionsSpec $doc
     * @return self
     */
    public function __construct(ListDocumentRevisionsSpec $doc)
    {
        $this->setDoc($doc);
    }

    /**
     * Get doc
     *
     * @return ListDocumentRevisionsSpec
     */
    public function getDoc(): ListDocumentRevisionsSpec
    {
        return $this->doc;
    }

    /**
     * Set doc
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ListDocumentRevisionsEnvelope(
            new ListDocumentRevisionsBody($this)
        );
    }
}
