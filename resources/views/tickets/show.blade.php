<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="container">
                            <h1>{{ $ticket->title }}</h1>
                            <p><strong>By:</strong> {{ $ticket->user->name }}</p>
                            <p><strong>Date raise:</strong> {{ $ticket->created_at->format('d-m-Y') }}</p>

                            <p><strong>Description:</strong></p>
                            <p>{{ $ticket->description }}</p>

                            <p><strong>Category:</strong> {{ $ticket->category->name }}</p>
                            <p><strong>Priority:</strong> {{ $ticket->priority->name }}</p>
                            <p><strong>Status:</strong> {{ $ticket->status }}</p>
                        </div>
                        <div class="container">
                            <h2>Responses</h2>
                            @if($ticketReplies->count()>0)
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Response</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($ticketReplies as $response)
                                        <tr>
                                            <td>{{ $response->user->name }}</td>
                                            <td>{{ $response->reply }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="container">
                                    {!! $ticketReplies->links() !!}
                                </div>
                            @else
                                <h3>No responses yet!</h3>
                            @endif
                        </div>
                        <div class="container">
                            <h2>Respond</h2>
                            <!-- Your reply form goes here -->
                            <form method="post" action="{{ route('tickets.reply', $ticket->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="reply">Reply:</label>
                                    <textarea class="form-control" id="reply" name="reply" rows="5"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success">Reply</button>
                            </form>
                        </div>
                        <div class="container mt-4">
                            <a href="{{ route('tickets.index') }}" class="btn btn-primary">Back to Tickets</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
