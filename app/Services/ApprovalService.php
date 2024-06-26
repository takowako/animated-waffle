<?php


namespace App\Services;

use App\Models\ApprovalRequest;

class ApprovalService
{

    public function store($model, $data)
    {
        //save approval request 
        ApprovalRequest::create([
            'action' => 'create',
            'changes' => json_encode($data),
            'model' => $model,
        ]);
    }

    public function approve($data)
    {

        switch ($data->model) {
            case 'shop':
                (new ShopService())->createShop(json_decode($data->changes));
                break;
            default:
                break;
        }

        //update approval request status
        ApprovalRequest::where('id', $data->id)->update([
            'status' => 'approved'
        ]);
    }

    function reject($model, $data)
    {
    }
}
