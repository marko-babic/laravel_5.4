<?php

namespace App\Http\Controllers;

use Auth;
use \App\Http\Requests\FileUpload;
use \App\Screenshot;
use Illuminate\Http\Request;

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

                Screenshot::create([
                   'description' => request('description'),
                    'path' => $file_name,
                    'account_id' => Auth::user()->id,
                    'votes' => 0
                ]);

                session()->flash('screenshot', 'Screenshot was successfully uploaded. Waiting for approval.');
            }
        }

        return back();
    }

    public function update(Request $request, $id)
    {
        $screenshot = Screenshot::find($id);

        $screenshot->approved = 1;
        $screenshot->save();

        return response()->json(['response' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
