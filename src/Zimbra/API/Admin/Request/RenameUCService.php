<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;

/**
 * RenameUCService class
 * Rename Unified Communication Service.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RenameUCService extends Request
{
    /**
     * Zimbra ID
     * @var string
     */
    private $_id;

    /**
     * New COS name
     * @var string
     */
    private $_newName;

    /**
     * Constructor method for RenameUCService
     * @param string $id
     * @param string $newName
     * @return self
     */
    public function __construct($id, $newName)
    {
        parent::__construct();
        $this->_id = trim($id);
        $this->_newName = trim($newName);
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Gets or sets newName
     *
     * @param  string $newName
     * @return string|self
     */
    public function newName($newName = null)
    {
        if(null === $newName)
        {
            return $this->_newName;
        }
        $this->_newName = trim($newName);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'id' => $this->_id,
            'newName' => $this->_newName,
        );
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addChild('id', $this->_id);
        $this->xml->addChild('newName', $this->_newName);
        return parent::toXml();
    }
}
