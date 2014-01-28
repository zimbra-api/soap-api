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
class Sync extends Request
{
    /**
     * Constructor method for Sync
     * @param  string $token
     * @param  int   $calCutoff
     * @param  string $l
     * @param  bool   $typed
     * @return self
     */
    public function __construct(
        $token = null,
        $calCutoff = null,
        $l = null,
        $typed = null
    )
    {
        parent::__construct();
        if(null !== $token)
        {
            $this->property('token', trim($token));
        }
        if(null !== $calCutoff)
        {
            $this->property('calCutoff', (int) $calCutoff);
        }
        if(null !== $l)
        {
            $this->property('l', trim($l));
        }
        if(null !== $typed)
        {
            $this->property('typed', (bool) $typed);
        }
    }

    /**
     * Get or set token
     *
     * @param  string $token
     * @return string|self
     */
    public function token($token = null)
    {
        if(null === $token)
        {
            return $this->property('token');
        }
        return $this->property('token', trim($token));
    }

    /**
     * Get or set calCutoff
     *
     * @param  int $calCutoff
     * @return int|self
     */
    public function calCutoff($calCutoff = null)
    {
        if(null === $calCutoff)
        {
            return $this->property('calCutoff');
        }
        return $this->property('calCutoff', (int) $calCutoff);
    }

    /**
     * Get or set l
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->property('l');
        }
        return $this->property('l', trim($l));
    }

    /**
     * Get or set typed
     *
     * @param  bool $typed
     * @return bool|self
     */
    public function typed($typed = null)
    {
        if(null === $typed)
        {
            return $this->property('typed');
        }
        return $this->property('typed', (bool) $typed);
    }
}
