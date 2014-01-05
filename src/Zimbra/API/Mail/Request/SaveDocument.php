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
use Zimbra\Soap\Struct\DocumentSpec;

/**
 * SaveDocument request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SaveDocument extends Request
{
    /**
     * Added doc
     * @var DocumentSpec
     */
    private $_doc;

    /**
     * Constructor method for SaveDocument
     * @param  DocumentSpec $doc
     * @return self
     */
    public function __construct(DocumentSpec $doc)
    {
        parent::__construct();
        $this->_doc = $doc;
    }

    /**
     * Get or set doc
     *
     * @param  DocumentSpec $doc
     * @return DocumentSpec|self
     */
    public function doc(DocumentSpec $doc = null)
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
