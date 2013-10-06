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
 * VersionCheck class
 * Version Check.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class VersionCheck extends Request
{
    /**
     * Certificate attach ID
     * @var string
     */
    private $_action;

    /**
     * Constructor method for UploadProxyCA
     * @param string $action
     * @return self
     */
    public function __construct($action)
    {
        parent::__construct();
        $this->_action = in_array(trim($action), array('check', 'status')) ? trim($action) : 'check';
    }

    /**
     * Gets or sets action
     *
     * @param  string $action
     * @return string|self
     */
    public function action($action = null)
    {
        if(null === $action)
        {
            return $this->_action;
        }
        $this->_action = in_array(trim($action), array('check', 'status')) ? trim($action) : 'check';
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
            'action' => $this->_action,
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
        $this->xml->addAttribute('action', $this->_action);
        return parent::toXml();
    }
}
