<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UserController extends Controller
{
    use LivewireAlert;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tables.user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fortify = new CreateNewUser;

        $fortify->create($request->all());

        $this->flash('success', 'User created successfully!', [
            'position' => 'center',
            'timer' => 1500,
            'toast' => false,
            'timerProgressBar' => '1',
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::select('id', 'name', 'email', 'active', 'created_at', 'updated_at')->findOrFail($id);

        return view('forms.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::select('id', 'name', 'email', 'active', 'created_at', 'updated_at')->findOrFail($id);
        $statuses = User::statuses();

        return view('forms.user.edit', compact('user', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id)->update($request->all());

        $this->flash('success', 'User updated successfully!', [
            'position' => 'center',
            'timer' => 1500,
            'toast' => false,
            'timerProgressBar' => '1',
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (! Gate::allows('delete-user', $user)) abort(403);

        $user->delete();

        $this->flash('success', 'User deleted successfully!', [
            'position' => 'center',
            'timer' => 1500,
            'toast' => false,
            'timerProgressBar' => '1',
        ]);

        return redirect()->route('users.index');
    }

    public function undo($id)
    {
        User::withTrashed()->find($id)->restore();

        return redirect()->route('users.index');
    }
}
