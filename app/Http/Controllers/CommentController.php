<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Comment;
use App\Models\Review;


class CommentController extends Controller
{
    public function commentCreate(Request $request){
        $request->validate([
            'evaluation' => 'required|min:1|max:5',
            'comment_text' => 'required|max:500',
        ], [
            'evaluation.required' => 'Пожалуйста, укажите оценку.',
            'evaluation.min' => 'Оценка должна быть не менее :min.',
            'evaluation.max' => 'Оценка должна быть не более :max.',
            'comment_text.required' => 'Пожалуйста, напишите ваш отзыв.',
            'comment_text.max' => 'Длина отзыва не должна превышать :max символов.',
        ]);
    
        // Получаем авторизованного пользователя
        $user_id = Auth::id();
        $comment = $request->all();

          // Проверяем, есть ли уже комментарий от пользователя для данной книги
    $existingComment = Comment::where('user_id', $user_id)->where('book_id', $comment['book_id'])->first();

    if ($existingComment) {
        return back()->with('error', 'Вы уже оставили комментарий для этой книги');
    }
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
        ], [
            'evaluation.required' => 'Пожалуйста, укажите оценку.',
            'evaluation.min' => 'Оценка должна быть не менее :min.',
            'evaluation.max' => 'Оценка должна быть не более :max.',
            'comment_text.required' => 'Пожалуйста, напишите ваш отзыв.',
            'comment_text.max' => 'Длина отзыва не должна превышать :max символов.',
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

    public function reviewCreate($id){
        $book_id = $id;
        // dd($book_id);
        $reviews = Review::where('book_id',$id)->get();
        $user = Auth::user();
        $reviewExists = $user->review()->where('book_id', $book_id)->first();
        // dd($reviewExists);
        
        return view('reviews',compact('reviews','book_id','reviewExists'));
    }

    public function reviewCreate_valid(Request $request){
        $request->validate([
            'evaluation' => 'required|min:1|max:5',
            'review_text' => 'required|max:500',
        ],  [
            'evaluation.required' => 'Пожалуйста, укажите оценку.',
            'evaluation.min' => 'Оценка должна быть не менее :min.',
            'evaluation.max' => 'Оценка должна быть не более :max.',
            'review_text.required' => 'Пожалуйста, напишите ваш отзыв.',
            'review_text.max' => 'Длина отзыва не должна превышать :max символов.',
        ]);
        // Получаем авторизованного пользователя
        $user_id = Auth::id();
        $review = $request->all();

          // Проверяем, есть ли уже комментарий от пользователя для данной книги
    $existingComment = Review::where('user_id', $user_id)->where('book_id', $review['book_id'])->first();

    if ($existingComment) {
        return back()->with('error', 'Вы уже оставили рецензию для этой книги');
    }
        // Создание
        Review::create([
            'evaluation' => $review['evaluation'],
            'review_text' => $review['review_text'],
            'user_id' => $user_id,
            'book_id' => $review['book_id'],
        ]);
        return back();
    }

    public function reviewUpdate_valid(Request $request, $id)
{
    $request->validate([
        'evaluation' => 'required|min:1|max:5',
        'review_text' => 'required|max:500',
    ], [
        'evaluation.required' => 'Пожалуйста, укажите оценку.',
        'evaluation.min' => 'Оценка должна быть не менее :min.',
        'evaluation.max' => 'Оценка должна быть не более :max.',
        'review_text.required' => 'Пожалуйста, напишите ваш отзыв.',
        'review_text.max' => 'Длина отзыва не должна превышать :max символов.',
    ]);

    $review = Review::findOrFail($id);
    $review->update([
        'evaluation' => $request->evaluation,
        'review_text' => $request->review_text,
    ]);

    return back()->with('success', 'Рецензия успешно обновлена');
}
}
