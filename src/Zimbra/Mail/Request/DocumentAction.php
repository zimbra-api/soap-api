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
class DocumentAction extends Request
{
    /**
     * Constructor method for DocumentAction
     * @param  DocumentActionSelector $action
     * @return self
     */
    public function __construct(DocumentActionSelector $action)
    {
        parent::__construct();
        $this->child('action', $action);
    }

    /**
     * Get or set action
     * Document action selector.
     * Document specific operations : watch|!watch|grant|!grant.
     *
     * @param  DocumentActionSelector $action
     * @return DocumentActionSelector|self
     */
    public function action(DocumentActionSelector $action = null)
    {
        if(null === $action)
        {
            return $this->child('action');
        }
        return $this->child('action', $action);
    }
}
