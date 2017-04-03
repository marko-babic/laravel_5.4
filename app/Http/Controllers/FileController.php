<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests\FileUpload;
use App\Screenshot;
use Illuminate\Http\Request;
use Misc;

class FileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only' => ['update']]);
    }

    public function index()
    {
        return view('file.screens')->with('screenshots',Screenshot::screens()->where('approved', 0));
    }

    public function store(FileUpload $request)
    {
        if ($request->hasFile('screenshot')) {
            if ($request->file('screenshot')->isValid()) {
                $file = request()->file('screenshot');
                $file_name = str_random(40) . '.' . $file->extension();
                $file->storeAs('public/screenshots/', $file_name);
                $thumbnail_path = storage_path() . '\app\public\screenshots_thumbnail\\' . $file_name;
                $original_path = storage_path() . '\app\public\screenshots\\' . $file_name;

                Screenshot::create([
                   'description' => request('description'),
                    'path' => $file_name,
                    'account_id' => Auth::user()->id,
                    'votes' => 0
                ]);

                Misc::createThumbnail($original_path, $thumbnail_path, config('custom.thumbnail_x'), config('custom.thumbnail_y'));

                session()->flash('screenshot', 'Screenshot was successfully uploaded. Waiting for approval.');
            }
        }

        return back();
    }

    public function update(Request $request, $id)
    {
        Screenshot::whereId($id)->update(['approved' => 1]);

        return response()->json(['response' => 'success']);
    }

    public function destroy($id)
    {
        //
    }
}
