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

use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\DtTimeInfo;

/**
 * CompleteTaskInstance request class
 * Complete a task instance
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CompleteTaskInstance extends Base
{
    /**
     * Constructor method for CompleteTaskInstance
     * @param  string $id
     * @param  DtTimeInfo $exceptId
     * @param  CalTZInfo $tz
     * @return self
     */
    public function __construct(
        $id,
        DtTimeInfo $exceptId,
        CalTZInfo $tz = null
    )
    {
        parent::__construct();
        $this->property('id', trim($id));
        $this->child('exceptId', $exceptId);
        if($tz instanceof CalTZInfo)
        {
            $this->child('tz', $tz);
        }
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
     * Gets or sets exceptId
     * Exception ID
     *
     * @param  DtTimeInfo $exceptId
     * @return DtTimeInfo|self
     */
    public function exceptId(DtTimeInfo $exceptId = null)
    {
        if(null === $exceptId)
        {
            return $this->child('exceptId');
        }
        return $this->child('exceptId', $exceptId);
    }

    /**
     * Gets or sets tz
     * Timezone information
     *
     * @param  CalTZInfo $tz
     * @return CalTZInfo|self
     */
    public function tz(CalTZInfo $tz = null)
    {
        if(null === $tz)
        {
            return $this->child('tz');
        }
        return $this->child('tz', $tz);
    }
}
