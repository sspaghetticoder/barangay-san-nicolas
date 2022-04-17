<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResidentRequest;
use App\Models\Resident;
use Illuminate\Http\Request;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ResidentController extends Controller
{
    use LivewireAlert;

    public array $genders = [];
    public string $houseNumberAlias = '';
    public string $areaAlias = '';

    public function __construct()
    {
        $this->genders = Resident::GENDERS;
        $this->houseNumberAlias = Resident::HOUSE_NUMBER_ALIAS;
        $this->areaAlias = Resident::AREA_ALIAS;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tables.resident');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.resident.create', [
            'genders' => $this->genders, 
            'houseNumberAlias' => $this->houseNumberAlias,
            'areaAlias' => $this->areaAlias,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResidentRequest $request)
    {
        Resident::create($request->all());

        $this->flash('success', 'Resident created successfully!', [
            'position' => 'center',
            'timer' => 1500,
            'toast' => false,
            'timerProgressBar' => '1',
        ]);

        return redirect()->route('residents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resident = Resident::findOrFail($id);

        return view('forms.resident.show', [
            'resident' => $resident,
            'purposes' => config('setting.purposes'),
            'houseNumberAlias' => $this->houseNumberAlias,
            'areaAlias' => $this->areaAlias,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('forms.resident.edit', [
            'resident' => Resident::findOrFail($id),
            'genders' => $this->genders, 
            'houseNumberAlias' => $this->houseNumberAlias,
            'areaAlias' => $this->areaAlias,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Resident::find($id)->update($request->all());
        
        $this->flash('success', 'Resident updated successfully!', [
            'position' => 'center',
            'timer' => 1500,
            'toast' => false,
            'timerProgressBar' => '1',
        ]);

        return redirect()->route('residents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Resident::where('full_id', $id)->first()->delete();
        Resident::find($id)->delete();

        $this->flash('success', 'Resident deleted successfully!', [
            'position' => 'center',
            'timer' => 1500,
            'toast' => false,
            'timerProgressBar' => '1',
        ]);

        return redirect()->route('residents.index');
    }

    public function undo($id)
    {
        Resident::withTrashed()->find($id)->restore();

        return redirect()->route('residents.index');
    }
}
