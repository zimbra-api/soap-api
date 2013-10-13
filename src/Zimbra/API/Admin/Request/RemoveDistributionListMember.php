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
use PhpCollection\Sequence;

/**
 * RemoveDistributionListMember class
 * Remove Distribution List Member
 * Unlike add, remove of a non-existent member causes an exception and no modification to the list.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RemoveDistributionListMember extends Request
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
    private $_dlms;

    /**
     * Constructor method for RemoveDistributionListMember
     * @param  string $id
     * @param  array  $dlms
     * @return self
     */
    public function __construct($id, array $dlms)
    {
        parent::__construct();
        $this->_id = trim($id);
        $this->_dlms = new Sequence($dlms);
        $this->normalizeDlms();
        if(!count($this->_dlms))
        {
            throw new \InvalidArgumentException('AddDistributionListMember must have at least a member');
        }
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
     * Add a member
     *
     * @param  string $dlm
     * @return self
     */
    public function addDlm($dlm)
    {
        $dlm = trim($dlm);
        if(!empty($dlm))
        {
            $this->_dlms->add($dlm);
        }
        return $this;
    }

    /**
     * Gets dlm sequence
     *
     * @return Sequence
     */
    public function dlms()
    {
        return $this->_dlms;
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
        $this->normalizeDlms();
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
        $this->normalizeDlms();
        foreach ($this->_dlms as $dlm)
        {
            $this->xml->addChild('dlm', $dlm);
        }
        return parent::toXml();
    }

    private function normalizeDlms()
    {
        $this->_dlms = $this->_dlms->filter(function($dlm)
        {
            $dlm = trim($dlm);
            return !empty($dlm);
        });
    }
}
