<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

use App\Medicine;
use Auth;
class MedicalController extends Controller
{

    public function ajaxProduct(Request $request){
        if ($request->isXmlHttpRequest()) {
            DB::enableQueryLog();
            $limit = (int)$request->input('limit');
            $offset = (int)$request->input('offset');

            $medicine = Medicine::where('added_by',Auth::user()->id);
            $TotalProduct = $medicine->count();
            $ProductArray = [];

            $medicine->limit($limit)->offset($offset)->latest()->get()->each(static function (Medicine $product) use (&$ProductArray) {
                $routeDestroy =  route('web.medicel.delete', ['id' => $product->id]);
                $routeEdit =  route('web.medicel.edit', ['id' => $product->id]);

                $ProductArray[] = [
                    'image' => '<img src="'.url('storage/'.$product->image.'').'"alt="'.$product->name.'" style ="height: 150px;width: 150px;">',
                    'name' => $product->name,
                    'description' => $product->description,
                    'action' => '
                    <a class="jquery-postback" data-method="delete" href="'.$routeDestroy.'" data-method="delete" style="color: white"><button class="btn btn-outline-primary btn-md ">Remove</button></a>
                    <a data-method="delete" href="'.$routeEdit.'" data-method="delete" style="color: white"><button class="btn btn-outline-primary  btn-md">Update</button></a>',
                ];
            });

            return [
                'total' => $TotalProduct,
                'rows' => $ProductArray,
                'query' => DB::getQueryLog(),
            ];
        }

        return \response('', 400);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Medicine::where('added_by',Auth::user()->id)->get();
        return view('medical.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medical.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:80',
            'description'=>'required|max:265',
            'image'=>'required|mimes:jpeg,jpg,png,gif,svg',
        ]);

        if($request->hasFile('image')){
            $filenameWithExtention = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($filenameWithExtention,PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $extension_accept = array("jpeg", "jpg", "png", "gif", "svg");

            if(!in_array($extension, $extension_accept))
            {
                return back()->withError("Error in Upload image File");
            }

            $fileNameStore = $fileName .'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/medical',$fileNameStore);
        }
        else {
            return back()->withError("Error in Upload image File");
        }


        Medicine::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => 'medical/'.$fileNameStore,
            'added_by' => Auth::user()->id,
        ]);
        return back()->withMessage("success Added");
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
        $product = Medicine::findOrfail($id);
        return view('medical.edit',compact('product'));
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
        $this->validate($request,[
            'name'=>'required|max:80',
            'description'=>'required|max:265',
        ]);

        if($request->hasFile('image')){
            $filenameWithExtention = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($filenameWithExtention,PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $extension_accept = array("jpeg", "jpg", "png", "gif", "svg");

            if(!in_array($extension, $extension_accept))
            {
                return back()->withError("Error in Upload image File");
            }

            $fileNameStore = $fileName .'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/medical',$fileNameStore);
        }
        else {
            $fileNameStore = '';
        }

        $medicine = Medicine::findOrfail($id);
        $medicine->name = $request->name;
        $medicine->description = $request->description;
        if($fileNameStore !== ''){
            $medicine->image = 'medical/'.$fileNameStore;

        }
        $medicine->save();
        return back()->withMessage("success Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Medicine::findOrfail($id)->delete();
        return \response('', 200);
    }
}
