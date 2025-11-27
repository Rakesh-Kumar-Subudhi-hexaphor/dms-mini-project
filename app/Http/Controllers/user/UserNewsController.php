<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategory;
use App\Models\NewsSubCategory;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class UserNewsController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Get the logged-in user's ID

        // Eager load 'category' and 'subcategory' relationships
        $news = News::with(['category', 'subcategory'])->where('user_id', $userId)->get();

        // Pass the blog data to the view
        return view('user.news.index', compact('news'));
    }

    public function create()
    {
        $newsCat = NewsCategory::all();
        return view('user.news.create', compact('newsCat'));
    }

    public function getSubCategories(Request $request)
    {
        $subcategories = NewsSubCategory::where('category_id', $request->category_id)->get();

        // Return as JSON response
        return response()->json($subcategories);
    }
    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required',
            'newsImg' => 'required',
            'desc' => 'nullable',
            'tag' => 'nullable',
            'subcategory_id' => 'nullable',


        ]);
        $newsImgName = null;

        if ($request->hasFile('newsImg')) {
            $newsImg = $request->file('newsImg'); // Specify the correct file input name
            $newsImgName = time() . '_' . $newsImg->getClientOriginalName();
            $newsImg->move(public_path('news_img'), $newsImgName);
        }
        $slug = Str::slug($request->title);

        $news = new News();
        $news->title = $request->input('title');
        $news->slug = $slug;
        $news->newsImg = 'news_img/' .  $newsImgName;
        $news->meta_title = $request->input('meta_title');
        $news->meta_desc = $request->input('meta_desc');
        $news->meta_keywords = $request->input('meta_keywords');
        $news->desc = $request->input('desc');
        $news->tag = $request->input('tags_hidden');
        $news->category_id = $request->input('category_id');
        $news->subcategory_id = $request->input('subcategory_id');
        $news->status = 2; // Set default status to Inactive (2)
        $news->user_id = Auth::id();
        $news->save();
        return redirect()->route('user.news')->with('success', 'News added successfully!');
    }

    public function destroy($id)
    {
        // Find the blog post by ID
        $news = News::findOrFail($id);


        // Delete the associated image if it exists (using public_path() to directly reference the file)
        $imagePath = public_path($news->newsImg); // The path where the image is stored
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the image file
        }

        // Delete the news post from the database
        $news->delete();

        return redirect()->route('user.news')->with('success', 'News deleted successfully!');
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        $newsCat = NewsCategory::all(); // Retrieve all categories
        $subCategories = NewsSubCategory::where('category_id', $news->category_id)->get(); // Get subcategories based on the blog's category

        return view('user.news.edit', compact('news', 'newsCat', 'subCategories'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        // Validation
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'nullable',
            'title' => 'required|string|max:255',
            'newsImg' => 'nullable|image',

            'desc' => 'required|string',

            'tag' => 'nullable|array',
            'tag.*' => 'nullable|string',
        ]);

        // Update Blog
        $news->category_id = $request->category_id;
        $news->subcategory_id = $request->subcategory_id;
        $news->title = $request->title;
        $news->meta_title = $request->meta_title;
        $news->meta_desc = $request->meta_desc;
        $news->meta_keywords = $request->meta_keywords;
        $news->desc = $request->desc;
        $news->tag = $request->input('tags_hidden','');

        if ($request->hasFile('newsImg')) {
            $news->image = $request->file('newsImg')->store('news_img', 'public');
        }

        $news->save();

        return redirect()->route('user.news')->with('success', 'News updated successfully');
    }
}
