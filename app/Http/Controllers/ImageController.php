<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Employee;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data['employees'] = Employee::all();
        return view('singleImage.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('singleImage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = new Employee();
		
		$employee->fill($request->all());
        $result = $employee->save();

		if($request->hasfile('image')){
			if($file = $request->file('image')){
				$extension = $file->getClientOriginalExtension();
				$filename = 'emp'. '_' .time().random_int(0, 1000). '.' .$extension; // Make a file name
				$folder = public_path('uploads/'); // Define folder path
				$file->move($folder, $filename); // Upload image
				
				// Insert Data to Notice Attachment Table
				$employee->image = $filename; // Set file path in database to filePath
				$employee->save();
			}

        }
		
		if($result){
			return redirect()->route('images.index');
		}else{
			return redirect()->route('images.create');
		}

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['editData'] = Employee::find($id);
        return view('singleImage.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$employee = Employee::find($id);
		$employee->fill($request->all());
		
		if($request->hasfile('image')){
			// Delete Image from Folder
			$imageFile = Employee::where('id', $id)->first();
			$folder = public_path('uploads/');
			@unlink($folder.$imageFile->image);
			
			if($file = $request->file('image')){
				$extension = $file->getClientOriginalExtension();
				$filename = 'emp'. '_' .time().random_int(0, 1000). '.' .$extension; // Make a file name
				$folder = public_path('uploads/'); // Define folder path
				$file->move($folder, $filename); // Upload image
				
				// Insert Data to Notice Attachment Table
				$employee->image = $filename; // Set file path in database to filePath
				$employee->save();
			}

        }
		$result = $employee->update();
		if($result){
			return redirect()->route('images.index');
		}else{
			return redirect()->route('images.create');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
		// Delete Image from Folder
		$imageFile = Employee::where('id', $id)->first();
		$folder = public_path('uploads/');
		@unlink($folder.$imageFile->image);
		
        $result = $employee->delete();
		if($result){
			return redirect()->route('images.index');
		}else{
			return redirect()->route('images.create');
		}

    }
}
