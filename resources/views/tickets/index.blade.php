<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ticket->title }}</td>
                                    <td>{{ $ticket->description }}</td>
                                    <td>{{ $ticket->category->name }}</td>
                                    <td>{{ $ticket->priority->name }}</td>
                                    <td>{{ $ticket->status }}</td>
                                    <td>
                                        <a href="{{ route('tickets.show', $ticket->id) }}"
                                           class="btn btn-primary">View</a>
                                        @if ($ticket->status === 'open' && auth()->user()->isAgent())
                                            <a href="{{ route('tickets.close', $ticket->id) }}"
                                               class="btn btn-danger">Close</a>
                                        @endif

                                        @if (auth()->user()->isAgent())
                                            <a href="#"
                                               onclick="event.preventDefault(); document.getElementById('delete-form').submit();"
                                               class="btn btn-danger">Delete</a>

                                            <form id="delete-form" action="{{ route('tickets.destroy', $ticket->id) }}"
                                                  method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="container">
                        {!! $tickets->links() !!}
                    </div>
                    <a href="{{ route('tickets.create') }}" class="btn btn-success">Create Ticket</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
