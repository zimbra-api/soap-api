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
use Zimbra\Soap\Struct\NewFolderSpec;

/**
 * CreateFolder request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateFolder extends Request
{
    /**
     * New folder specification
     * @var NewFolderSpec
     */
    private $_folder;

    /**
     * Constructor method for CreateFolder
     * @param  NewFolderSpec $folder
     * @return self
     */
    public function __construct(NewFolderSpec $folder)
    {
        parent::__construct();
        $this->_folder = $folder;
    }

    /**
     * Get or set folder
     *
     * @param  NewFolderSpec $folder
     * @return NewFolderSpec|self
     */
    public function folder(NewFolderSpec $folder = null)
    {
        if(null === $folder)
        {
            return $this->_folder;
        }
        $this->_folder = $folder;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array += $this->_folder->toArray('folder');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_folder->toXml('folder'));
        return parent::toXml();
    }
}
