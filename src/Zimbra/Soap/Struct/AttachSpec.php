<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * AttachSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class AttachSpec
{
    /**
     * Optional
     * @var bool
     */
    protected $_optional;

    /**
     * Constructor method for AttachSpec
     * @param  bool $optional
     * @return self
     */
    public function __construct($optional = null)
    {
        if(null !== $optional)
        {
            $this->_optional = (bool) $optional;
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
            return $this->_optional;
        }
        $this->_optional = (bool) $optional;
        return $this;
    }
}
