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

use Zimbra\Mail\Struct\DiffDocumentVersionSpec;

/**
 * DiffDocument request class
 * Performs line by line diff of two revisions of a Document then returns a list of <chunk/> containing the result.
 * Sections of text that are identical to both versions are indicated with disp="common".
 * For each conflict the chunk will show disp="first", disp="second" or both.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DiffDocument extends Base
{
    /**
     * Constructor method for DiffDocument
     * @param  DiffDocumentVersionSpec $doc
     * @return self
     */
    public function __construct(DiffDocumentVersionSpec $doc)
    {
        parent::__construct();
        $this->setChild('doc', $doc);
    }

    /**
     * Gets diff document version specification
     *
     * @return DiffDocumentVersionSpec
     */
    public function getDoc()
    {
        return $this->getChild('doc');
    }

    /**
     * Sets diff document version specification
     *
     * @param  DiffDocumentVersionSpec $doc
     * @return self
     */
    public function setDoc(DiffDocumentVersionSpec $doc)
    {
        return $this->setChild('doc', $doc);
    }
}
