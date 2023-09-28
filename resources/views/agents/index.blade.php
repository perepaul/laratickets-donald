<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agents') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <a href="{{ route('agents.create') }}" class="btn btn-success">Create Ticket</a>
                <div class="max-w-xl">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($agents as $agent)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $agent->name }}</td>
                                <td>{{ $agent->email }}</td>
                                <td>{{ $agent->created_at->toDateTimeString() }}</td>
                                <td>
                                    <a href="{{ route('agents.edit',['agent'=>$agent->id]) }}" class="btn btn-primary">Edit</a>
                                    <a href="#"
                                       onclick="event.preventDefault(); document.getElementById('delete-form').submit();"
                                       class="btn btn-danger">Delete</a>
                                    <form id="delete-form" action="{{ route('agents.destroy', $agent->id) }}"
                                          method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $agents->links() !!}
            </div>
        </div>
    </div>
</x-app-layout>
