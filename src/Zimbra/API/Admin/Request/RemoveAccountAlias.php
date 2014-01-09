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
 * RemoveAccountAlias class
 * Remove Account Alias.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RemoveAccountAlias extends Request
{
    /**
     * Alias
     * @var string
     */
    private $_alias;

    /**
     * Zimbra ID
     * @var string
     */
    private $_id;

    /**
     * Constructor method for RemoveAccountAlias
     * @param string $alias
     * @param string $id
     * @return self
     */
    public function __construct($alias, $id = null)
    {
        parent::__construct();
        $this->_alias = trim($alias);
        $this->_id = trim($id);
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
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'alias' => $this->_alias,
        );
        if(!empty($this->_id))
        {
            $this->array['id'] = $this->_id;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('alias', $this->_alias);
        if(!empty($this->_id))
        {
            $this->xml->addAttribute('id', $this->_id);
        }
        return parent::toXml();
    }
}
