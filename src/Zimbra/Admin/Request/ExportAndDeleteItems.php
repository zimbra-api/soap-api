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
     * @param  string $exportDir Path for export dir
     * @param  string $prefix Export filename prefix
     * @return self
     */
    public function __construct(Mailbox $mbox, $exportDir = null, $prefix = null)
    {
        parent::__construct();
        $this->setChild('mbox', $mbox);
        if(null !== $exportDir)
        {
            $this->setProperty('exportDir', trim($exportDir));
        }
        if(null !== $prefix)
        {
            $this->setProperty('exportFilenamePrefix', trim($prefix));
        }
    }

    /**
     * Gets the mail box.
     *
     * @return Mailbox
     */
    public function getMailbox()
    {
        return $this->getChild('mbox');
    }

    /**
     * Sets the mail box.
     *
     * @param  Mailbox $mbox
     * @return self
     */
    public function setMailbox(Mailbox $mbox)
    {
        return $this->setChild('mbox', $mbox);
    }

    /**
     * Gets export dir
     *
     * @return string
     */
    public function getExportDir()
    {
        return $this->getProperty('exportDir');
    }

    /**
     * Sets export dir
     *
     * @param  string $exportDir
     * @return self
     */
    public function setExportDir($exportDir)
    {
        return $this->setProperty('exportDir', trim($exportDir));
    }

    /**
     * Gets export filename prefix
     *
     * @return string
     */
    public function getExportFilenamePrefix()
    {
        return $this->getProperty('exportFilenamePrefix');
    }

    /**
     * Sets export filename prefix
     *
     * @param  string $prefix
     * @return self
     */
    public function setExportFilenamePrefix($prefix)
    {
        return $this->setProperty('exportFilenamePrefix', trim($prefix));
    }
}
