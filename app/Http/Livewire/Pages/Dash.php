<?php

namespace App\Http\Livewire\Pages;

use App\Models\Accountholder;
use App\Models\Bank;
use App\Models\District;
use App\Models\Marketvendor;
use App\Models\Placesofwork;
use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use App\Traits\Figures;
use Illuminate\Support\Facades\DB;

class Dash extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    use Figures;
    public $accountHolders;
    public $users;
    public $districts;
    public $banks;
    public $turnOver;
    public $placesOfWork;
    public $districtProspectivePopulation;
    public $populationOfMarkets;
    public $bestMarkets;

    public $testImage;
    public $testString = "Look at you";
    public function render()
    {
        return view('livewire.pages.dash');
    }

    public function mount()
    {
        $this->accountHolders = Accountholder::where('placesofworkcategoryid', 1)
                                            ->leftjoin('placesofwork', 'accountholders.placesofworkid', 'placesofwork.placesofworkid')
                                            ->count();
        $this->users = User::all()->count();
        $this->districts = District::all()->count();
        $this->banks = Bank::all()->count();
        $this->turnOver = Accountholder::where('placesofworkcategoryid', 1)
                                        ->leftjoin('placesofwork', 'accountholders.placesofworkid', 'placesofwork.placesofworkid')
                                        ->sum('dailyturnover');
        if($this->turnOver) $this->turnOver = $this->readableThousands($this->turnOver);
        $this->placesOfWork = Placesofwork::where('placesofworkcategoryid', 1)->count();

        $this->districtProspectivePopulation = District::select('*')->get();
        $this->populationOfMarkets = Placesofwork::select('prospectivepopulation')
                                    ->where('placesofwork.placesofworkcategoryid', 1) // 1 is the ID for markets
                                    //->leftjoin('placesofwork', 'accountholders.placesofworkid', 'placesofwork.placesofworkid')
                                    ->sum('prospectivepopulation');
        if($this->populationOfMarkets) $this->populationOfMarkets = $this->readableThousands($this->populationOfMarkets);

        // $bestMarkets = DB::table('results')->selectRaw("SELECT placesofworkid, placeofwork, count(accountholderid) as vendors, prospectivepopulation, ((count(accountholderid) DIV prospectivepopulation) * 100) as percentage
        //                                     FROM (SELECT accountholderid, name, accountholders.placesofworkid, placesofwork.placeofwork, placesofwork.placesofworkcategoryid, placesofwork.prospectivepopulation
        //                                     FROM accountholders
        //                                     LEFT JOIN placesofwork ON accountholders.placesofworkid = placesofwork.placesofworkid
        //                                     WHERE placesofworkcategoryid = 1) as results
        //                                     GROUP BY placesofworkcategoryid")->get();
        // dd($bestMarkets);

    }

    public function showMe()
    {
        $this->alert('success', 'Seems You are making it wor ...' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);
    }

    public function saveImage()
    {
        //dd($this->testImage);
        if($this->testImage)
        {
            //$image = $this->testImage;
            //$avatarName = "goodName10" . '.' . $image->getClientOriginalExtension();
            //$img = ImageManagerStatic::make($image->getRealPath())->encode('jpg', 65)->fit(760, null, function ($c) {
            //    $c->aspectRatio();
            //    $c->upsize();
            //});
           // $img->orientate();
           // $img->stream(); // <-- Key point
            //Storage::disk('s3')->put('photos' . '/' . $avatarName, $img, 'photos');
            $image = $this->testImage;
            $avatarName = "goodName136" . '.' . $image->getClientOriginalExtension();
            // $img = ImageManagerStatic::make($image->getRealPath())->encode('jpg', 65)->fit(760, null, function ($c) {
            //     $c->aspectRatio();
            //     $c->upsize();
            // });
            // $img->orientate();
            // $img->stream(); // <-- Key point
            $this->testImage->store('photos', 's3');
            //Storage::disk('s3')->put($avatarName, $this->testImage);
     
           
        }
        //$path = Storage::disk('s3')->put('photos', $this->testImage);
        //dd($path);
        //$this->testImage->store('photos', 's3');
        $this->alert('success', 'Saving Image ...' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);
    }


}
