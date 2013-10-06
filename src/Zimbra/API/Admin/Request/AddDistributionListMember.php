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
 * AddDistributionListAlias class
 * Adding members to a distribution list
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddDistributionListMember extends Request
{
    /**
     * Zimbra ID
     * @var string
     */
    private $_id;

    /**
     * Members
     * @var array
     */
    private $_dlms = array();

    /**
     * Constructor method for AddDistributionListMember
     * @param  string $id
     * @param  array  $dlms
     * @return self
     */
    public function __construct($id, array $dlms)
    {
        parent::__construct();
        $this->_id = trim($id);
        $this->dlms($dlms);
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
     * Gets or sets dlms
     *
     * @param  array $dlms
     * @return array|self
     */
    public function dlms(array $dlms = null)
    {
        if(null === $dlms)
        {
            return $this->_dlms;
        }
        $this->_dlms = array();
        foreach ($dlms as $dlm)
        {
            $dlm = trim($dlm);
            if(!empty($dlm))
            {
                $this->_dlms[] = $dlm;
            }
        }
        if(!count($this->_dlms))
        {
            throw new \InvalidArgumentException('AddDistributionListMember must have at least a member');
        }
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
        );
        if(count($this->_dlms))
        {
            $this->array['dlm'] = array();
            foreach ($this->_dlms as $dlm)
            {
                $this->array['dlm'][] = $dlm;
            }
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
        $this->xml->addAttribute('id', $this->_id);
        foreach ($this->_dlms as $dlm)
        {
            $this->xml->addChild('dlm', $dlm);
        }
        return parent::toXml();
    }
}
