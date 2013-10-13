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
use Zimbra\Soap\Enum\ZimletExcludeType as ExcludeType;

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
     * @var ExcludeType
     */
    private $_exclude;

    /**
     * Constructor method for GetAllZimlets
     * @param  ExcludeType $exclude
     * @return self
     */
    public function __construct(ExcludeType $exclude = null)
    {
        parent::__construct();
        if($exclude instanceof ExcludeType)
        {
            $this->_exclude = $exclude;
        }
    }

    /**
     * Gets or sets exclude
     *
     * @param  ExcludeType $exclude
     * @return ExcludeType|self
     */
    public function exclude(ExcludeType $exclude = null)
    {
        if(null === $exclude)
        {
            return $this->_exclude;
        }
		$this->_exclude = $exclude;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_exclude instanceof ExcludeType)
        {
            $this->array['exclude'] = (string) $this->_exclude;
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
        if($this->_exclude instanceof ExcludeType)
        {
            $this->xml->addAttribute('exclude', (string) $this->_exclude);
        }
        return parent::toXml();
    }
}
