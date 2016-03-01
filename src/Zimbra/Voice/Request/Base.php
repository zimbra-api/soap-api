<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Request;

use Zimbra\Soap\Request;

/**
 * Base voice request class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class Base extends Request
{
    /**
     * Constructor method for base request
     * @param  string $value
     * @return self
     */
    public function __construct($value = null)
    {
        parent::__construct($value);
        $this->setXmlNamespace('urn:zimbraVoice');
    }
}