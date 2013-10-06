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
use Zimbra\Soap\Struct\CosSelector as Cos;

/**
 * GetSystemRetentionPolicy class
 * Get System Retention Policy.
 * The system retention policy SOAP APIs allow the administrator to edit named system retention policies that users can apply to folders and tags.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetSystemRetentionPolicy extends Request
{
    /**
     * Cos
     * @var Cos
     */
    private $_cos;

    /**
     * Constructor method for GetSystemRetentionPolicy
     * @param  Cos $cos
     * @return self
     */
    public function __construct(Cos $cos = null)
    {
        parent::__construct();
        if($cos instanceof Cos)
        {
            $this->_cos = $cos;
        }
    }

    /**
     * Gets or sets cos
     *
     * @param  Cos $cos
     * @return Cos|self
     */
    public function cos(Cos $cos = null)
    {
        if(null === $cos)
        {
            return $this->_cos;
        }
        $this->_cos = $cos;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_cos instanceof Cos)
        {
            $this->array += $this->_cos->toArray();
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
        if($this->_cos instanceof Cos)
        {
            $this->xml->append($this->_cos->toXml());
        }
        return parent::toXml();
    }
}
