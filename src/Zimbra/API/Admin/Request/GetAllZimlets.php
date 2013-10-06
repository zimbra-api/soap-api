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
 * GetAllZimlets class
 * Get all Zimlets.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAllZimlets extends Request
{
    /**
     * Exclude can be "none|extension|mail"
     * extension: return only mail Zimlets
     * mail: return only admin extensions
     * none [default]: return both mail and admin zimlets
     * @var string
     */
    private $_exclude;

    /**
     * Constructor method for GetAllZimlets
     * @param  string $exclude
     * @return self
     */
    public function __construct($exclude = null)
    {
        parent::__construct();
		$this->_exclude = in_array(trim($exclude), array('extension', 'mail', 'none')) ? trim($exclude) : null;
    }

    /**
     * Gets or sets exclude
     *
     * @param  string $exclude
     * @return string|self
     */
    public function exclude($exclude = null)
    {
        if(null === $exclude)
        {
            return $this->_exclude;
        }
		$this->_exclude = in_array(trim($exclude), array('extension', 'mail', 'none')) ? trim($exclude) : null;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(!empty($this->_exclude))
        {
            $this->array['exclude'] = $this->_exclude;
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
        if(!empty($this->_exclude))
        {
            $this->xml->addAttribute('exclude', $this->_exclude);
        }
        return parent::toXml();
    }
}
