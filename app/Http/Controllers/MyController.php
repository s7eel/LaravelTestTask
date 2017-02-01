<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Article;
use Auth;

class MyController extends Controller
{

    /**
     * Функция получения всех объявлений из БД
     * с учетом пагинации
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $articles = Article::paginate(5);
        return view('index', ['articles' => $articles,]);
    }

    /**
     * @param $id
     * integer, id объявления, получаемое из GET запроса
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * редирект на страницу просмотра объявления
     */
    public function showArticle($id)
    {
        $article = Article::find($id);
        return view('showarticle', ['article' => $article,]);
    }

    /**
     * @param null $id - если NULL - происходит создание объявления
     * если не NULL - происхходит редактирование объявления
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createArticle($id = null)
    {
        if(Auth::check()){
            if (!$id) {
                $article = null;
                $button = 'Create';
            } else {
                $article = Article::find($id);
                $user = Auth::id();
                $button = 'Save';
                if($article->user_id != $user){
                    return redirect()->route('index_page');
                }
            }
            return view('addarticle', [
                'article' => $article,
                'button' => $button,
            ]);
        }else{
            return redirect()->route('index_page');
        }

    }

    /**
     * Получение данных из формы POST запросом
     * Если $id=NULL - происходит создание объявления
     * Если не NULL - происходит редактирование, при этом
     * $id - id объявления
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * редирект на страницу новосозданного или отредактированного объявления
     */
    public function saveArticle(Request $request, $id = null)
    {
        $user = Auth::user();
        if ($request->isMethod('post')) {
            $rules = array(
                'title' => 'required',
                'description' => 'required',
            );
            $this->validate($request, $rules);
        }
        /**
         * Создание нового объявления
         */
        if (!$id) {
            $article = new Article([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            $currentID = $user->articles()->save($article);
            return redirect()->route('show_article', ['id' => $currentID->id]);
        /**
         * Редактирование объявления
         */
        } else {
            $article = Article::find($id);
            if($article->user_id === Auth::id()){
                $article->update([
                    'title' => $request->title,
                    'description' => $request->description,
                ]);
                return redirect()->route('show_article', ['id' => $id]);
            }else{
                return redirect()->route('index_page');
            }
        }
    }

    /**
     * @param $id
     * integer, id удаляемого объявления
     * @return \Illuminate\Http\RedirectResponse
     * редирект на главную страницу
     */
    public function deleteArticle($id)
    {
        if(Auth::check()){
            $article = Article::find($id);
            $user = Auth::id();
            if($article->user_id === $user){
                $article->delete();
            }
        }
        return redirect()->route('index_page');
    }
}





















