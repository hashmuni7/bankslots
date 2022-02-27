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

class AccountHoldersUpdatePage extends Component
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

    public $profilePhotoUpdated = false;
    public $holderCardFrontUpdated = false;
    public $holderCardBackUpdated = false;
    public $accountholder;

    // protected $rules = [
    //     'name' => 'required|min:6',
    //     'dob' => 'date',
    //     'phoneNumber' => "required|unique:accountholders,phonenumber, $this->accountholder",
    //     'nin' => "required|alpha_num|min:14|unique:accountholders,nin, $this->accountholder",
    //     'gender' => 'required',
    //     'placeOfWork' => 'required',
    //     'businessNatureCategory' => 'required',
    //     'residencePlace' => 'required',
    //     'dailyTurnOver' => 'required',
    //     'alreadyBanked' => 'required'
    //     // 'bankName' => ,
    //     // 'accountNumber' => ,
    //     // 'accountType' => ,
    //     // 'nextOfKinName' => ,
    //     // 'nextOfKinContact' => ,
    // ];

    public $theAccountHolder;

    public function render()
    {
        return view('livewire.pages.account-holders-update-page');
    }

    public function mount($accountholderid)
    {
        //$this->districts = District::select('*')->get();
        $this->placesOfWorkCategorys = Placesofworkcategory::select('*')->get();
        $this->placesOfWork = Placesofwork::select('*')->get();
        $this->businessNatureCategorys = Businessnaturecategory::select('*')->get();
        $this->theAccountHolder = Accountholder::selectRaw('accountholderid, accountholders.name, dob, accountholders.phonenumber, nin, gender,
                                    placesofworkid, businessnaturecategoryid, address, dailyturnover, alreadybanked,
                                    bankname, accountnumber, accounttype, nextofkinname, nextofkinphone,
                                    photo, cardfront, cardback')->where('accountholderid', $accountholderid)->first();
        
        $this->name = $this->theAccountHolder->name;
        $this->dob = $this->theAccountHolder->dob->format('Y-m-d');
        $this->phoneNumber = $this->theAccountHolder->phonenumber;
        $this->nin = $this->theAccountHolder->nin;
        $this->gender = $this->theAccountHolder->gender;
        $this->placeOfWork = $this->theAccountHolder->placesofworkid;
        $this->businessNatureCategory = $this->theAccountHolder->businessnaturecategoryid;
        $this->residencePlace = $this->theAccountHolder->address;
        $this->dailyTurnOver = $this->theAccountHolder->dailyturnover;
        $this->alreadyBanked = $this->theAccountHolder->alreadybanked;
        $this->bankName = $this->theAccountHolder->bankname;
        $this->accountNumber = $this->theAccountHolder->accountnumber;
        $this->accountType = $this->theAccountHolder->accounttype;
        $this->nextOfKinName = $this->theAccountHolder->nextofkinname;
        $this->nextOfKinContact = $this->theAccountHolder->nextofkinphone;
        $this->profilePhoto = $this->theAccountHolder->photo;
        $this->holderCardFront = $this->theAccountHolder->cardfront;
        $this->holderCardBack = $this->theAccountHolder->cardback;
        $this->accountholder = $this->theAccountHolder->accountholderid;

       // dd($this->dob);

    }

    public function updated($propertyName)
    {
        //dd($this->accountholder);
        $this->validateOnly($propertyName, 
            [
                'name' => 'required|min:6',
                'dob' => 'date',
                'phoneNumber' => "required|alpha_dash|digits:9|unique:accountholders,phonenumber,$this->accountholder,accountholderid",
                'nin' => "required|alpha_num|alpha_dash|min:14|unique:accountholders,nin,$this->accountholder,accountholderid",
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
            ]
        );
    }

    public function updatedPlaceOfWorkCategory()
    {
        $this->placesOfWork = Placesofwork::select('*')
                                        ->where('placesofworkcategoryid', $this->placeOfWorkCategory)->get();
        $this->businessNatureCategorys = Businessnaturecategory::select('*')
                                        ->where('placesofworkcategoryid', $this->placeOfWorkCategory)->get();
    }

    public function updatedProfilePhoto()
    {
        $this->profilePhotoUpdated = true;
    }

    public function updatedHolderCardFront()
    {
        $this->holderCardFrontUpdated = true;
    }

    public function updatedHolderCardBack()
    {
        $this->holderCardBackUpdated = true;
    }

    public function updateHolder()
    {
        $this->validate(
            ['name' => 'required|min:6'],
            ['dob' => 'date'],
            ['phoneNumber' => "required|unique:accountholders,phonenumber, $this->accountholder"],
            ['nin' => "required|alpha_num|min:14|unique:accountholders,nin, $this->accountholder"],
            ['gender' => 'required'],
            ['placeOfWork' => 'required'],
            ['businessNatureCategory' => 'required'],
            ['residencePlace' => 'required'],
            ['dailyTurnOver' => 'required'],
            ['alreadyBanked' => 'required']
        );
        $newHolderRecord = Accountholder::where('accountholderid', $this->theAccountHolder->accountholderid)->first();
        $newHolder = $newHolderRecord->update([
            'name' => $this->name,
            'dob' => $this->dob,
            'phonenumber' => $this->phoneNumber ,
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
         //   'dateregistered' => Carbon::today(), // No need to update this field

            // '' => $this->profilePhoto,
            // '' => $this->holderCardFront,
            // '' => $this->holderCardBack,
        ]);

        $newHolder = $newHolderRecord->refresh();

        if($this->profilePhotoUpdated)
        {
            
            $image = $this->profilePhoto;
            $pictureName = 'holderPhoto' . $this->theAccountHolder->accountholderid . '.' . $image->getClientOriginalExtension();
            $img = ImageManagerStatic::make($image->getRealPath())->encode('jpg', 65)->fit(760, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img->orientate();
            $img->stream(); // <-- Key point
            Storage::disk('s3')->put('passportphotos' . '/' . $pictureName, $img, 'passportphotos');
            
            $newHolder->photo = $pictureName;
        }

        if($this->holderCardFrontUpdated)
        {
            $image = $this->holderCardFront;
            $pictureName = 'holder' . $this->theAccountHolder->accountholderid . '.' . $image->getClientOriginalExtension();
            $img = ImageManagerStatic::make($image->getRealPath())->encode('jpg', 65)->fit(760, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img->orientate();
            $img->stream(); // <-- Key point
            Storage::disk('s3')->put('idfront' . '/' . $pictureName, $img, 'idfront');
            
            $newHolder->cardfront = $pictureName;
        }

        if($this->holderCardBackUpdated)
        {
            $image = $this->holderCardBack;
            $pictureName = 'holder' . $this->theAccountHolder->accountholderid . '.' . $image->getClientOriginalExtension();
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
        $this->alert('success', 'Record Updated' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);
       //$this->clearFields();
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
