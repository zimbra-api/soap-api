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
     * @param bool $s
     * @param bool $a
     * @return self
     */
    public function __construct($s, $a)
    {
        parent::__construct();
        $this->property('s', (bool) $s);
        $this->property('a', (bool) $a);
    }

    /**
     * Gets or sets s
     * Flag whether subscribed or not
     *
     * @param  bool $s
     * @return bool|self
     */
    public function s($s = null)
    {
        if(null === $s)
        {
            return $this->property('s');
        }
        return $this->property('s', (bool) $s);
    }

    /**
     * Gets or sets a
     * Flag whether active or not
     *
     * @param  bool $a
     * @return bool|self
     */
    public function a($a = null)
    {
        if(null === $a)
        {
            return $this->property('a');
        }
        return $this->property('a', (bool) $a);
    }
}
