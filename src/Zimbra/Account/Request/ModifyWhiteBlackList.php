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

/**
 * ModifyWhiteBlackList request class
 * Modify the anti-spam WhiteList and BlackList addresses 
 *
 * @package    Zimbra
 * @subpackage WhiteList
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyWhiteBlackList extends Base
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
            $this->setChild('whiteList', $whiteList);
        }
        else
        {
            $this->setChild('whiteList', new WhiteList);
        }
        if($blackList instanceof BlackList)
        {
            $this->setChild('blackList', $blackList);
        }
        else
        {
            $this->setChild('blackList', new BlackList);
        }
    }

    /**
     * Gets the white list
     *
     * @return WhiteList
     */
    public function getWhiteList()
    {
        return $this->getChild('whiteList');
    }

    /**
     * Sets the white list
     *
     * @param  WhiteList $whiteList
     * @return self
     */
    public function setWhiteList(WhiteList $whiteList)
    {
        return $this->setChild('whiteList', $whiteList);
    }

    /**
     * Gets the black list
     *
     * @return BlackList
     */
    public function getBlackList()
    {
        return $this->getChild('blackList');
    }

    /**
     * Sets the black list
     *
     * @param  BlackList $blackList
     * @return self
     */
    public function setBlackList(BlackList $blackList)
    {
        return $this->setChild('blackList', $blackList);
    }
}
