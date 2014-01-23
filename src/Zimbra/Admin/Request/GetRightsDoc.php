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
use Zimbra\Soap\Request;

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
class GetRightsDoc extends Request
{
    /**
     * Packages
     * @var array
     */
    private $_package;

    /**
     * Constructor method for GetRightsDoc
     * @param array $package
     * @return self
     */
    public function __construct(array $package = array())
    {
        parent::__construct();
        $this->_package = new TypedSequence('Zimbra\Admin\Struct\PackageSelector', $package);

        $this->addHook(function($sender)
        {
            $sender->child('package', $sender->package()->all());
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
        $this->_package->add($package);
        return $this;
    }

    /**
     * Gets package sequence
     *
     * @return Sequence
     */
    public function package()
    {
        return $this->_package;
    }
}
