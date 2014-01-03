<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\ListDocumentRevisionsSpec;

/**
 * ListDocumentRevisions request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ListDocumentRevisions extends Request
{
    /**
     * Added doc
     * @var ListDocumentRevisionsSpec
     */
    private $_doc;

    /**
     * Constructor method for ListDocumentRevisions
     * @param  ListDocumentRevisionsSpec $doc
     * @return self
     */
    public function __construct(ListDocumentRevisionsSpec $doc)
    {
        parent::__construct();
        $this->_doc = $doc;
    }

    /**
     * Get or set doc
     *
     * @param  ListDocumentRevisionsSpec $doc
     * @return ListDocumentRevisionsSpec|self
     */
    public function doc(ListDocumentRevisionsSpec $doc = null)
    {
        if(null === $doc)
        {
            return $this->_doc;
        }
        $this->_doc = $doc;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array += $this->_doc->toArray('doc');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_doc->toXml('doc'));
        return parent::toXml();
    }
}
