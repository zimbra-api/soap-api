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

use Zimbra\Mail\Struct\ListDocumentRevisionsSpec;

/**
 * ListDocumentRevisions request class
 * Returns {num} number of revisions starting from {version} of the requested document. {num} defaults to 1. {version} defaults to the current version. 
 * Documents that have multiple revisions have the flag "/", which indicates that the document is versioned.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ListDocumentRevisions extends Base
{
    /**
     * Constructor method for ListDocumentRevisions
     * @param  ListDocumentRevisionsSpec $doc
     * @return self
     */
    public function __construct(ListDocumentRevisionsSpec $doc)
    {
        parent::__construct();
        $this->setChild('doc', $doc);
    }

    /**
     * Gets specification for the list of document revisions
     *
     * @return ListDocumentRevisionsSpec
     */
    public function getDoc()
    {
        return $this->getChild('doc');
    }

    /**
     * Sets specification for the list of document revisions
     *
     * @param  ListDocumentRevisionsSpec $doc
     * @return self
     */
    public function setDoc(ListDocumentRevisionsSpec $doc)
    {
        return $this->setChild('doc', $doc);
    }
}
