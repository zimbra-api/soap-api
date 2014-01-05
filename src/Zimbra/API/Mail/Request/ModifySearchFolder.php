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
use Zimbra\Soap\Struct\ModifySearchFolderSpec;

/**
 * ModifySearchFolder request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifySearchFolder extends Request
{
    /**
     * Specification of Search folder modifications
     * @var ModifySearchFolderSpec
     */
    private $_search;

    /**
     * Constructor method for ModifySearchFolder
     * @param  ModifySearchFolderSpec $search
     * @return self
     */
    public function __construct(ModifySearchFolderSpec $search)
    {
        parent::__construct();
        $this->_search = $search;
    }

    /**
     * Get or set search
     *
     * @param  ModifySearchFolderSpec $search
     * @return ModifySearchFolderSpec|self
     */
    public function search(ModifySearchFolderSpec $search = null)
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
