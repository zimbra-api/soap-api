<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full cnameyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Struct;

use Zimbra\Struct\Base;

/**
 * CallFeatureInfo struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class CallFeatureInfo extends Base
{
    /**
     * Constructor method for CallFeatureInfo
     * @param bool $subscribed Flag whether subscribed or not
     * @param bool $active Flag whether active or not
     * @return self
     */
    public function __construct($subscribed, $active)
    {
        parent::__construct();
        $this->setProperty('s', (bool) $subscribed);
        $this->setProperty('a', (bool) $active);
    }

    /**
     * Gets subscribed
     *
     * @return bool
     */
    public function getSubscribed()
    {
        return $this->getProperty('s');
    }

    /**
     * Sets subscribed
     *
     * @param  bool $subscribed
     * @return self
     */
    public function setSubscribed($subscribed)
    {
        return $this->setProperty('s', (bool) $subscribed);
    }

    /**
     * Gets active
     *
     * @return string
     */
    public function getActive()
    {
        return $this->getProperty('a');
    }

    /**
     * Sets active
     *
     * @param  string $active
     * @return self
     */
    public function setActive($active)
    {
        return $this->setProperty('a', (bool) $active);
    }
}
