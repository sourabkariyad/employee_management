<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Employee;
use App\Models\Designation;
use Image;

class EmployeeController extends Controller
{
    public function lists()
    {
        $employees = Employee::all();
        return view('employee-list',['employees'=>$employees]);
    }
    public function employeeAdd()
    {
        $designations = Designation::orderby('designation')->get();
        return view('employee-add',['designations'=>$designations]);
    }

    public function employeeEdit($id)
    {
        $employee = Employee::find($id);
        $designations = Designation::orderby('designation')->get();
        return view('employee-edit',['designations'=>$designations,'employee'=>$employee]);
    }

    public function employeeUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'designation' => 'required',
            'photo' => 'image|mimes:jpg,jpeg,png,svg,gif|max:5120',
        ]);
        $id = $request->id;
        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->desig_id = $request->designation;
        

        if($request->hasfile('photo')){

            $userPhoto = public_path('images/').$employee->photo;

            $userThumb = public_path('thumbnails/').$employee->photo;

            if(file_exists($userPhoto)){

                @unlink($userPhoto); 
                
            }
            if(file_exists($userThumb)){

                @unlink($userThumb); 
                
            }

            $image = $request->file('photo');
            $input['imagename'] = time().'.'.$image->extension();
            $employee->photo = $input['imagename'];
            $filePath = public_path('/thumbnails');

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$input['imagename']);
       
            $filePath = public_path('/images');
            $image->move($filePath, $input['imagename']);
        }

        $employee->save();


        return redirect('/')->with("success", "Updated successfully.");
       


    }

    public function employeeDelete($id)
    {
        $employee = Employee::find($id);

        $userPhoto = public_path('images/').$employee->photo;

        $userThumb = public_path('thumbnails/').$employee->photo;

        if(file_exists($userPhoto)){

            @unlink($userPhoto); 
            
        }
        if(file_exists($userThumb)){

            @unlink($userThumb); 
            
        }


        $employee->delete();

        return back()->with("success", "Deleted successfully.");
    }

    public function employeeNew(Request $request)
    {
       $this->validate($request, [
            'name' => 'required',
            'email' => ['required', 'unique:employees'],
            'designation' => 'required',
            'photo' => 'image|mimes:jpg,jpeg,png,svg,gif|max:5120',
        ]);
  
        $image = $request->file('photo');
        $input['imagename'] = time().'.'.$image->extension();
     
        $filePath = public_path('/thumbnails');

        $img = Image::make($image->path());
        $img->resize(110, 110, function ($const) {
            $const->aspectRatio();
        })->save($filePath.'/'.$input['imagename']);
   
        $filePath = public_path('/images');
        $image->move($filePath, $input['imagename']);

        $employee = new Employee;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->desig_id = $request->designation;
        $employee->photo = $input['imagename'];
        $employee->save();

        $password = Str::random(8);

        $details = [
            'title' => 'New Accout created',
            'body' => "Your account has been created".$password,
        ];
   
        //Add mail configuration in .env file and uncomment the below line.
        //\Mail::to($request->email)->send(new \App\Mail\NewEmpMail($details));

        return redirect('/')->with('success','New Employee Added');


    }


}
