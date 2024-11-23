<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Promotion;
use App\Models\CustomerCompany;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class CompanyService
{
    public function isMyCustomerCompany($customerCompanyID){
        $customerCompany = new CustomerCompany();
        if($customerCompany->where('company_id',GetMayCompanyId() )->find($customerCompanyID)){
            return true;
        }
        return false;
    }
    public function isMyPromotion($promotionID){
        $promotion = new Promotion();
        if($promotion->where('company_id',GetMayCompanyId() )->find($promotionID)){
            return true;
        }
        return false;
    }
    public function isMyCard($promotionID,$customerCompanyID){
        if($this->isMyCustomerCompany($customerCompanyID) && $this->isMyPromotion($promotionID)){
            return true;
        }
        return false;
    }
    public function promotionScore($promotionID){
        $promotionModel = new Promotion();
        $pomotion = $promotionModel->where('company_id',GetMayCompanyId() )->find($promotionID);
        if($pomotion){
            return $pomotion->score;
        }
    }
}
