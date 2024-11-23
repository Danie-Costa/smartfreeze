<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class CustomerService
{
    public function createCustomer(array $data)
    {
        $company = GetMayCompany();
        $myRule = GetMyRule();
        if(in_array($myRule, ['admin'])){
            $user = User::create([
                'rule' => 'customer',
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $data['user_id'] = $user->id;
        }
       
        $customer = Customer::create($data);
        
        $customer->companies()->attach($company->id);
        return $customer; 
    }


    public function updateCustomer($id, array $data)
    {

        
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        $user = $customer->user()->first();

        $company = GetMayCompany();
        $user = [
            'rule' => 'customer',
            'name' => $data['name'],
            'email' => $data['email'],
        ];
        if($data['password']){
             $user['password'] = Hash::make($data['password']);
        }

        $data['user_id'] = $user->id;
        
    
        
        
        DB::commit();
        $customer = Customer::findOrFail($id);
        if ($customer) {
            $customer->update($data);
            return $customer;
        }
        return null;
    }

    public function getCustomerById($id)
    {
        return Customer::find($id);
    }

    public function deleteCustomer($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
            return true;
        }
        return false;
    }
}
