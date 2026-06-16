<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = auth()->user()->business->users()->paginate(10);
        
        return view('users.index', compact('users'));
    }

    
    public function create(): View
    {
        return view('users.create');
    }

    
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:manager,worker',
        ]);

        $validatedData['business_id'] = auth()->user()->business_id;
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'Employee added successfully!');
    }

    
    public function edit(User $user): View
    {
        if ($user->business_id !== auth()->user()->business_id) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('users.edit', compact('user'));
    }

    
    public function update(Request $request, User $user): RedirectResponse
    {
        if ($user->business_id !== auth()->user()->business_id) {
            abort(403, 'Unauthorized action.');
        }
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:manager,worker',
        ];

        if($request->filled('password')){
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $validatedData = $request->validate($rules);

        if ($request->filled('password')) {
        $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'Employee updated successfully!');
    }

    
    public function destroy(User $user): RedirectResponse
    {
        if ($user->business_id !== auth()->user()->business_id) {
            abort(403, 'Unauthorized action.');
        }
        
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'You cannot delete yourself!');
        }
        
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Employee deleted successfully!');
    }
}