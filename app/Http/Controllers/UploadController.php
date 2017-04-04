<?php

namespace App\Http\Controllers;

use App\JobApplication;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    protected $allowedFormats = ['xls', 'xlsx'];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'file' => 'required|file'
        ]);

        $user = User::find(auth()->id());

        /**
         * No checks because there was nothing said about different applications, thus considering there to be just one job to apply to.
         */
        if(!$this->isAllowed($request->file)) {
            return back()->withInput()->withErrors("File format not allowed! Must be Excel document.");
        }

        $fileName = str_random(30) . "." . $request->file->getClientOriginalExtension();
        $request->file->storeAs('applications', $fileName);

        $user->jobapplications()->create([
            'email' => $request->email,
            'file' => $fileName
        ]);

        return view('manager', ['applications' => $user->jobapplications]);
    }

    public function getFilePath()
    {
        return storage_path('app') . "/applications/" . $application;
    }

    public function isAllowed(UploadedFile $file)
    {
       return in_array($file->getClientOriginalExtension(), $this->allowedFormats);
    }
}
