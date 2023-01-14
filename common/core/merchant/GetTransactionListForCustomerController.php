<?php

namespace common\core\merchant;

use net\authorize\api\contract\v1\ANetApiRequestType;
use net\authorize\api\controller\base\ApiOperationBase;

class GetTransactionListForCustomerController extends ApiOperationBase
{
    public function __construct(AnetApiRequestType $request)
    {
        $responseType = 'net\authorize\api\contract\v1\GetTransactionListResponse';
        parent::__construct($request, $responseType);
    }
}