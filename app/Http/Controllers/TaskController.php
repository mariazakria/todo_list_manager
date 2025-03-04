<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // public function index(User $user ,Task $task ){
    //     return $user->id === $task->user_id;        
    // }
    public function index(){
        $tasks = Task::paginate(10);
        return view('welcome', compact('tasks'));
    }    


    public function create(){


        return view('create');
    }    



    public function edit($id){
        $task = Task::findOrFail($id);

        return view('edit', compact('task'));
    }  

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'in:pending,in_progress,completed',
            'priority' => 'in:low,medium,high,urgent',
            'due_date' => 'nullable|date|after_or_equal:today'
        ]);

        $task = Auth::user()->tasks()->create($validated);

        return redirect()->route('todos.index')
            ->with('success', 'Task created successfully');
    }

   
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'in:pending,in_progress,completed',
            'priority' => 'in:low,medium,high,urgent',
            'due_date' => 'nullable|date|after_or_equal:today'
        ]);

        $task->update($validated);

        return redirect()->route('todos.index')
            ->with('success', 'Task updated successfully'); 
   }

   
    public function delete($id)
    {
        $user = Task::find($id);
        $user->delete();
        return redirect()->route('todos.index')
        ->with('success', 'Task deleted successfully.');  
    }

}
