<?php

namespace App\Http\Livewire\Pages;

use App\Models\Businessnature;
use App\Models\District;
use App\Models\Market;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Carbon\Carbon;
use App\Traits\Figures;

//Models Used
use App\Models\Marketvendor;
use Illuminate\Support\Facades\Auth;

class NewHolder extends Component
{
    use LivewireAlert;
    use Figures;

    public $accountHolderID;
    public $name;
    public $phoneNumber;
    public $nin;
    public $gender;
    public $businessPlace;
    public $residencePlace;
    public $businessNature;
    public $dailyTurnOver;
    public $businessNatureCategorys;
    public $districts;
    public $district;
    public $markets;
    public $market;

    

    public $statusInput = 1;
    public $statusUpdate = 2;
    public $formStatus = 1;

    protected $listeners = ['updateVendorInfo'];

    public function render()
    {
        return view('livewire.pages.new-holder');
    }

    public function mount()
    {
        $this->businessNatureCategorys = Businessnature::select('*')->get();
        $this->districts = District::select('*')->get();
        $this->markets = Market::select('*')->where('districtid', 1)->get();
        

    }

    public function updatedDistrict()
    {
        $this->markets = Market::select('*')->where('districtid', $this->district)->get();
    }

    public function addHolder()
    {
        //dd('Reached');
        //$this->validate();
        
        $newHolder = Marketvendor::create([
            'name' => $this->name,
            'phonenumber' => $this->phoneNumber,
            'nin' => $this->nin,
            'businessnatureid' => $this->businessNature,
            'residenceplace' => $this->residencePlace,
            'dailyturnover' => $this->dailyTurnOver,
            'gender' => $this->gender,
            'registeredby' => Auth::user()->id,
            'accountnumber' => $this->randNum(15),
            'marketid' => $this->market
        ]);
        
        $this->alert('success', 'Account Holder Registered' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);

        $this->clearFields();
        $this->emitTo('tables.market-vendors','refreshComponent');
       
    }

    public function updateHolder()
    {
        //dd('Reached');
        //$this->validate();
        
        $newHolder = Marketvendor::where('marketvendorid', $this->accountHolderID)
        ->update([
            'name' => $this->name,
            'phonenumber' => $this->phoneNumber,
            'nin' => $this->nin,
            'businessnatureid' => $this->businessNature,
            'residenceplace' => $this->residencePlace,
            'dailyturnover' => $this->dailyTurnOver,
            'gender' => $this->gender,
            'registeredby' => Auth::user()->id,
            'marketid' => $this->market
        ]);
        
        $this->alert('success', 'Account Holder Updated' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);

        $this->clearFields();
        $this->emitTo('tables.market-vendors','refreshComponent');
       
    }

    public function randNum($length)
    {
        $str = mt_rand(1, 9); // first number (0 not allowed)
        for ($i = 1; $i < $length; $i++)
            $str .= mt_rand(0, 9);

        return $str;
    }

    public function clearFields()
    {
         $this->name = null;
         $this->phoneNumber = null;
         $this->nin = null;
         $this->gender = null;
         $this->businessPlace = null;
         $this->residencePlace = null;
         $this->businessNature = null;
         $this->dailyTurnOver = null;
         $this->district = null;
         $this->market = null;
    }

    public function updateVendorInfo($vendorid)
    {
        $this->accountHolderID = $vendorid;
        $accountHolder = Marketvendor::select("*")->where('marketvendorid', $vendorid)
                                        ->leftjoin('markets', 'marketvendors.marketid', 'markets.marketid')
                                        ->leftjoin('districts', 'markets.districtid', 'districts.districtid')
                                        ->first();
        $this->district = $accountHolder->districtid;
        $this->name = $accountHolder->name;
        $this->phoneNumber = $accountHolder->phonenumber;
        $this->nin = $accountHolder->nin;
        $this->gender = (int) $accountHolder->gender;
        $this->businessNature = $accountHolder->businessnatureid;
        $this->residencePlace = $accountHolder->residenceplace;
        $this->dailyTurnOver = $accountHolder->dailyturnover;
        $this->market = $accountHolder->marketid;
    

        $this->formStatus = $this->statusUpdate;
        $this->alert('success', "Form is set ll$accountHolder->gender ll" , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);

    }

    public function cancelUpdate()
    {
        $this->formStatus = $this->statusInput;
        $this->clearFields();
    }

    public function deleteHolder()
    {
        $holder = Marketvendor::where('marketvendorid', $this->accountHolderID)->delete();
        $this->alert('success', 'Holder Deleted' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);
        $this->formStatus = $this->statusInput;
        $this->clearFields();
    }

    
}
