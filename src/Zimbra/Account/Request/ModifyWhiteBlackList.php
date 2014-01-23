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

use Zimbra\Account\Struct\BlackList;
use Zimbra\Account\Struct\WhiteList;
use Zimbra\Soap\Request;

/**
 * ModifyWhiteBlackList request class
 * Modify the anti-spam WhiteList and BlackList addresses 
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyWhiteBlackList extends Request
{
    /**
     * Constructor method for ModifyWhiteBlackList
     * @param WhiteList $whiteList
     * @param BlackList $blackList
     * @return self
     */
    public function __construct(WhiteList $whiteList = null, BlackList $blackList = null)
    {
        parent::__construct();
        if($whiteList instanceof WhiteList)
        {
            $this->child('whiteList', $whiteList);
        }
        else
        {
            $this->child('whiteList', new WhiteList);
        }
        if($blackList instanceof BlackList)
        {
            $this->child('blackList', $blackList);
        }
        else
        {
            $this->child('blackList', new BlackList);
        }
    }

    /**
     * Gets or sets whiteList
     *
     * @param  WhiteList $whiteList
     * @return WhiteList|self
     */
    public function whiteList(WhiteList $whiteList = null)
    {
        if(null === $whiteList)
        {
            return $this->child('whiteList');
        }
        return $this->child('whiteList', $whiteList);
    }

    /**
     * Gets or sets blackList
     *
     * @param  BlackList $blackList
     * @return BlackList|self
     */
    public function blackList(BlackList $blackList = null)
    {
        if(null === $blackList)
        {
            return $this->child('blackList');
        }
        return $this->child('blackList', $blackList);
    }
}
