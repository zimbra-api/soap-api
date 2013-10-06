<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\ExportAndDeleteMailboxSpec as Mailbox;

/**
 * ExportAndDeleteItems class
 * Exports the database data for the given items with SELECT INTO OUTFILE and deletes the items from the mailbox.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExportAndDeleteItems extends Request
{
    /**
     * Path for export dir
     * @var string
     */
    private $_exportDir;

    /**
     * Export filename prefix
     * @var string
     */
    private $_exportFilenamePrefix;

    /**
     * Mailbox
     * @var Mailbox
     */
    private $_mbox;

    /**
     * Constructor method for ExportAndDeleteItemSpec
     * @param  Mailbox $mbox
     * @param  string $exportDir
     * @param  string $exportFilenamePrefix
     * @return self
     */
    public function __construct(Mailbox $mbox, $exportDir = null, $exportFilenamePrefix = null)
    {
        parent::__construct();
        $this->_mbox = $mbox;
        $this->_exportDir = trim($exportDir);
        $this->_exportFilenamePrefix = trim($exportFilenamePrefix);
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
            return $this->_mbox;
        }
        $this->_mbox = $mbox;
        return $this;
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
            return $this->_exportDir;
        }
        $this->_exportDir = trim($exportDir);
        return $this;
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
            return $this->_exportFilenamePrefix;
        }
        $this->_exportFilenamePrefix = trim($exportFilenamePrefix);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array += $this->_mbox->toArray('mbox');
        if(!empty($this->_exportDir))
        {
            $this->array['exportDir'] = $this->_exportDir;
        }
        if(!empty($this->_exportFilenamePrefix))
        {
            $this->array['exportFilenamePrefix'] = $this->_exportFilenamePrefix;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_mbox->toXml('mbox'));
        if(!empty($this->_exportDir))
        {
            $this->xml->addAttribute('exportDir', $this->_exportDir);
        }
        if(!empty($this->_exportFilenamePrefix))
        {
            $this->xml->addAttribute('exportFilenamePrefix', $this->_exportFilenamePrefix);
        }
        return parent::toXml();
    }
}
