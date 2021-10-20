<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Book;
use App\Http\Resources\Book as BookResource;
use App\Http\Resources\Books as BookResourceCollection;

class BookController extends Controller
{
    public function top($count)
    {
        $criteria = Book::select('*')
            ->orderBy('views', 'DESC')
            ->limit($count)
            ->get();
        return new BookResourceCollection($criteria);
    }

    public function index()
    {
        // $books = $books = new BookCollectionResource(Book::paginate());
        // return $books;
        $criteria = Book::paginate(6);
        return new BookResourceCollection($criteria);
    }

    public function slug($slug)
    {
        $criteria = Book::where('slug', $slug)->first();
        $criteria->views = $criteria->views + 1;
        $criteria->save();
        return new BookResource($criteria);
    }

    public function view($id)
    {
        // $book = DB::select('select * from books where id = :id', ['id' => $id]);
        $book = new BookResource(Book::find($id));
        return $book;
    }

    public function search($keyword)
    {
        $criteria = Book::select('*')
            ->where('title', 'LIKE', "%".$keyword."%")
            ->orderBy('views', 'DESC')
            ->get();
        return new BookResourceCollection($criteria);
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // \Validator::make($request->all(), [
        //     "title" => "required|min:5|max:200",
        //     "description" => "required|min:20|max:1000",
        //     "author" => "required|min:3|max:100",
        //     "publisher" => "required|min:3|max:200",
        //     "price" => "required|digits_between:0,10",
        //     "stock" => "required|digits_between:0,10",
        //     "cover" => "required"
        // ])->validate();


        // $new_book = new \App\Models\Book;
        // $new_book->title = $request->get('title');
        // $new_book->description = $request->get('description');
        // $new_book->author = $request->get('author');
        // $new_book->publisher = $request->get('publisher');
        // $new_book->price = $request->get('price');
        // $new_book->stock = $request->get('stock');

        // $new_book->status = $request->get('save_action');

        // $cover = $request->file('cover');

        // if($cover){
        //   $cover_path = $cover->store('book-covers', 'public');

        //   $new_book->cover = $cover_path;
        // }

        // $new_book->slug = \Str::slug($request->get('title'));

        // $new_book->created_by = \Auth::user()->id;

        // $new_book->save();

        // $new_book->categories()->attach($request->get('categories'));

        // if($request->get('save_action') == 'PUBLISH'){
        //   return redirect()
        //         ->route('books.create')
        //         ->with('status', 'Book successfully saved and published');
        // } else {
        //   return redirect()
        //         ->route('books.create')
        //         ->with('status', 'Book saved as draft');
        // }
    }



}
