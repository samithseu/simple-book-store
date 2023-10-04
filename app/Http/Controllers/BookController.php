<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formData = [];
        $formData['filter_by'] = request('filter_by');
        $formData['search_value'] = request('search_value');
        $books = [];
        if(!empty($formData['filter_by'])) {
            $query = '%'.$formData['search_value'].'%';
            $books = Book::where('name', 'LIKE', $query)
                         ->orWhere('unit_price', 'LIKE', $query)
                         ->orWhere('author_name', 'LIKE', $query)
                         ->paginate(4);
        } else {
            $books = Book::paginate(4);
        }
        return view('admin.books.search', compact('formData', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $book = new Book();
        $data = [];
        $data['name'] = $request->name;
        $data['unit_price'] = $request->unit_price;
        $data['author_name'] = $request->author_name;
        $book->fill($data);
        try {
            $book->save();
            return redirect()->route('books.edit', $book->id)->with('success', 'Book created successfully!');
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Book $book = null)
    {
        $data = [];
        $data['name'] = request('name');
        $data['unit_price'] = request('unit_price');
        $data['author_name'] = request('author_name');
        $book->fill($data);
        try {
            $book->save();
            return redirect()->route('books.create')->with('success', 'Book updated successfully!');
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        try {
            $book->delete();
            return back()->with('success', 'Book deleted successfully!');
        } catch (\Throwable $th) {
            return back()->withInput()->with('success', "Can't delete because it's in use!");
        }
    }
}
