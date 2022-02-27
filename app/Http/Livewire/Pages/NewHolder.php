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
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

//Models Used
use App\Models\Marketvendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class NewHolder extends Component
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

    

    public $statusInput = 1;
    public $statusUpdate = 2;
    public $formStatus = 1;

    protected $listeners = ['updateVendorInfo'];

    protected $rules = [
        'name' => 'required|min:6',
        'phoneNumber' => 'required|digits:9',
        'vendorPhoto' => 'image',
        'nin' => 'required|min:14|max:14',
        'gender' => 'required',
        'businessPlace' => 'required',
        'residencePlace' => 'required',
        'businessNature' => 'required',
        'dailyTurnOver' => 'required|numeric',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

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
        $this->alert('success', 'Saving Vendor ...' , [
            'position' => 'center',
            'timer' => 6000,
            'toast' => false,
            'timerProgressBar' => true,  
        ]);
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
        
        

        
        if($this->vendorPhoto)
        {
            $image = $this->vendorPhoto;
            $avatarName = 'vendorPhoto' . "$newHolder->marketid" . '.' . $image->getClientOriginalExtension();
            $img = ImageManagerStatic::make($image->getRealPath())->encode('jpg', 65)->fit(760, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img->orientate();
            $img->stream(); // <-- Key point
            Storage::disk('s3')->put('passportphotos' . '/' . $avatarName, $img, 'passportphotos');
            $newHolder->vendorphotopath = $avatarName;
            // $vendorPhotoFile = 'vendorPhoto' . "$newHolder->marketid" . '.' . $this->vendorPhoto->extension();
            // $newHolder->vendorphotopath = $vendorPhotoFile;
            // $vendorSavedImage = ImageManagerStatic::make($this->vendorPhoto)->encode('png');
            $this->alert('success', 'Saving Vendor ...' , [
                'position' =>  'top-end', 
                'timer' =>  3000,  
                'toast' =>  true,  
            ]);
            // Storage::disk('s3')->put($vendorPhotoFile, $vendorSavedImage);
            //$this->vendorPhoto->storeAs('public', $vendorPhotoFile);
        }
        if($this->vendorCardFront)
        {
            $vendorCardFrontFile = 'vendorCardFront' . "$newHolder->marketvendorid" . '.' . $this->vendorCardFront->extension();
            $newHolder->vendorcardfront = $vendorCardFrontFile;
            $vendorSavedImage2 = ImageManagerStatic::make($this->vendorCardFront)->encode('png');
            $this->alert('success', 'Saving Vendor ID Front...' , [
                'position' =>  'top-end', 
                'timer' =>  3000,  
                'toast' =>  true,  
            ]);
            Storage::disk('public')->put($vendorCardFrontFile, $vendorSavedImage2);
            //$this->vendorCardFront->storeAs('public', $vendorCardFrontFile);
        }
        if($this->vendorCardBack)
        {
            $vendorCardBackFile = 'vendorCardBack' . "$newHolder->marketvendorid". '.' . $this->vendorCardBack->extension();
            $newHolder->vendorcardback = $vendorCardBackFile;
            $vendorSavedImage3 = ImageManagerStatic::make($this->vendorCardBack)->encode('png');
            $this->alert('success', 'Saving Vendor ID Back...' , [
                'position' =>  'top-end', 
                'timer' =>  3000,  
                'toast' =>  true,  
            ]);
            Storage::disk('public')->put($vendorCardBackFile, $vendorSavedImage3);
            //$this->vendorCardBack->storeAs('public', $vendorCardBackFile);
        }
        
        $newHolder->save();
        $welcomeMessage = "Sales Manager App \n";
        $welcomeMessage .= "Hello $newHolder->name! You have been registered with Sales Manager to get a bank account.";
        $this->sendWelcomeSMS($newHolder->phonenumber, $welcomeMessage);
        $this->flash('success', 'Account Holder Registered' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);
        
        


         $this->clearFields();
         return redirect()->route('vendors');
        //$this->emitTo('tables.market-vendors','refreshComponent');
       
    }

    public function saveAndNew()
    {
        //dd('Reached');
        $this->validate();
        
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

        if($this->vendorPhoto)
        {
            $vendorPhotoFile = 'vendorPhoto' . "$newHolder->marketvendorid" . '.' . $this->vendorPhoto->extension();
            $newHolder->vendorphotopath = $vendorPhotoFile;
            $this->vendorPhoto->storeAs('public', $vendorPhotoFile);
        }
        if($this->vendorCardFront)
        {
            $vendorCardFrontFile = 'vendorCardFront' . "$newHolder->marketid" . '.' . $this->vendorCardFront->extension();
            $newHolder->vendorcardfront = $vendorCardFrontFile;
            $this->vendorCardFront->storeAs('public', $vendorCardFrontFile);
        }
        if($this->vendorCardBack)
        {
            $vendorCardBackFile = 'vendorCardBack' . "$newHolder->marketid". '.' . $this->vendorCardBack->extension();
            $newHolder->vendorcardback = $vendorCardBackFile;
            $this->vendorCardBack->storeAs('public', $vendorCardBackFile);
        }
        
        $newHolder->save();
        
        $this->alert('success', 'Account Holder Registered' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);

        $this->clearFields();
        //return redirect()->route('vendors');
        //$this->emitTo('tables.market-vendors','refreshComponent');
       
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

    public function sendWelcomeSMS($phoneNumber, $Message)
    {
        $response = Http::post('http://www.egosms.co/api/v1/json/', [
            'method' => 'SendSms',
            'userdata' => array(
                'username' => 'hash',
                'password' => 'RDP4isgJnUefcSp'
            ),
            'msgdata' => array(
                array(
                    'number' => '256' . $phoneNumber,
                    'message' => $Message,
                    'senderid' => 'Egosms'
                )
            )
        ]);
    }

    
}
