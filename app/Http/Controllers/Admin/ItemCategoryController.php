<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ItemCategory;
use App\Http\Requests\ItemCategoryRequest;

class ItemCategoryController extends Controller
{
    protected $category;

    public function __construct(ItemCategory $category)
    {
        $this->middleware('auth:admin');
        $this->category = $category;
    }

    public function index(Request $request)
    {
        $categories = $this->category->all();
        return view('admin.item_category.index', compact('categories'));
    }

    public function create(Request $request)
    {
      if (!empty($request->all())) {
          $data = $request->session()->get('data');
      } else {
          $data = null;
      }

      return view('admin.item_category.create', compact('data'));
    }

    public function store(Request $request)
    {
      $data = $request->session()->pull('data');
      $res = $this->category->createItemCategory($data);

      return redirect()->route('admin.item_category.index');
    }

    public function edit(Request $request, $id)
    {
        if (!empty($request->all())) {
            $category = $request->session()->get('data');
        } else {
            $category = $this->category->find($id);
        }

        return view('admin.item_category.edit', compact('category'));
    }

    public function updateCategory(Request $request)
    {
        $data = $request->session()->pull('data');
        $this->category->updateItemCategory($data);

        return redirect()->route('admin.item_category.index');
    }

    public function destroy($id)
    {
        $category = $this->category->find($id);
        $category->delete();

        return redirect()->route('admin.item_category.index');
    }

    public function confirm(ItemCategoryRequest $request)
    {
        $data = $request->all();
        $request->session()->put('data', $data);

        return view('admin.item_category.confirm', compact('data'));
    }

    public function updateConfirm(ItemCategoryRequest $request)
    {
        $data = $request->all();
        $request->session()->put('data', $data);

        return view('admin.item_category.update_confirm', compact('data'));
    }

}

