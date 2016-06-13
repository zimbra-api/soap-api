<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

use Zimbra\Account\Struct\PrefsImplTrail;

/**
 * ModifyPrefs request class
 * Modify Preferences
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyPrefs extends Base
{
    use PrefsImplTrail {
        PrefsImplTrail::__construct as private __prefsConstruct;
    }

    /**
     * Constructor method for GetPrefs
     * @param array $prefs
     * @return self
     */
    public function __construct(array $prefs = [])
    {
        $this->__prefsConstruct($prefs);
    }
}
