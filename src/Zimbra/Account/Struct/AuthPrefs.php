<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\XmlRoot;

/**
 * AuthPrefs struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @XmlRoot(name="prefs")
 */
class AuthPrefs
{
    use PrefsImplTrail {
        PrefsImplTrail::__construct as private __prefsConstruct;
    }

    /**
     * AuthPrefs constructor.
     * @param array $prefs
     */
    public function __construct(array $prefs = [])
    {
        $this->__prefsConstruct($prefs);
    }
}
