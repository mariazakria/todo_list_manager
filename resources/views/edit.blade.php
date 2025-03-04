@extends('components.app')

@section('content')
<div class=" flex items-center justify-center ">
    <div class="w-full max-w-2xl">
        <div class="bg-white shadow-2xl rounded-xl overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
                <h2 class="text-center text-3xl font-extrabold text-white">
                    Edit Your Task
                </h2>
            </div>
            
            <form method="POST" action="{{ route('todos.update', $task) }}" class="p-8 space-y-6">
                @csrf
                @method('PUT')
                <!-- Title Input -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">
                        Task Title <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1">
                        <input 
                            id="title" 
                            name="title" 
                            type="text" 
                            required 
                            autofocus
                            value="{{ old('title', $task->title) }}" 
                        class="appearance-none block w-full px-3 py-2 border  rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                            @error('title') border-red-500 @enderror"
                            placeholder="Enter task title"
                        >{{ old('title') }}

                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description Input -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">
                        Description
                    </label>
                    <div class="mt-1">
                        <textarea 
                        id="description" 
                        name="description" 
                        rows="4"
                        class="block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                        @error('description') border-red-500 @enderror"
                        placeholder="Add more details about your task"
                    >{{ old('description', $task->description) }}</textarea>
                    
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Status and Priority Row -->
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Status Dropdown -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">
                            Status
                        </label>
                        <select 
                        id="status" 
                        name="status" 
                        class="mt-1 block w-full pl-3 pr-10 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                        <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    
                    </div>

                    <!-- Priority Dropdown -->
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700">
                            Priority
                        </label>
                        <select 
                        id="priority" 
                        name="priority" 
                        class="mt-1 block w-full pl-3 pr-10 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                        <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>High</option>
                        <option value="urgent" {{ old('priority', $task->priority) == 'urgent' ? 'selected' : '' }}>Urgent</option>
                    </select>
                    
                    </div>
                </div>

                <!-- Due Date Input -->
                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700">
                        Due Date
                    </label>
                    <div class="mt-1">
                        <input 
                            id="due_date" 
                            name="due_date" 
                            type="date" 
                            value="{{ old('due_date', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}"
                            class="block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        >
                        @error('due_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="flex justify-between items-center">
                    <a href="{{ route('todos.index') }}" class="text-gray-600 hover:text-gray-800 transition">
                        Cancel
                    </a>
                    <button 
                        type="submit" 
                        class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Optional: Add client-side validation or date restrictions
    document.addEventListener('DOMContentLoaded', () => {
        const dueDateInput = document.getElementById('due_date');
        
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        dueDateInput.setAttribute('min', today);
    });
</script>
@endsection