<?php

namespace App\Http\Livewire\Pages;

use App\Models\District;
use App\Models\Market;
use Livewire\Component;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Carbon\Carbon;
use App\Traits\Figures;

class Markets extends Component
{
    use LivewireAlert;
    use Figures;

    public $marketid;
    public $marketName;
    public $district;
    public $districts;
    public $vendorPopulation;
    public $contactName;
    public $contactPhone;

    public $statusInput = 1;
    public $statusUpdate = 2;
    public $formStatus = 1;

    protected $listeners = ['updateMarketInfo'];

    public function render()
    {
        return view('livewire.pages.markets');
    }

    public function mount()
    {
        $this->districts = District::select('*')->get();
    }

    public function addMarket()
    {
        //dd('Reached');
        //$this->validate();
        
        $newMarket = Market::create([
            'marketname' => $this->marketName,
            'districtid' => $this->district,
            'vendorpopulation' => $this->vendorPopulation,
            'contactname' => $this->contactName,
            'contactphone' => $this->contactPhone,
        ]);
        
        $this->alert('success', 'Market Registered' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);

        $this->clearFields();
        $this->emitTo('tables.markets-table','refreshComponent');
       
    }

    public function updateMarket()
    {
        //dd('Reached');
        //$this->validate();
        
        $newHolder = Market::where('marketid', $this->marketid)
        ->update([
            'marketname' => $this->marketName,
            'districtid' => $this->district,
            'vendorpopulation' => $this->vendorPopulation,
            'contactname' => $this->contactName,
            'contactphone' => $this->contactPhone,
        ]);
        
        $this->alert('success', 'Market Updated' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);

        $this->clearFields();
        $this->emitTo('tables.market-table','refreshComponent');
       
    }

    public function updateMarketInfo($marketid)
    {
        $this->marketid = $marketid;
        $market = Market::select("*")->where('marketid', $marketid)
                                        ->first();
        $this->marketName = $market->marketname;
        $this->district = $market->districtid;
        $this->vendorPopulation = $market->vendorpopulation;
        $this->contactName = $market->contactname;
        $this->contactPhone = $market->contactphone;
    

        $this->formStatus = $this->statusUpdate;
        $this->alert('success', "Form is Ready For Update" , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);

    }

    public function clearFields()
    {
        $this->marketid = null;
        $this->marketName = null;
        $this->district = null;
        $this->vendorPopulation = null;
        $this->contactName = null;
        $this->contactPhone = null;
    }

    public function cancelUpdate()
    {
        $this->formStatus = $this->statusInput;
        $this->clearFields();
    }

    public function deleteMarket()
    {
        $market = Market::where('marketid', $this->marketid)->delete();
        $this->alert('success', 'Market Deleted' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);
        $this->formStatus = $this->statusInput;
        $this->clearFields();
    }
}
