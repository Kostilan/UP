<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Comment;


class CommentController extends Controller
{
    public function commentCreate(Request $request){
        $request->validate([
            'evaluation' => 'required|min:1|max:5',
            'comment_text' => 'required|max:500',
        ]);
        // Получаем авторизованного пользователя
        $user_id = Auth::id();
        $comment = $request->all();

          // Проверяем, есть ли уже комментарий от пользователя для данной книги
    $existingComment = Comment::where('user_id', $user_id)->where('book_id', $comment['book_id'])->first();

    if ($existingComment) {
        return back()->with('error', 'Вы уже оставили комментарий для этой книги');
    }

        // dd($user);
        // Создание
        Comment::create([
            'evaluation' => $comment['evaluation'],
            'comment_text' => $comment['comment_text'],
            'user_id' => $user_id,
            'book_id' => $comment['book_id'],
        ]);
        return back();
    }

    public function commentUpdate(Request $request, $id){
        $request->validate([
            'evaluation' => 'required|min:1|max:5',
            'comment_text' => 'required|max:500',
        ]);
    
        $comment = Comment::findOrFail($id);
    
        // Проверка, является ли текущий пользователь автором комментария
        if (Auth::id() != $comment->user_id) {
            abort(403, 'Доступ запрещен');
        }
    
        // Обновление комментария   
        if($comment->evaluation != $request['evaluation']) $comment->evaluation = $request['evaluation'];
        if($comment->comment_text != $request['comment_text']) $comment->comment_text = $request['comment_text'];
        
        $comment->save();
    
        return back();
    }
}
