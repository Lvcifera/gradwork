<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function create() {

        return view('tickets.show');

    }

    public function store(CommentRequest $request) {

        $person_id = User::with('person')
            ->find(Auth::user()->id);
        $comment = new Comment();
        $comment->person_id = $person_id->person->id;
        $comment->ticket_id = $request->ticket_id;
        $comment->text = $request->comment_text;

        $comment->save();

        return redirect()->back()->with('success', 'Комментарий успешно добавлен');

    }

    public function destroy($id) {

        $comment = Comment::find($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Комментарий успешно удален');

    }
}
