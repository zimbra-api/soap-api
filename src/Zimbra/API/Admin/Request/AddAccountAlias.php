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
 * AddAccountAlias class
 * Add an alias for the account
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddAccountAlias extends Request
{
    /**
     * Zimbra ID
     * @var string
     */
    private $_id;

    /**
     * Alias
     * @var string
     */
    private $_alias;

    /**
     * Constructor method for AddAccountAlias
     * @param  string $id
     * @param  string $alias
     * @return self
     */
    public function __construct($id, $alias)
    {
        parent::__construct();
        $this->_id = trim($id);
        $this->_alias = trim($alias);
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
     * Gets or sets alias
     *
     * @param  string $alias
     * @return string|self
     */
    public function alias($alias = null)
    {
        if(null === $alias)
        {
            return $this->_alias;
        }
        $this->_alias = trim($alias);
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
            'alias' => $this->_alias,
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
        $this->xml->addAttribute('id', $this->_id)
                  ->addAttribute('alias', $this->_alias);
        return parent::toXml();
    }
}
