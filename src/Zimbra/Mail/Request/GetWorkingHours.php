<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Soap\Request;

/**
 * GetWorkingHours request class
 * User's working hours within the given time range are expressed in a similar format to the format used for GetFreeBusy. 
 * Working hours are indicated as free, non-working hours as unavailable/out of office.
 * The entire time range is marked as unknown if there was an error determining the working hours, e.g. unknown user.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetWorkingHours extends Request
{
    /**
     * Constructor method for GetWorkingHours
     * @param  int $s
     * @param  int $e
     * @param  string $id
     * @param  string $name
     * @return self
     */
    public function __construct($s, $e, $id = null, $name = null)
    {
        parent::__construct();
        $this->property('s', (int) $s);
        $this->property('e', (int) $e);
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
    }

    /**
     * Get or set s
     *
     * @param  int $s
     * @return int|self
     */
    public function s($s = null)
    {
        if(null === $s)
        {
            return $this->property('s');
        }
        return $this->property('s', (int) $s);
    }

    /**
     * Get or set e
     *
     * @param  int $e
     * @return int|self
     */
    public function e($e = null)
    {
        if(null === $e)
        {
            return $this->property('e');
        }
        return $this->property('e', (int) $e);
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }
}
