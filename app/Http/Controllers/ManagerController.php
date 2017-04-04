<?php

namespace App\Http\Controllers;

use App\JobApplication;
use App\User;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use SebastianBergmann\Environment\Console;

class ManagerController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * Lists user applications
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
    	$user = User::find(auth()->id());
    	$applications = $user->jobapplications;

    	return view('manager', compact('applications'));
    }

	public function openFile(JobApplication $application)
	{
		$applicationPath = storage_path('app') . "/applications/" . $application->file;

		Excel::load($applicationPath, function($reader) use ($application) {
			/**
			 * Assuming that the first sheet name is default since package throws
			 * illegal offset error in case of using 0 as first index lol
			**/
		    $reader->sheet('Sheet1', function($sheet) use ($application) {
		        $sheet->prependRow(1, [
		    		$application->email,
		    		$application->created_at->format('M jS G:i, Y')
		        ])->freezeFirstRow()->setWidth(['A' => 30, 'B' => 30])->setHeight([1 => 30, 2 => 30]);
		    });
		}, 'UTF-8')->export('xls');

		return true;

	}
}
