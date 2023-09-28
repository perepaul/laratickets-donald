<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Priority;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index(Request $request)
    {
        $query = Ticket::query();
        if ($request->user()->isAgent()) {
            $tickets = $query->whereHas('replies', function ($query) use ($request) {
                return $query->where('user_id', $request->user()->id);
            })
                ->orWhereDoesntHave('replies');
        } elseif ($request->user()->isUser()) {
            $tickets = $query->where('user_id', $request->user()->id);
        } else {
            $tickets = $query;
        }
        $tickets = $tickets->orderBy('created_at', 'desc')->paginate(20);

        return view('tickets.index', compact('tickets'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function create()
    {
        $categories = Category::get();
        $priorities = Priority::get();

        return view('tickets.create', compact('categories', 'priorities'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'priority_id' => 'required|exists:priorities,id',
        ]);

        $ticket = Ticket::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'user_id' => auth()->user()->id,
            'category_id' => $validatedData['category_id'],
            'priority_id' => $validatedData['priority_id'],
        ]);

        return redirect()->route('tickets.index');
    }

    /**
     * @param Ticket $ticket
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function show(Ticket $ticket)
    {
        $ticketReplies = $ticket->replies;
        if ($ticketReplies) {
            $ticketReplies = $ticket->replies()->paginate(10);
        }
        return view('tickets.show', compact('ticket', 'ticketReplies'));
    }

    /**
     * @param Ticket $ticket
     * @return RedirectResponse
     */
    public function close(Ticket $ticket)
    {
        $ticket->status = 'closed';
        $ticket->save();

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param Ticket $ticket
     * @return Application|Factory|\Illuminate\Contracts\Foundation\Application|View
     */
    public function reply(Request $request, Ticket $ticket)
    {
        $validatedData = $request->validate([
            'reply' => 'required',
        ]);

        TicketReply::create([
            'reply' => $validatedData['reply'],
            'user_id' => auth()->user()->id,
            'ticket_id' => $ticket->id,

        ]);
        return $this->show($ticket);
    }
}

