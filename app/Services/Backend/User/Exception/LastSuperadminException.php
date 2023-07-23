<?php

namespace App\Services\Backend\User\Exception;

use Exception;
use Throwable;

class LastSuperadminException extends Exception
{
    /**
     * @param int             $code
     * @param null|\Throwable $previous
     */
    public function __construct(
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct(__('backend.cant_remove_last_admin'), $code, $previous);
    }
}
