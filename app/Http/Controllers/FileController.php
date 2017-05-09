<?php

namespace L2\Http\Controllers;

use Auth;
use L2\Http\Requests\FileUpload;
use L2\Screenshot;
use Misc;

class FileController extends Controller
{

    private $state = [
        'default' => 0,
        'approved' => 1,
        'denied' => 2,
    ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only' => ['update', 'destroy', 'index']]);
    }

    public function index()
    {
        return view('file.screens')->with('screenshots', Screenshot::screens()->where('approved', $this->state['default']));
    }

    public function store(FileUpload $request)
    {
        if ($request->hasFile('screenshot')) {
            if ($request->file('screenshot')->isValid()) {
                $file = request()->file('screenshot');
                $file_name = str_random(40) . '.' . $file->extension();
                $file->storeAs('public/screenshots/', $file_name);
                $thumbnail_path = storage_path() . '/app/public/screenshots_thumbnail/' . $file_name;
                $original_path = storage_path() . '/app/public/screenshots/' . $file_name;

                Screenshot::create([
                   'description' => request('description'),
                    'path' => $file_name,
                    'account_id' => Auth::id(),
                    'votes' => 0,
                    'approved' => $this->state['default'],
                ]);

                Misc::createThumbnail($original_path, $thumbnail_path, config('custom.thumbnail_x'), config('custom.thumbnail_y'));

                session()->flash('screenshot', 'Screenshot was successfully uploaded. Waiting for approval.');

                /* in case apache doesn't set them properly */
                chmod($original_path, 0644);
                chmod($thumbnail_path, 0644);
            }
        }

        return back();
    }

    /*
     * Approve screenshot to be displayed in carousel.
     */

    public function update(Screenshot $screenshot)
    {
        $screenshot->update(['approved' => $this->state['approved']]);
    }


    /*
     * Set screenshot as denied, not actually delete it. File and thumbnail remain on the server.
     */

    public function destroy(Screenshot $screenshot)
    {

        $screenshot->update(['approved' => $this->state['denied']]);
    }
}
