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

/**
 * GetApptSummaries request class
 * Get appointment summaries
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetApptSummaries extends Base
{
    /**
     * Constructor method for GetApptSummaries
     * @param  int    $startTime
     * @param  int    $endTime
     * @param  string $folderId
     * @return self
     */
    public function __construct($startTime, $endTime, $folderId = null)
    {
        parent::__construct();
        $this->setProperty('s', (int) $startTime);
        $this->setProperty('e', (int) $endTime);
        if(null !== $folderId)
        {
            $this->setProperty('l', trim($folderId));
        }
    }

    /**
     * Gets range start
     *
     * @return int
     */
    public function getStartTime()
    {
        return $this->getProperty('s');
    }

    /**
     * Sets range start
     *
     * @param  int $startTime
     * @return self
     */
    public function setStartTime($startTime)
    {
        return $this->setProperty('s', (int) $startTime);
    }

    /**
     * Gets range end
     *
     * @return int
     */
    public function getEndTime()
    {
        return $this->getProperty('e');
    }

    /**
     * Sets range end
     *
     * @param  int $endTime
     * @return self
     */
    public function setEndTime($endTime)
    {
        return $this->setProperty('e', (int) $endTime);
    }

    /**
     * Gets folder Id
     *
     * @return string
     */
    public function getFolderId()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets folder Id
     *
     * @param  string $folderId
     * @return self
     */
    public function setFolderId($folderId)
    {
        return $this->setProperty('l', trim($folderId));
    }
}
