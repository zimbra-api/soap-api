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
 * Sync request class
 * Sync
 *   - Sync on other mailbox is done via specifying target account in SOAP header
 *   - If we're delta syncing on another user's mailbox and any token have changed:
 *      - If there are now no visible token, you'll get an empty <folder/> element
 *      - If there are any visible token, you'll get the full visible folder hierarchy
 *   - If a {root-folder-id} other than the mailbox root (folder 1) is requested or if not all token are visible when syncing to another user's mailbox, all changed items in other token are presented as deletes
 *   - If the response is a mail.MUST_RESYNC fault, client has fallen too far out of date and must re-initial sync
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class Sync extends Base
{
    /**
     * Constructor method for Sync
     * @param  string $token
     * @param  int    $calCutoff
     * @param  string $folderId
     * @param  bool   $typed
     * @return self
     */
    public function __construct(
        $token = null,
        $calCutoff = null,
        $folderId = null,
        $typed = null
    )
    {
        parent::__construct();
        if(null !== $token)
        {
            $this->setProperty('token', trim($token));
        }
        if(null !== $calCutoff)
        {
            $this->setProperty('calCutoff', (int) $calCutoff);
        }
        if(null !== $folderId)
        {
            $this->setProperty('l', trim($folderId));
        }
        if(null !== $typed)
        {
            $this->setProperty('typed', (bool) $typed);
        }
    }

    /**
     * Gets token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->getProperty('token');
    }

    /**
     * Sets token
     *
     * @param  string $token
     * @return self
     */
    public function setToken($token)
    {
        return $this->setProperty('token', trim($token));
    }

    /**
     * Gets earliest calendar date
     *
     * @return int
     */
    public function getCalendarCutoff()
    {
        return $this->getProperty('calCutoff');
    }

    /**
     * Sets earliest calendar date
     *
     * @param  int $calendarCutoff
     * @return self
     */
    public function setCalendarCutoff($calendarCutoff)
    {
        return $this->setProperty('calCutoff', (int) $calendarCutoff);
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

    /**
     * Gets typed deletes
     *
     * @return bool
     */
    public function getTypedDeletes()
    {
        return $this->getProperty('typed');
    }

    /**
     * Sets typed deletes
     *
     * @param  bool $typedDeletes
     * @return self
     */
    public function setTypedDeletes($typedDeletes)
    {
        return $this->setProperty('typed', (bool) $typedDeletes);
    }
}
