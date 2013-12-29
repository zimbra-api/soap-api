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
use Zimbra\Soap\Struct\ContactSpec;

/**
 * CreateContact request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateContact extends Request
{
    /**
     * Contact specification
     * @var ContactSpec
     */
    private $_cn;

    /**
     * If set (defaults to unset) The returned <cn> is just a placeholder containing the new contact ID (i.e. <cn id="{id}"/>)
     * @var bool
     */
    private $_verbose;

    /**
     * Constructor method for CreateContact
     * @param  ContactSpec $cn
     * @param  bool $verbose
     * @return self
     */
    public function __construct(ContactSpec $cn, $verbose = null)
    {
        parent::__construct();
        $this->_cn = $cn;
        if(null !== $verbose)
        {
            $this->_verbose = (bool) $verbose;
        }
    }

    /**
     * Get or set cn
     *
     * @param  ContactSpec $cn
     * @return ContactSpec|self
     */
    public function cn(ContactSpec $cn = null)
    {
        if(null === $cn)
        {
            return $this->_cn;
        }
        $this->_cn = $cn;
        return $this;
    }

    /**
     * Get or set verbose
     *
     * @param  bool $verbose
     * @return bool|self
     */
    public function verbose($verbose = null)
    {
        if(null === $verbose)
        {
            return $this->_verbose;
        }
        $this->_verbose = (bool) $verbose;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(is_bool($this->_verbose))
        {
            $this->array['verbose'] = $this->_verbose ? 1 : 0;
        }
        $this->array += $this->_cn->toArray('cn');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if(is_bool($this->_verbose))
        {
            $this->xml->addAttribute('verbose', $this->_verbose ? 1 : 0);
        }
        $this->xml->append($this->_cn->toXml('cn'));
        return parent::toXml();
    }
}
