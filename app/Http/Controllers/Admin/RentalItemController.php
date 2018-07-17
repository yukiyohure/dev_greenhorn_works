<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Items;
use App\Models\ItemCategory;
use App\Http\Requests\ItemsRequest;

class RentalItemController extends Controller
{
    protected $item;
    protected $category;

    public function __construct(Items $item, ItemCategory $category)
    {
        $this->middleware('auth:admin');
        $this->item = $item;
        $this->category = $category;
    }

    public function index(Request $request)
    {
        $inputs = $request->all();
        $categories = $this->category->all();

        if (!empty($inputs)) {
            $items = $this->item->getItemsBySearching($inputs);
            return view('admin.rent.index', compact('items', 'categories'));
        } else {
            $items = $this->item->all();
            return view('admin.rent.index', compact('items', 'categories'));
        }
    }

    public function create(Request $request)
    {
        if (!empty($request->all())) {
            $data = $request->session()->get('data');
        } else {
            $data = null;
        }
        $categories = $this->category->all();
        return view('admin.rent.create', compact('categories', 'data'));
    }

    public function store(Request $request)
    {
        $data = $request->session()->pull('data');
        $this->item->createItems($data);
        return redirect()->route('admin.rent.index');
    }

    public function show($id)
    {
        $item = $this->item->find($id);
        return view('admin.rent.show', compact('item'));
    }

    public function edit(Request $request, $id)
    {
        if (!empty($request->all())) {
            $item = $request->session()->get('data');
        } else {
            $item = $this->item->find($id);
        }
        $categories = $this->category->all();
        return view('admin.rent.edit' ,compact('id', 'item', 'categories'));
    }

    public function updateItems(Request $request)
    {
        $data = $request->session()->get('data');
        $this->item->updateItemById($data);
        return redirect()->route('admin.rent.index');
    }

    public function destroy($id)
    {
        $item = $this->item->find($id);
        $item->delete();
        return redirect()->route('admin.rent.index');
    }

    public function confirm(ItemsRequest $request)
    {
        $data = $request->all();
        $request->session()->put('data', $data);
        $category = $this->category->find($data['item_category_id'])->category;
        return view('admin.rent.confirm', compact('data', 'category'));
    }

    public function updateConfirm(ItemsRequest $request)
    {
        $data = $request->all();
        $request->session()->put('data', $data);
        $category = $this->category->find($data['item_category_id'])->category;
        return view('admin.rent.update_confirm', compact('data', 'category'));
    }

}

