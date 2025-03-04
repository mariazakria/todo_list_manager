@extends('components.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
            <h1 class="text-3xl font-bold text-white text-center">
                Your Todo Dashboard
            </h1>
        </div>

        <div class="p-6">
            @if($tasks->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    <p class="mt-4 text-xl text-gray-500">No tasks yet. Let's get started!</p>
                    <a href="{{ route('todos.create') }}" class="mt-6 inline-block bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition">
                        Create Your First Task
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Your Tasks</h2>
                        <a href="{{ route('todos.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                            + Add New Task
                        </a>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($tasks as $todo)
                            <div class="bg-white border rounded-lg shadow-md hover:shadow-lg transition-shadow">
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <h3 class="text-xl font-bold text-gray-800">{{ $todo->title }}</h3>
                                        
                                        <!-- Status Badge -->
                                        <span class="
                                            px-3 py-1 rounded-full text-xs font-medium 
                                            {{ $todo->status == 'completed' ? 'bg-green-100 text-green-800' : 
                                               ($todo->status == 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}
                                        ">
                                            {{ ucfirst($todo->status) }}
                                        </span>
                                    </div>

                                    @if($todo->description)
                                        <p class="text-gray-600 mb-4 line-clamp-3">
                                            {{ $todo->description }}
                                        </p>
                                    @endif

                                    <div class="flex justify-between items-center">
                                        @if($todo->due_date)
                                            <div class="text-sm text-gray-500">
                                                <svg class="inline-block w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ \Carbon\Carbon::parse($todo->due_date)->format('M d, Y') }}
                                            </div>
                                        @endif

                                        <div class="flex space-x-2">
                                            <a href="{{ route('todos.edit', $todo) }}" class="text-indigo-600 hover:text-indigo-900">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $tasks->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Task Statistics -->
    <div class="mt-8 grid md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Task Overview</h3>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Tasks</span>
                    <span class="font-bold">{{ $tasks->total() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Completed</span>
                    <span class="font-bold text-green-600">{{ $tasks->where('status', 'completed')->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">In Progress</span>
                    <span class="font-bold text-yellow-600">{{ $tasks->where('status', 'in_progress')->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Pending</span>
                    <span class="font-bold text-gray-600">{{ $tasks->where('status', 'pending')->count() }}</span>
                </div>
            </div>
        </div>
        <!-- Upcoming Tasks -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Upcoming Tasks</h3>
            @php
                $upcomingTasks = $tasks->where('status', '!=', 'completed')->sortBy('due_date')->take(3)
            @endphp
            {{-- hygeb elly mt3mlsh msh complete   --}}
            @forelse($upcomingTasks as $task)
                <div class="border-b last:border-b-0 py-2">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">{{ $task->title }}</span>
                        <span class="text-sm text-gray-500">
                            {{-- diffForHumans() hna hy7ot elfr2 ben el date  --}}
                            {{ \Carbon\Carbon::parse($task->due_date)->diffForHumans() }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center">No upcoming tasks</p>
            @endforelse
        </div>
    </div>
</div>
@endsection