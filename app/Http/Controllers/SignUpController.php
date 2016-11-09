<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\TempEmployee;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use DB;
use Auth;
use Validator, Input, Redirect;
use Session;
use Carbon\Carbon;

    /**
     * This controller handles those actions that are outside any employees,patients and admin.
     * mainly login for two types of users,registering employees,changing password and editing
     * profile,and showing profile for all types of user are handled here.
     *
     */
class SignUpController extends Controller
{
    /**
     * Handles the patient's part of login
     *
     * @return redirect to main page. If error found then to the same page with error
     */
    public function log(Request $request)
    {
        //
        $this->validate($request,[
            'id'=>'required',
            'password'=>'required',
            ]);
        $patients  = DB::table('patients')
                     ->where('id', '=', $request->id)
                     ->where('password', '=', $request->password)
                     ->get();
        
        if (count($patients)){
            Session::put('user',$patients[0]);
            return Redirect::to('/');
        }
        if (count($patients) == 0)
            return Redirect::to('/login')->withErrors('ID or Password is incorrect');
        


        
    }
     /**
     * Handles the employee's and admin's part of login
     *
     * @return redirect to main page. If error found then to the same page with error
     */
    public function log2(Request $request)
    {
        //
        $this->validate($request,[
            'id'=>'required',
            'password'=>'required',
            ]);
        $employees = DB::table('employees')
                     ->where('id', '=', $request->id)
                     ->where('password', '=', $request->password)
                     ->get();
        
        if (count($employees)){
            Session::put('user',$employees[0]);
            return Redirect::to('/');
        }

        if (count($employees) == 0)
            return Redirect::to('/login2')->withErrors('ID or Password is incorrect');
        
    }

    /**
     * Show the main page of respective users. First it determines whether the user is 
     * patient or employee. If employee, then it determines the designation of the employee
     * 
     * @return views for respective user,whether it is patient or employee or admin
     */
    public function main()
    {
        //
        if (Session::has('user')) {
            $name = Session::get('user')->first_name." ".Session::get('user')->last_name;
            $data  = Session::get('user');
            $check  = property_exists($data, 'designation');
            if ($check == 0)
                return view('pat.index')->withName($name);
            

            $value = Session::get('user')->designation;
            if ($value == 'Chief Health Officer')
                return view('cho.index')->withName($name);
            elseif ($value == 'Health Officer'){
                $empno = Session::get('user')->emp_no;
                $temp = "SELECT B.center_name,B.location,B.district,C.campaign_name, DATE_FORMAT(C.campaign_date , \"%d-%m-%Y\") as \"campaign_date\" 
                    FROM `campaigncenters` as A, centers as B,campaigns as C
                 WHERE A.ho_id = '$empno' and C.campaign_no = A.campaign_no and A.center_no = B.center_no ";
                $temp2 = DB::select($temp);
                $name2 = $name;
                $name = array($name2,$temp2);
                //var_dump($name);
                return view('ho.index')->withName($name);
            }
            elseif ($value == 'Health Assistant'){
                $empno = Session::get('user')->emp_no;
                $temp = DB::select('SELECT C.center_name,C.location,C.district,D.campaign_name,DATE_FORMAT(D.campaign_date , "%d-%m-%Y") as "campaign_date" 
                    FROM events as A,campaigncenters as B,centers as C,campaigns as D 
                    WHERE A.ha_no = :somevariable and B.cc_no = A.cc_no and
                     C.center_no = B.center_no and D.campaign_no = B.campaign_no ',array('somevariable' => $empno));
                $name2 = $name;
                $name = array($name2,$temp);
                return view('ha.index')->withName($name);
            }
            elseif ($value == 'admin'){
                $name = 'Admin';
                return view('admin.index')->withName($name);
            }

        }
        else 
        return view('index');
    }

    /**
     * Register employees in the temporary employee table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return to the employee's login page. If error found,then to the same page with errors.
     */
    public function store(Request $request){
        
        $validator = Validator::make($request->all(),[
        'id' => 'required|unique:temp_employees,id',
        'password'=>'required',
        'password_retype' =>'required|same:password',
        'firstname'=>'required',
        'lastname'=>'required',
        'mobile_no'=>'required',
        'address'=>'required',
        'email'=> 'required|email',      
    ]);
    if ($validator->fails()) {

        // get the error messages from the validator
        $messages = $validator->messages();
        // redirect our user back to the form with the errors from the validator
        return Redirect::to('/signup')
            ->withErrors($validator);

    }
    else{
        $employee = new TempEmployee;
        $employee->id           = $request->id;
        $employee->email        = $request->email;
        $employee->password     = $request->password;
        $employee->first_name   = $request->firstname;
        $employee->last_name    = $request->lastname;
        $employee->gender       = $request->DropDownList1;
        $employee->designation  = $request->DropDownList2;
        $employee->email        = $request->email;
        $employee->address      = $request->address;
        $employee->mobile_no    = $request->mobile_no;

        // save our duck
        $employee->save();
        
        Session::put('toast','Employee is registered. Now approval from admin is required for the account to be active.');

        return Redirect::to('/login2');
      }
      
    }

    /**
     * Display the login page for patients
     *
     * 
     * @return view for patient's login
     */
    public function getLogin()
    {
        return view('login');
    }

    /**
     * Display the login page for patients
     * Also shows a toast after registering employees
     * 
     * @return view for employee's login
     */
    public function getLogin2()
    {
        $tost = null;
        if (Session::has('toast')) {
           $tost = Session::get('toast');
           Session::forget('toast');
        } 
        return view('login2')->withTost($tost);
    }
    /**
     * makes the user log out.
     * clears the session.
     * 
     * @return redirect to main page.
     */
    public function getLogout()
    {
        //
        Session::flush();
        return Redirect::to('/');

    }

    /**
     * shows the profile for respective users
     * First determines if the user is patient. Then patient's info alongside his vaccination
     * history is sent to the patient's profile view.
     * If the user is employee. Then their profile view is returned along side their info
     * differentiating by their designation.
     * @return view for respective users.
     */
    public function getProfile()
    {
        //
          if (Session::has('user')) {
            $user = Session::get('user');
            $check  = property_exists($user, 'designation');
            
            $toast = null;
            if (Session::has('toast')){
                $toast = Session::get('toast');
                Session::forget('toast');
            }
            
            if ($check == 0){
                $patient = $user;
                $history = DB::table('vacc_record')
                     ->where('patient_id', '=', $patient->id)
                     ->get();

                if (count($history)){
                    foreach ($history as $value) {
                        $temp2 = DB::table('employees')
                        ->where('id', '=', $value->healthasst_id)
                        ->get();
                        $temp3 = $temp2[0]->first_name." ".$temp2[0]->last_name;
                        $value->healthasst_id = $temp3;
                    }
                }
                $data = array($patient,$history,$toast);
                
                return view('pat.profile')->withData($data);
            }
            else{
                $value = Session::get('user')->designation;
                $data = array($user,$toast);
                if ($value == 'Chief Health Officer')
                    return view('cho.profile')->withData($data);
                elseif ($value == 'Health Officer')
                    return view('ho.profile')->withData($data);
                elseif ($value == 'Health Assistant')
                    return view('ha.profile')->withData($data);
                else
                    return view('pat.profile')->withData($data);
            }
        }
    }
    /**
     * shows the page for editing profile
     * two kind of pages for profile editing.one for patient and another for employees.
     * 
     * @return view for profile editing page for respective users.
     */
    public function editProfile()
    {
          if (Session::has('user')) {
            $data  = Session::get('user');
            $check  = property_exists($data, 'designation');
            if ($check == 0){
                $id = Session::get('user')->id;
                $temp = DB::select('SELECT patient_no, id, password, first_name, last_name, father_name, mother_name, gender,DATE_FORMAT(date_of_birth, "%d/%m/%Y") 
                    as "date_of_birth", age, mobile_no, address FROM patients where id = :somevariable',array('somevariable' => $id));
                //var_dump(array($id,$data));
                return view('pat.editProfile')->withTemp($temp[0]);
            }
            elseif ($check == 1){
            $value = Session::get('user')->designation;
            if ($value == 'Chief Health Officer')
                return view('cho.editProfile')->withData($data);
            elseif ($value == 'Health Officer')
                return view('ho.editProfile')->withData($data);
            elseif ($value == 'Health Assistant')
                return view('ha.editProfile')->withData($data);
            }

        }
    }
     /**
     * shows the page for changing password
     * two kind of pages for password changing.one for patient and another for employees.
     * for the view we are also sending the old values that we will update or leave alone.
     * @return view for password changing page for respective users.
     */
    public function changePassword()
    {
          if (Session::has('user')) {
            $data  = Session::get('user');

            $check  = property_exists($data, 'designation');
            if ($check == 0)
                return view('pat.passwordChange')->withData($data);

            $value = Session::get('user')->designation;
            if ($value == 'Chief Health Officer')
                return view('cho.passwordChange')->withData($data);
            elseif ($value == 'Health Officer')
                return view('ho.passwordChange')->withData($data);
            elseif ($value == 'Health Assistant')
                return view('ha.passwordChange')->withData($data);
            else
                return view('pat.passwordChange')->withData($data);

        }
    }
    /**
     * handles the mechanism for profile editing.After clicking the edit button this function
     * will be called and the profile will be changed.
     * two kind of pages for profile editing.one for patient and another for employees.
     * 
     * @return redirect to the profile
     */
    public function editProfile2(Request $request)
    {
        if (Session::has('user')) {
            $data  = Session::get('user');
            $check  = property_exists($data, 'designation');
            if ($check == 0){
                $input = array($request->first_name,
                               $request->last_name,
                               $request->father_name,
                               $request->mother_name,
                               Carbon::createFromFormat('d/m/Y', $request->date_of_birth),
                    $request->DropDownList1,$request->mobile_no,$request->address);
                DB::table('patients')->where('id', $data->id)
                ->update(['first_name' => $input[0],
                    'last_name' => $input[1],
                    'father_name'=> $input[2],
                    'mother_name'=>$input[3],
                    'date_of_birth'=> $input[4],
                    'gender' =>$input[5],
                    'mobile_no' => $input[6],
                    'address'=>$input[7]  ]);
                $employees = DB::table('patients')
                     ->where('id', '=', $data->id)
                     ->get();                
                Session::put('user',$employees[0]);
            }
            elseif ($check == 1){
                $input = array($request->first_name,$request->last_name,$request->mobile_no,$request->email,$request->address);
                DB::table('employees')->where('id', $data->id)
                ->update(['first_name' => $input[0],
                          'last_name' => $input[1],
                          'mobile_no'=> $input[2],
                          'email'=>$input[3],
                          'address'=> $input[4] ]);
                 $employees = DB::table('employees')
                     ->where('id', '=', $data->id)
                     ->get();
                Session::put('user',$employees[0]);                
            }
            Session::put('toast','Profile is edited successfully');
            return redirect('profile');
        }
    }
     /**
     * shows the page for changing password
     * two kind of pages for password changing.one for patient and another for employees.
     * 
     * @return redirect to profile.
     */
    public function changePassword2(Request $request)
    {
        if (Session::has('user')) {
            $data  = Session::get('user');
            $check  = property_exists($data, 'designation');
            

            if ($request->password1 != $data->password)
                    return redirect('changePassword')->withErrors('Old Password does not match');
            $validator = Validator::make($request->all(),[
                    'password'=>'required',
                    'password_retype' =>'required|same:password',]);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return Redirect::to('/changePassword')
                        ->withErrors($validator);
            }   
            else{
                if ($check == 0){   
                DB::table('patients')->where('id', $data->id)
                    ->update(['password' => $request->password ]);
                 $employees = DB::table('patients')
                     ->where('id', '=', $data->id)
                     ->get();
                Session::put('user',$employees[0]);
                }
                elseif ($check == 1){
                    DB::table('employees')->where('id', $data->id)
                    ->update(['password' => $request->password ]);
                     $employees = DB::table('employees')
                     ->where('id', '=', $data->id)
                     ->get();

                Session::put('user',$employees[0]);                
                }
            }
            Session::put('toast','Password is changed successfully');
            return redirect('profile');
        }
    }
    
}
