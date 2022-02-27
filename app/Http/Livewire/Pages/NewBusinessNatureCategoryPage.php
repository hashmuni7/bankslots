<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

use App\Models\BusinessNatureCategory;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Carbon\Carbon;
use App\Traits\Figures;

class NewBusinessNatureCategoryPage extends Component
{
    use LivewireAlert;
    use Figures;

    public $businessNatureCategoryID;
    public $businessNatureCategory;
    public $businessNatureCategoryDescription;
    public $placeOfWorkCategoryID;

    public $testFilled;

    public $statusInput = 1;
    public $statusUpdate = 2;
    public $formStatus = 1;

    protected $listeners = ['updateBusinessCategoryInfo'];

    public function render()
    {
        return view('livewire.pages.new-business-nature-category-page');
    }

    public function mount($placeOfWorkCategoryID)
    {   
       
            $this->placeOfWorkCategoryID = $placeOfWorkCategoryID;
      
        
    }

    public function addBusinessNatureCategory()
    {
        //dd($this->testFilled);
        //$this->validate();
        
        $newRecord = BusinessNatureCategory::create([
            'placesofworkcategoryid' => $this->placeOfWorkCategoryID,
            'category' => $this->businessNatureCategory,
            'description' => $this->businessNatureCategoryDescription
        ]);

        
        
        $this->alert('success', 'Business Nature Category Added' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);

        $this->clearFields();
        $this->emitTo('tables.places-of-work-business-category-table','refreshComponent');
        
    }

    public function updateBusinessNatureCategory()
    {
        
        $newRecord = BusinessNatureCategory::where('businessnaturecategoryid', $this->businessNatureCategoryID)
                                            ->update([
                                        //   'placesofworkcategoryid' => $this->placeOfWorkCategoryID,
                                            'category' => $this->businessNatureCategory,
                                            'description' => $this->businessNatureCategoryDescription
                                        ]);

        
        
        $this->alert('success', 'Business Nature Category Updated' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);

        $this->clearFields();
        $this->formStatus = $this->statusUpdate;
        $this->emitTo('tables.places-of-work-business-category-table','refreshComponent');
        
    }

    public function clearFields()
    {
         $this->businessNatureCategory = null;
         $this->businessNatureCategoryDescription = null;
    }

    public function updateBusinessCategoryInfo($businessnaturecategoryid)
    {
        $this->businessNatureCategoryID = $businessnaturecategoryid;
        $category = BusinessNatureCategory::select("*")->where('businessnaturecategoryid', $businessnaturecategoryid)
                                        ->first();

                                        
        $this->businessNatureCategory = $category->category;
        $this->businessNatureCategoryDescription = $category->description;
    

        $this->formStatus = $this->statusUpdate;
        $this->alert('success', "Form is Ready For Update" , [
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

    public function deleteRecord()
    {
        $category = BusinessNatureCategory::where('businessnaturecategoryid', $this->businessNatureCategoryID)->delete();
        $this->alert('success', 'Category Deleted' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);
        $this->formStatus = $this->statusInput;
        $this->clearFields();
        $this->emitTo('tables.places-of-work-business-category-table','refreshComponent');
    }
}
