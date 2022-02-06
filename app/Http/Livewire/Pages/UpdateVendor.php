<?php

namespace App\Http\Livewire\Pages;
use App\Models\Businessnature;
use App\Models\District;
use App\Models\Market;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Carbon\Carbon;
use App\Traits\Figures;
use Livewire\WithFileUploads;

//Models Used
use App\Models\Marketvendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class UpdateVendor extends Component
{
    use LivewireAlert;
    use Figures;
    use WithFileUploads;

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

    public $vendorPhoto;
    public $vendorCardFront;
    public $vendorCardBack;

    public $vendorPhotoFile;
    public $vendorCardFrontFile;
    public $vendorCardBackFile;

    private $previousURL;

    public $statusInput = 1;
    public $statusUpdate = 2;
    public $formStatus = 1;

    protected $listeners = ['updateVendorInfo'];

    protected $rules = [
        'name' => 'required|min:6'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedVendorPhoto()
    {
        $this->vendorPhotoFile = true;
    }

    public function updatedVendorCardFront()
    {
        $this->vendorCardFrontFile = true;
    }

    public function updatedVendorCardBack()
    {
        $this->vendorCardBackFile = true;
    }

    public function render()
    {
        $this->previousURL = URL::previous();
        return view('livewire.pages.update-vendor');
    }

    
    public function mount($vendorID)
    {
        
        $this->businessNatureCategorys = Businessnature::select('*')->get();
        $this->districts = District::select('*')->get();
        $this->markets = Market::select('*')->where('districtid', 1)->get();

        $this->accountHolderID = $vendorID;
        $accountHolder = Marketvendor::select("*")->where('marketvendorid', $vendorID)
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
        $this->vendorPhoto = $accountHolder->vendorphotopath;
        $this->vendorCardFront = $accountHolder->vendorcardfront;
        $this->vendorCardBack = $accountHolder->vendorcardback;
        

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
        
        $this->flash('success', 'Account Holder Registered' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);

        $this->clearFields();
        return redirect()->route('vendors');
        //$this->emitTo('tables.market-vendors','refreshComponent');
       
    }

    public function updateHolder()
    {
        //dd('Reached');
        //$this->validate();
        $newHolderRecord = Marketvendor::where('marketvendorid', $this->accountHolderID)->first();
        $newHolder = $newHolderRecord->update([
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

        $newHolder = $newHolderRecord->refresh();

        if($this->vendorPhoto && $this->vendorPhotoFile)
        {
            $vendorPhotoFile = 'vendorPhoto' . "$newHolder->marketid" . '.' . $this->vendorPhoto->extension();
            $newHolder->vendorphotopath = $vendorPhotoFile;
            $this->vendorPhoto->storeAs('public', $vendorPhotoFile);
        }
        if($this->vendorCardFront && $this->vendorCardFrontFile)
        {
            $vendorCardFrontFile = 'vendorCardFront' . "$newHolder->marketid" . '.' . $this->vendorCardFront->extension();
            $newHolder->vendorcardfront = $vendorCardFrontFile;
            $this->vendorCardFront->storeAs('public', $vendorCardFrontFile);
        }
        if($this->vendorCardBack && $this->vendorCardBackFile)
        {
            $vendorCardBackFile = 'vendorCardBack' . "$newHolder->marketid". '.' . $this->vendorCardBack->extension();
            $newHolder->vendorcardback = $vendorCardBackFile;
            $this->vendorCardBack->storeAs('public', $vendorCardBackFile);
        }
        
        $newHolder->save();
        
        $this->flash('success', 'Account Holder Updated' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);

        $this->clearFields();
        return redirect()->route('vendors');
       
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
         $this->vendorPhoto = null;
         $this->vendorCardFront = null;
         $this->vendorCardBack = null;
         $this->vendorPhotoFile = null;
         $this->vendorCardFrontFile = null;
         $this->vendorCardBackFile = null;
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
        $this->clearFields();
        $this->dispatchBrowserEvent('goBack');
    }

    public function deleteHolder()
    {
        $holder = Marketvendor::where('marketvendorid', $this->accountHolderID)->delete();
        $this->alert('success', 'Holder Deleted' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);

        $this->clearFields();
        $this->dispatchBrowserEvent('goBack');
        
    }
}
