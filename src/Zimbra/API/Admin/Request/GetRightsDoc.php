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
use Zimbra\Soap\Struct\PackageSelector as Package;

/**
 * GetRightsDoc class
 * Get Rights Document.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetRightsDoc extends Request
{
    /**
     * Packages
     * @var array
     */
    private $_packages = array();

    /**
     * Constructor method for GetRightsDoc
     * @param array $packages
     * @return self
     */
    public function __construct(array $packages = array())
    {
        parent::__construct();
        $this->packages($packages);
    }

    /**
     * Add an attr
     *
     * @param  Package $package
     * @return self
     */
    public function addPackage(Package $package)
    {
        $this->_packages[] = $package;
        return $this;
    }

    /**
     * Gets or sets packages
     *
     * @param  array $packages
     * @return array|self
     */
    public function packages(array $packages = null)
    {
        if(null === $packages)
        {
            return $this->_packages;
        }
        $this->_packages = array();
        foreach ($packages as $package)
        {
            if($package instanceof Package)
            {
                $this->_packages[] = $package;
            }
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
        if(count($this->_packages))
        {
            $this->array['package'] = array();
            foreach ($this->_packages as $package)
            {
                $packageArr = $package->toArray('package');
                $this->array['package'][] = $packageArr['package'];
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
        foreach ($this->_packages as $package)
        {
            $this->xml->append($package->toXml('package'));
        }
        return parent::toXml();
    }
}
