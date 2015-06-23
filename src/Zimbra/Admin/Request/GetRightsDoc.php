<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Admin\Struct\PackageSelector as Package;
use Zimbra\Common\TypedSequence;

/**
 * GetRightsDoc request class
 * Get Rights Document.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetRightsDoc extends Base
{
    /**
     * Packages
     * @var array
     */
    private $_packages;

    /**
     * Constructor method for GetRightsDoc
     * @param array $packages
     * @return self
     */
    public function __construct(array $packages = [])
    {
        parent::__construct();
        $this->setPackages($packages);

        $this->on('before', function(Base $sender)
        {
            if($sender->getPackages()->count())
            {
                $sender->setChild('package', $sender->getPackages()->all());
            }
        });
    }

    /**
     * Add an attr
     *
     * @param  Package $package
     * @return self
     */
    public function addPackage(Package $package)
    {
        $this->_packages->add($package);
        return $this;
    }

    /**
     * Sets package sequence
     *
     * @param array $packages
     * @return self
     */
    public function setPackages(array $packages)
    {
        $this->_packages = new TypedSequence('Zimbra\Admin\Struct\PackageSelector', $packages);
        return $this;
    }

    /**
     * Gets package sequence
     *
     * @return Sequence
     */
    public function getPackages()
    {
        return $this->_packages;
    }
}
