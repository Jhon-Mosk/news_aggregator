<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        //форма для создания категории
        return view('admin.categories.create', ['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        //создание категории
        return $this->upsertCategory($request, $category, 'save');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //форма редактировать
        return view('admin.categories.create', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //обновить
        return $this->upsertCategory($request, $category, 'update');
    }

    private function upsertCategory($request, $category, $action)
    {
        $request->flash();

        $slug = Str::of($request->name)->slug('-');
        $category->slug = $slug;

        ($action === 'save') ? $category->fill($request->all())->save() :
            $category->fill($request->all())->update();



        return redirect()
            ->route('admin.categories.index')
            ->with('success', ($action === 'save') ? 'Категория успешно добавлена' : 'Категория успешно изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //удалить
        $category->delete();

        $categories = Category::all();

        return redirect()
            ->route('admin.categories.index', ['categories' => $categories])
            ->with('success', 'Категория успешно удалена');
    }
}
