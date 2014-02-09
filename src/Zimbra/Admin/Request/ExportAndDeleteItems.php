<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Admin\Struct\ExportAndDeleteMailboxSpec as Mailbox;

/**
 * ExportAndDeleteItems request class
 * Exports the database data for the given items with SELECT INTO OUTFILE and deletes the items from the mailbox.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExportAndDeleteItems extends Base
{
    /**
     * Constructor method for ExportAndDeleteItemSpec
     * @param  Mailbox $mbox Mailbox
     * @param  string $exportDir Export filename prefix
     * @param  string $exportFilenamePrefix Path for export dir
     * @return self
     */
    public function __construct(Mailbox $mbox, $exportDir = null, $exportFilenamePrefix = null)
    {
        parent::__construct();
        $this->child('mbox', $mbox);
        if(null !== $exportDir)
        {
            $this->property('exportDir', trim($exportDir));
        }
        if(null !== $exportFilenamePrefix)
        {
            $this->property('exportFilenamePrefix', trim($exportFilenamePrefix));
        }
    }

    /**
     * Gets or sets mbox
     *
     * @param  Mailbox $mbox
     * @return Mailbox|self
     */
    public function mbox(Mailbox $mbox = null)
    {
        if(null === $mbox)
        {
            return $this->child('mbox');
        }
        return $this->child('mbox', $mbox);
    }

    /**
     * Gets or sets exportDir
     *
     * @param  string $exportDir
     * @return string|self
     */
    public function exportDir($exportDir = null)
    {
        if(null === $exportDir)
        {
            return $this->property('exportDir');
        }
        return $this->property('exportDir', trim($exportDir));
    }

    /**
     * Gets or sets exportFilenamePrefix
     *
     * @param  string $exportFilenamePrefix
     * @return string|self
     */
    public function exportFilenamePrefix($exportFilenamePrefix = null)
    {
        if(null === $exportFilenamePrefix)
        {
            return $this->property('exportFilenamePrefix');
        }
        return $this->property('exportFilenamePrefix', trim($exportFilenamePrefix));
    }
}
