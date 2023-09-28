<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agents') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div>
                        <form action="{{ route('agents.index') }}" method="get">
                            <input type="text" placeholder="Search" name="search">
                            <input type="submit" value="Search">
                        </form>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <td>#</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Date Created</td>
                            <td>Action</td>
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
