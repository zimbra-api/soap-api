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

use Zimbra\Common\TypedSequence;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Struct\Id;

/**
 * GetMiniCal request class
 * Get information needed for Mini Calendar. 
 * Date is returned if there is at least one appointment on that date.
 * The date computation uses the requesting (authenticated) account's time zone, not the time zone of the account that owns the calendar folder.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetMiniCal extends Base
{
    /**
     * Local and/or remote calendar folders
     * @var TypedSequence<Id>
     */
    private $_folder;

    /**
     * Constructor method for GetMiniCal
     * @param  int $s
     * @param  int $e
     * @param  array $folder
     * @param  CalTZInfo $tz
     * @return self
     */
    public function __construct(
        $s,
        $e,
        array $folder = array(),
        CalTZInfo $tz = null
    )
    {
        parent::__construct();
        $this->property('s', (int) $s);
        $this->property('e', (int) $e);
        $this->_folder = new TypedSequence('Zimbra\Struct\Id', $folder);
        if($tz instanceof CalTZInfo)
        {
            $this->child('tz', $tz);
        }

        $this->on('before', function(Base $sender)
        {
            if($sender->folder()->count())
            {
                $sender->child('folder', $sender->folder()->all());
            }
        });
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
     * Add folder
     *
     * @param  Id $folder
     * @return self
     */
    public function addFolder(Id $folder)
    {
        $this->_folder->add($folder);
        return $this;
    }

    /**
     * Gets folder sequence
     *
     * @return Sequence
     */
    public function folder()
    {
        return $this->_folder;
    }

    /**
     * Get or set tz
     * Optional timezone specifier.
     * References an existing server-known timezone by ID or the full specification of a custom timezone
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
