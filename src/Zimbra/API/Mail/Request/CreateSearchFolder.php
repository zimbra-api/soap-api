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
use Zimbra\Soap\Struct\NewSearchFolderSpec;

/**
 * CreateSearchFolder request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateSearchFolder extends Request
{
    /**
     * New Search Folder specification
     * @var NewSearchFolderSpec
     */
    private $_search;

    /**
     * Constructor method for CreateSearchFolder
     * @param  NewSearchFolderSpec $search
     * @return self
     */
    public function __construct(NewSearchFolderSpec $search)
    {
        parent::__construct();
        $this->_search = $search;
    }

    /**
     * Get or set search
     *
     * @param  NewSearchFolderSpec $search
     * @return NewSearchFolderSpec|self
     */
    public function search(NewSearchFolderSpec $search = null)
    {
        if(null === $search)
        {
            return $this->_search;
        }
        $this->_search = $search;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array += $this->_search->toArray('search');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_search->toXml('search'));
        return parent::toXml();
    }
}
