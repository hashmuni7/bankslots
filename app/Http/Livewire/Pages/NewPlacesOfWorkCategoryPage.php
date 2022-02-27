<?php

namespace App\Http\Livewire\Pages;

use App\Models\Placesofworkcategory;
use Livewire\Component;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Carbon\Carbon;
use App\Traits\Figures;

class NewPlacesOfWorkCategoryPage extends Component
{
    use LivewireAlert;
    use Figures;

    public $placeOfWorkCategory;

    public $placeOfWorkCategoryID;
    public $placeCategoryFilled;

    public $statusInput = 1;
    public $statusUpdate = 2;
    public $formStatus = 1;
    public function render()
    {
        return view('livewire.pages.new-places-of-work-category-page');
    }

    public function addPlaceOfWorkCategory()
    {
        //dd('Reached');
        //$this->validate();
        
        $newRecord = Placesofworkcategory::create([
            'placecategory' => $this->placeOfWorkCategory,
        ]);

        $this->placeOfWorkCategoryID = $newRecord->placesofworkcategoryid;
        if($this->placeOfWorkCategoryID) $this->placeCategoryFilled = true;
        //dd($this->placeCategoryFilled);
        $this->alert('success', 'Place of work Registered' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);

        $this->clearFields();
        return redirect()->to("/newbusinessnaturecategorypage/$newRecord->placesofworkcategoryid");
    }

    public function clearFields()
    {
         $this->placeOfWorkCategory = null;
    }
}
