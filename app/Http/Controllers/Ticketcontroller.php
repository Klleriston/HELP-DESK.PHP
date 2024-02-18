<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Ticket;

class Ticketcontroller extends Controller
{
    public function getAllTickets(Request $request)
    {
        try {
            $tickets = Ticket::all();
            return response()->json($tickets);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Tickets not found"], 404);
        }
    }

    public function getTicketsById(Request $request)
    {
        try {
            $ticket = Ticket::findOrFail($request->id);
            return response()->json($ticket);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Ticket not found"], 404);
        }
    }

    public function createTicket(Request $request)
    {
        $validatedData = $request->validate([
            "user_id" => "required|integer",
            "title" => "required|string|max:100",
            "content" => "required",
            "posted" => "required|boolean"
        ]);

        $ticket = Ticket::create($validatedData);

        return response()->json(['message' => 'Sucess !', 'ticket' => $ticket], 201);

    }

    public function updateTicket(Request $request)
    {
        try {
            $ticket = Ticket::findOrFail($request->id);

            $validatedData = $request->validate([
                "title" => "required|string|max:100",
                "content" => "required"
            ]);

            $ticket->update($request->only(['title', 'content']));

            return response()->json(['message' => 'Ticket updated !', 'ticket' => $ticket], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Ticket not found !'], 404);
        }
    }

    public function deleteTicket(Request $request)
    {
        try {
            $ticket = Ticket::findOrFail($request->id);

            $ticket->delete();

            return response()->json(['message' => 'Tikcet deleted sucessfully', 'ticket' => $ticket], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Ticket not found'], 404);
        }
    }
}