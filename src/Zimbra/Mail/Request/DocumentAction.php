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

use Zimbra\Mail\Struct\DocumentActionSelector;

/**
 * DocumentAction request class
 * Document Action
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DocumentAction extends Base
{
    /**
     * Constructor method for DocumentAction
     * @param  DocumentActionSelector $action
     * @return self
     */
    public function __construct(DocumentActionSelector $action)
    {
        parent::__construct();
        $this->setChild('action', $action);
    }

    /**
     * Gets document specific operations
     *
     * @return DocumentActionSelector
     */
    public function getAction()
    {
        return $this->getChild('action');
    }

    /**
     * Sets document specific operations
     *
     * @param  DocumentActionSelector $action
     * @return self
     */
    public function setAction(DocumentActionSelector $action)
    {
        return $this->setChild('action', $action);
    }
}
