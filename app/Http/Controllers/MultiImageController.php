<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\MultiImage;
use App\Model\Attachment;

class MultiImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data['multiImages'] = MultiImage::all();
		$data['attachments'] = Attachment::has('imageInfo')->get();
        return view('multiImage.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('multiImage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$multiImage = new MultiImage();
		
		$multiImage->fill($request->all());
        $result = $multiImage->save();

		if($request->hasfile('attachment')){

			if($files = $request->file('attachment')){
				foreach($files as $file){
					$extension = $file->getClientOriginalExtension();
					$filename = 'img'. '_' .time().random_int(0, 1000). '.' .$extension; // Make a file name
					$folder = public_path('uploads/'); // Define folder path
					$file->move($folder, $filename); // Upload image

					// Insert Data to Attachment Table
					$attachment = new Attachment();
					$attachment->multiImage_id = $multiImage->id;
					$attachment->attachment = $filename; // Set file path in database to filePath
					$attachment->save();
				}
			}

		}
		
		if($result){
			return redirect()->route('multiImages.index');
		}else{
			return redirect()->route('multiImages.create');
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
        $data['editData'] = MultiImage::find($id);
		$data['attachments'] = Attachment::where('multiImage_id', $id)->get();
        return view('multiImage.edit', $data);
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
		$multiImage = MultiImage::find($id);
		$multiImage->fill($request->all());
		
		if($request->hasfile('attachment')){

			// Delete Data to Attachment Table
			$allAttachment = Attachment::where('multiImage_id', $id)->get();
			foreach ($allAttachment as $attachmentFile){
				$folder = public_path('uploads/');
				@unlink($folder.$attachmentFile->attachment);
			}
			Attachment::where('multiImage_id', $id)->delete();

			if($files = $request->file('attachment')){
				foreach($files as $file){
					$extension = $file->getClientOriginalExtension();
					$filename = 'up'. '_' .time().random_int(0, 1000). '.' .$extension; // Make a file name
					$folder = public_path('uploads/'); // Define folder path
					$file->move($folder, $filename); // Upload image

					// Insert Data to Notice Attachment Table
					$attachment = new Attachment();
					$attachment->multiImage_id = $id;
					$attachment->attachment = $filename; // Set file path in database to filePath
					$attachment->save();
				}
			}
		}

		$result = $multiImage->update();
		if($result){
			return redirect()->route('multiImages.index');
		}else{
			return redirect()->route('multiImages.create');
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
        $multiImage = MultiImage::find($id);
		// Delete Data to Attachment Table
		$allAttachment = Attachment::where('multiImage_id', $id)->get();
		foreach ($allAttachment as $attachmentFile){
			$folder = public_path('uploads/');
			@unlink($folder.$attachmentFile->attachment);
		}
		Attachment::where('multiImage_id', $id)->delete();
		
		$result = $multiImage->delete();
		
		if($result){
			return redirect()->route('multiImages.index');
		}else{
			return redirect()->route('multiImages.create');
		}

    }
}
