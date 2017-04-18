<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUpload;
use App\Screenshot;
use Auth;
use Misc;

class FileController extends Controller
{

    protected $state = [
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

                Auth::User()->notifyAdmin('upload');
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

    public function update($id)
    {
        if (!$this->sExists($id))
            return false;

        $screenshot = Screenshot::whereId($id);
        $screenshot->update(['approved' => $this->state['approved']]);

        Auth::User()->notifyUser("screenshot", $this->state['approved'], $screenshot->first());
    }


    /*
     * Set screenshot as denied, not actually delete it. File and thumbnail remain on the server.
     */

    public function sExists($id)
    {
        if (Screenshot::whereId($id)->exists())
            return true;

        return false;
    }

    /*
     * Check whether screenshot with given id actually exists before we try to use it.
     */

    public function destroy($id)
    {
        if (!$this->sExists($id))
            return response()->json(['response' => 'error']);

        $screenshot = Screenshot::whereId($id);
        $screenshot->update(['approved' => $this->state['denied']]);

        Auth::User()->notifyUser("screenshot", $this->state['denied'], $screenshot->first());

        return response()->json(['response' => 'success']);
    }
}
