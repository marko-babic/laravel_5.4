<?php

namespace L2\Http\Controllers;

use Auth;
use L2\Http\Requests\FileUpload;
use L2\Http\Requests\ScreenshotCheck;
use L2\Repositories\ScreenshotRepository as Screenshot;
use Misc;

class FileController extends Controller
{

    private $state = [
        'default' => 0,
        'approved' => 1,
        'denied' => 2,
    ];

    private $screenshot;

    public function __construct(Screenshot $screenshot)
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only' => ['update', 'destroy', 'index']]);

        $this->screenshot = $screenshot;
    }

    public function index()
    {
        return view('admin.slugs.screenshots.screens')->with('screenshots', $this->screenshot->screens($this->state["default"]));
    }

    public function store(FileUpload $request)
    {
        if(!$request->file('screenshot')->isValid())
            return back();

        $file_name = $this->saveUploadedScreenshot($request->file('screenshot'));

        $this->screenshot->create([
           'description' => $request->input('description'),
            'path' => $file_name,
            'account_id' => Auth::id(),
            'votes' => 0,
            'approved' => $this->state['default'],
        ]);

        session()->flash('screenshot', 'Screenshot was successfully uploaded. Waiting for approval.');
        return back();
    }

    /*
     * Approve screenshot to be displayed in carousel.
     */

    public function update($id, ScreenshotCheck $request)
    {
        $screenshot = $this->screenshot->getById($id);

        $screenshot->update(['approved' => $this->state['approved']]);
    }

    /*
     * Set screenshot as denied, not actually delete it. File and thumbnail remain on the server.
     */

    public function destroy($id, ScreenshotCheck $request)
    {
        $screenshot = $this->screenshot->getById($id);

        $screenshot->update(['approved' => $this->state['denied']]);
    }

    public static function saveUploadedScreenshot($file)
    {
        $file_name = str_random(40) . '.' . $file->extension();
        $file->storeAs('public/screenshots/', $file_name);
        $thumbnail_path = storage_path() . '/app/public/screenshots_thumbnail/' . $file_name;
        $original_path = storage_path() . '/app/public/screenshots/' . $file_name;

        Misc::createThumbnail($original_path, $thumbnail_path, config('custom.thumbnail_x'), config('custom.thumbnail_y'));

        /* in case apache doesn't set them properly */
        chmod($original_path, 0644);
        chmod($thumbnail_path, 0644);

        return $file_name;
    }
}
