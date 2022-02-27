<?php

namespace App\Http\Livewire\Pages;

use App\Models\Accountholder;
use App\Models\Businessnaturecategory;
use App\Models\Placesofwork;
use App\Models\Placesofworkcategory;
use Livewire\Component;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Carbon\Carbon;
use App\Traits\Figures;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Facades\Http;

class AccountHoldersDetailPage extends Component
{
    use LivewireAlert;
    use Figures;
    use WithFileUploads;

    public $statusInput = 1;
    public $statusUpdate = 2;
    public $formStatus = 1;

    public $name;
    public $dob;
    public $phoneNumber;
    public $nin;
    public $gender;
    public $placeOfWorkCategory;
    public $placesOfWorkCategorys;
    public $placeOfWork;
    public $placesOfWork;
    public $businessNatureCategory;
    public $businessNatureCategorys;
    public $dailyTurnOver;
    public $residencePlace;
    public $alreadyBanked;
    public $bankName;
    public $accountNumber;
    public $accountType;
    public $nextOfKinName;
    public $nextOfKinContact;

    public $vendorPhoto;
    public $vendorCardFront;
    public $vendorCardBack;

    public $profilePhoto;
    public $holderCardFront;
    public $holderCardBack;

    protected $rules = [
        'name' => 'required|min:6',
        'dob' => 'date',
        'phoneNumber' => 'required|alpha_dash|digits:9|unique:accountholders,phonenumber',
        'nin' => 'required|alpha_num|alpha_dash|min:14|unique:accountholders,nin',
        'gender' => 'required',
        'placeOfWork' => 'required',
        'businessNatureCategory' => 'required',
        'residencePlace' => 'required',
        'dailyTurnOver' => 'required',
        'alreadyBanked' => 'required'
        // 'bankName' => ,
        // 'accountNumber' => ,
        // 'accountType' => ,
        // 'nextOfKinName' => ,
        // 'nextOfKinContact' => ,
    ];

    public function render()
    {
        return view('livewire.pages.account-holders-detail-page');
    }

    public function mount()
    {
        //$this->districts = District::select('*')->get();
        $this->placesOfWorkCategorys = Placesofworkcategory::select('*')->get();
        $this->placesOfWork = Placesofwork::select('*')->get();
        $this->businessNatureCategorys = Businessnaturecategory::select('*')->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedPlaceOfWorkCategory()
    {
        $this->placesOfWork = Placesofwork::select('*')
                                        ->where('placesofworkcategoryid', $this->placeOfWorkCategory)->get();
        $this->businessNatureCategorys = Businessnaturecategory::select('*')
                                        ->where('placesofworkcategoryid', $this->placeOfWorkCategory)->get();
    }

    public function addHolder()
    {
        $this->validate();

        $newHolder = Accountholder::create([
            'name' => $this->name,
            'dob' => $this->dob,
            'phonenumber' => $this->phoneNumber,
            'nin' => $this->nin,
            'gender' => $this->gender,
            'placesofworkid' => $this->placeOfWork,
            'businessnaturecategoryid' => $this->businessNatureCategory,
            'address' => $this->residencePlace,
            'dailyturnover' => $this->dailyTurnOver,
            'alreadybanked' => $this->alreadyBanked,
            'bankname' => $this->bankName,
            'accountnumber' => $this->accountNumber,
            'accounttype' => $this->accountType,
            'nextofkinname' => $this->nextOfKinName,
            'nextofkinphone' => $this->nextOfKinContact,
            'accountholderlevelid' => 1,
            'registeredby' => Auth::user()->id,
            'dateregistered' => Carbon::today(),

            // '' => $this->profilePhoto,
            // '' => $this->holderCardFront,
            // '' => $this->holderCardBack,
        ]);

        if($this->profilePhoto)
        {
            $image = $this->profilePhoto;
            $pictureName = 'holderPhoto' . "$newHolder->accountholderid" . '.' . $image->getClientOriginalExtension();
            $img = ImageManagerStatic::make($image->getRealPath())->encode('jpg', 65)->fit(760, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img->orientate();
            $img->stream(); // <-- Key point
            Storage::disk('s3')->put('passportphotos' . '/' . $pictureName, $img, 'passportphotos');
            
            $newHolder->photo = $pictureName;
        }

        if($this->holderCardFront)
        {
            $image = $this->holderCardFront;
            $pictureName = 'holder' . "$newHolder->accountholderid" . '.' . $image->getClientOriginalExtension();
            $img = ImageManagerStatic::make($image->getRealPath())->encode('jpg', 65)->fit(760, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img->orientate();
            $img->stream(); // <-- Key point
            Storage::disk('s3')->put('idfront' . '/' . $pictureName, $img, 'idfront');
            
            $newHolder->cardfront = $pictureName;
        }

        if($this->holderCardBack)
        {
            $image = $this->holderCardBack;
            $pictureName = 'holder' . "$newHolder->accountholderid" . '.' . $image->getClientOriginalExtension();
            $img = ImageManagerStatic::make($image->getRealPath())->encode('jpg', 65)->fit(760, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img->orientate();
            $img->stream(); // <-- Key point
            Storage::disk('s3')->put('idback' . '/' . $pictureName, $img, 'idback');
            
            $newHolder->cardback = $pictureName;
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
         return redirect()->route('accountholderlistpage');
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

    public function saveAndNew()
    {
        $this->alert('success', 'Am there too' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);
    }

    public function clearFields()
    {
        $this->name = null;
        $this->dob = null;
        $this->phoneNumber = null;
        $this->nin = null;
        $this->gender = null;
        $this->placeOfWork = null;
        $this->businessNatureCategory = null;
        $this->residencePlace = null;
        $this->dailyTurnOver = null;
        $this->alreadyBanked = null;
        $this->bankName = null;
        $this->accountNumber = null;
        $this->accountType = null;
        $this->nextOfKinName = null;
        $this->nextOfKinContact = null;
    }
}
