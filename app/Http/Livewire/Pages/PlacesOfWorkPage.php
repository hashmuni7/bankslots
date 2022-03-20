<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\District;
use App\Models\Placesofwork;
use App\Models\Placesofworkcategory;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Carbon\Carbon;
use App\Traits\Figures;

class PlacesOfWorkPage extends Component
{
    use LivewireAlert;
    use Figures;

    public $placeOfWorkID;
    public $placeOfWork;
    public $district;
    public $districts;
    public $placeOfWorkCategory;
    public $placesOfWorkCategorys;
    public $prospectivePopulation;
    public $contactName;
    public $contactPhone;

    public $statusInput = 1;
    public $statusUpdate = 2;
    public $formStatus = 1;

    protected $listeners = ['updatePlaceOfWorkInfo'];

    public function render()
    {
        return view('livewire.pages.places-of-work-page');
    }

    public function mount()
    {
        $this->districts = District::select('*')->get();
        $this->placesOfWorkCategorys = Placesofworkcategory::select('*')->get();

    }

    public function addWorkStation()
    {
       // dd($this->placeOfWorkCategory);
        $newPlaceOfWork = Placesofwork::create([
            'placeofwork' => $this->placeOfWork,
            'districtid' => $this->district,
            'prospectivepopulation' => $this->prospectivePopulation,
            'contactname' => $this->contactName,
            'contactphone' => $this->contactPhone,
            'placesofworkcategoryid' => 1
        ]);
        
        $this->alert('success', 'Station Registered' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);

        $this->clearFields();
        $this->emitTo('tables.places-of-work-stations-table','refreshComponent');
       
    }

    public function clearFields()
    {
        
        $this->placeOfWork = null;
        $this->district = null;
        $this->placeOfWorkCategory = null;
        $this->prospectivePopulation = null;
        $this->contactName = null;
        $this->contactPhone = null;
    }

    public function cancelUpdate()
    {
        $this->formStatus = $this->statusInput;
        $this->clearFields();
    }

    public function updatePlaceOfWorkInfo($placesofworkid)
    {
        $this->placeOfWorkID = $placesofworkid;
        $place = Placesofwork::select("*")->where('placesofworkid', $this->placeOfWorkID)
                                        ->first();
        $this->placeOfWork = $place->placeofwork;
        $this->district = $place->districtid;
        $this->placeOfWorkCategory = $place->placesofworkcategoryid;
        $this->prospectivePopulation = $place->prospectivepopulation;
        $this->contactName =$place->contactname;
        $this->contactPhone = $place->contactphone;
    

        $this->formStatus = $this->statusUpdate;
        $this->alert('success', "Form is Ready For Update" , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);
    }

    public function updateWorkStation()
    {
       // dd($this->placeOfWorkCategory);
        $newPlaceOfWork = Placesofwork::where('placesofworkid', $this->placeOfWorkID)
                                        ->update([
            'placeofwork' => $this->placeOfWork,
            'districtid' => $this->district,
            'prospectivepopulation' => $this->prospectivePopulation,
            'contactname' => $this->contactName,
            'contactphone' => $this->contactPhone,
            'placesofworkcategoryid' => $this->placeOfWorkCategory
        ]);
        
        $this->alert('success', 'Station Registered' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);

        $this->clearFields();
        $this->emitTo('tables.places-of-work-stations-table','refreshComponent');
       
    }

    public function deleteRecord()
    {
        $record =  Placesofwork::where('placesofworkid', $this->placeOfWorkID)->delete();
        $this->alert('success', 'Work Station Deleted' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);
        $this->formStatus = $this->statusInput;
        $this->clearFields();
        $this->emitTo('tables.places-of-work-stations-table','refreshComponent');
    }
}
