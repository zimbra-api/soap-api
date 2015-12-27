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

use Zimbra\Mail\Struct\PurgeRevisionSpec;

/**
 * PurgeRevision request class
 * Purge revision
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class PurgeRevision extends Base
{
    /**
     * Constructor method for PurgeRevision
     * @param  PurgeRevisionSpec $revision
     * @return self
     */
    public function __construct(PurgeRevisionSpec $revision)
    {
        parent::__construct();
        $this->setChild('revision', $revision);
    }

    /**
     * Gets specification or revision to purge
     *
     * @return PurgeRevisionSpec
     */
    public function getRevision()
    {
        return $this->getChild('revision');
    }

    /**
     * Sets specification or revision to purge
     *
     * @param  PurgeRevisionSpec $revision
     * @return self
     */
    public function setRevision(PurgeRevisionSpec $revision)
    {
        return $this->setChild('revision', $revision);
    }
}
