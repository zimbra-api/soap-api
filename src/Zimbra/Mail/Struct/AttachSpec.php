<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Struct\Base;

/**
 * AttachSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class AttachSpec extends Base
{
    /**
     * Constructor method for AttachSpec
     * @param  bool $optional Optional
     * @return self
     */
    public function __construct($optional = null)
    {
        parent::__construct();
        if(null !== $optional)
        {
            $this->property('optional', (bool) $optional);
        }
    }
    /**
     * Gets or sets part
     *
     * @param  bool $optional
     * @return bool|optional
     */
    public function optional($optional = null)
    {
        if(null === $optional)
        {
            return $this->property('optional');
        }
        return $this->property('optional', (bool) $optional);
    }
}
