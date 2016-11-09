<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Patient;
use App\VaccRecord;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use DB;
use Auth;
use Validator, Input, Redirect;
use Session;

/**
* Handles the Health Assistant's part.It includes registering patients, adding patient's 
* vaccination history,updating the existing vaccination history and update vaccine entry.
*/

class HAController extends Controller
{
    /**
     * Shows the page where the patient can be registered.
     * It contains the form.also supporst the toast to notify
     * the user.
     * 
     * @return view of the patient registering page.
     */
    public function getRegPatient()
    {
        
        if (Session::has('toast')){
           $temp = Session::get('toast');
           Session::forget('toast');
        }
        else 
            $temp = null;
        return view('ha.regpatient')->withTemp($temp);
    }
    /**
     * loads the first page where patient id is needed to insert a vaccination history entry
     * of that patient
     * 
     * 
     * @return view to the first page of add patients vaccination history.
     */
    public function getUpdatePatient()
    {
        //
        return view('ha.updatepatient');
    }
    /**
     * loads the 2nd page where patient's id,name and previous vaccination history,if
     * exists is shown and a form to add new vaccination history.
     * 
     * 
     *  
     * @return view to the 2nd page of adding of vaccination history  of the patient.  
     */
    public function getUpdatePatient2()
    {
        //
        $patient = Session::get('patient');
        $history = DB::table('vacc_record')
                     ->where('patient_id', '=', $patient->id)
                     ->get();

        if (count($history)){
            foreach ($history as $value) {
                $temp2 = DB::table('employees')
                     ->where('id', '=', $value->healthasst_id)
                     ->get();
                $temp3 = $temp2[0]->first_name." ".$temp2[0]->last_name;
                $value->healthasst_id = $temp3;;
            }
        }

        if (Session::has('toast')){
           $temp2 = Session::get('toast');
           Session::forget('toast');
        }
        else 
            $temp2 = null;



        $data = array($patient->id,$patient->first_name." ".$patient->last_name,$history,$temp2);
        return view('ha.updatepatient2')->withData($data);
    }

    /**
     * registers the patient after clicking the register button.
     * first validates the form. Then creates a new patient and 
     * enters it into the patients database.
     * 
     * 
     *
     * @param request.It contains the values that are typed into the forms.
     * @return redirect to the same page.
     */
    public function postRegPatient(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'id' => 'required|unique:patients,id',
            'password'=>'required',
            'password_retype' =>'required|same:password',
            'first_name'=>'required',
            'last_name'=>'required',
            'father_name'=>'required',
            'mother_name'=>'required',
            'mobile_no'=>'required',
            'address'=>'required',
            'date_of_birth'=> 'required',       // required and has to match the password field
        ]);
        if ($validator->fails()) {

            // get the error messages from the validator
            $messages = $validator->messages();
            // redirect our user back to the form with the errors from the validator
            return Redirect::to('/registerpatient')->withErrors($validator);
         }
         else{
            $employee = new Patient;
            $employee->id           = $request->id;
            $employee->password     = $request->password;
            $employee->first_name   = $request->first_name;
            $employee->last_name    = $request->last_name;
            $employee->father_name  = $request->father_name;
            $employee->mother_name  = $request->mother_name;
            $employee->gender       = $request->gender;
            $employee->setDobAttribute($request->date_of_birth);
            $employee->address      = $request->address;
            $employee->mobile_no    = $request->mobile_no;

            $employee->save();
            Session::put('toast','Patient is registered successfully.');
            return Redirect::to('/registerpatient');
    }
    }

    /**
     * this function checks the given patient's id and see whether it is valid.
     * if it is not returns error message to the same page.
     * if id matches, then patient info is saved and user is taken to the next page.
     *
     * @param request which contains the patient's id 
     * @return redirect to the 
     */
    public function postUpdatePatient(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('/updatepatient')->withErrors($validator);
         }
         $patients  = DB::table('patients')
                     ->where('id', '=', $request->id)
                     ->get();

        if (count($patients) == 0)
            return Redirect::to('/updatepatient')->withErrors('There is no patient matching that ID');
        
        if (count($patients)){
            $updatingPatient = $patients[0];
            Session::put('patient',$updatingPatient);
            return Redirect::to('/updatepatient2');
        }


    }

    /**
     * this function adds the patient's new vaccination history.
     * At first the form is validated. Then into the vacchistory table
     * patient's vaccination history is added.
     *
     * @param  request containing the vaccination history
     * @return redirect to the same page
     */
    
    public function postUpdatePatient2(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'vaccine'=>'required',
            'CenterName'=>'required',
            'vaccine_date'=> 'required|date',       // required and has to match the password field
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('/updatepatient2')->withErrors($validator);
         }
         else {
         $record = new VaccRecord;
         $record->patient_id = Session::get('patient')->id;
         $record->healthasst_id = Session::get('user')->id;
         $record->center = $request->CenterName;
         $record->setDate($request->vaccine_date);
         $record->vaccine = $request->vaccine;
         $record->save();
         Session::put('toast','patient\'s vaccine history is added' );
        return Redirect::to('/updatepatient2');
        }

    } 
    /**
     * loads the page where vaccine is selected from the list of vaccines entries.
     * It shows all the entries of vaccine inventory.Among them,one has to be selected.
     *
     *   
     * @return view of the 1st page of update vaccine.
     */
    public function updatevaccine(){

        if (Session::has('user') == false ){
            return Redirect::to('/');
        }
        
        $temp1 = DB::select('select vaccine_no,vaccine_name,inventory_name,total_vials,
        available_vials,manufacturer,DATE_FORMAT(mfg_date, "%d-%m-%Y") as "mfg_date",DATE_FORMAT(exp_date, "%d-%m-%Y") as "exp_date"
        ,vfc from vaccines');
        

        if (Session::has('toast')){
            $temp2 = Session::get('toast');
            Session::forget('toast');
        }
        else 
            $temp2 = null;

        $temp = array($temp1,$temp2);
        return view('ha.updateVaccine')->withTemp($temp);
        
        
    }
    /**
     * this function takes the selected vaccine entry's vaccine no and takes the detailed info
     * of that entry to the next page 
     *
     * @param  vaccineno - entry no of the vaccine entry.
     * @return redirect to the vaccine entry update's second update.
     */
    public function updatevaccine2($vaccineno){
        $temp = DB::select('select vaccine_no,vaccine_name,inventory_name,total_vials,
        available_vials,manufacturer,DATE_FORMAT(mfg_date, "%d/%m/%Y") as "mfg_date",DATE_FORMAT(exp_date, "%d/%m/%Y") as "exp_date"
        ,vfc from vaccines where vaccine_no = :somevariable',array('somevariable'=>$vaccineno));
        Session::put('vaccine2',$temp);
        return Redirect::to('/updatevaccine2');
    }
    /**
     * loads the 2nd page of vaccine update.acquires the vaccine entry details from the 
     * sessions and loads the forms with the existing data of the vaccine entry.
     * 
     *
     * @return view of the 2nd page. 
     */
    public function updatevaccine3(){

         if (Session::has('user') == false ){
            return Redirect::to('/');
        }

        $data2 = Session::get('vaccine2');
        $data = $data2[0];
        return view('ha.updateVaccine2')->withData($data);
    }

    /**
     * updates the new available and total vial number into the database
     * at first validate the form. then updates into the database.
     *
     * @param  request that contains the data to update
     * @return redirect to update vaccine's first page
     */

    public function updatevaccine4(Request $request){
        if ( $request->total_vials != null )
            $value = $request->total_vials;

        $validator = Validator::make($request->all(),[
            'total_vials'=> 'required|int', 
            'available_vials'=>"required|int|between:0,$value",
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('/updatevaccine2')->withErrors($validator);
         }
         else{
            
            $data = Session::get('vaccine2');
            $vaccineno = $data[0]->vaccine_no;
            DB::select("update vaccines
                set total_vials = $request->total_vials , 
                available_vials = $request->available_vials
                where vaccine_no = $vaccineno");
            Session::put('toast','Vaccine entry is successfully updated');
            return Redirect::to('/updatevaccine');

        }
    }
    /**
     * get the page where the patient's vaccination history that are added before.
     * 
     * 
     * @return view to the edit patient's vaccination history editing page
     */
    public function editPatient(){
        return view('ha.updatepatient3');
    }
    /**
     * this function checks the given patient's id and see whether it is valid.
     * if it is not returns error message to the same page.
     * if id matches, then patient info is saved and user is taken to the next page.
     *
     *
     * @param  request that contains the id.
     * @return returns to the 2nd page of patient's vaccination history editing page
     */
    public function editPatient2(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('/updatepatient')->withErrors($validator);
         }
         $patients  = DB::table('patients')
                     ->where('id', '=', $request->id)
                     ->get();

        if (count($patients) == 0)
            return Redirect::to('/updatepatient')->withErrors('There is no patient matching that ID');
        
        if (count($patients)){
            $updatingPatient = $patients[0];
            Session::put('patient',$updatingPatient);
            return Redirect::to('/editpatient2');
        }
    }
    /**
     * load the page where patient's existing vaccination history entry can be edited.
     * forms contain the old values.there are one or more entries for a single patient.
     * one has to be chosen.
     *
     * 
     * @return view page for the 2nd page of updating patient's vaccination history.
     */
    public function editPatient3(){
         $patient = Session::get('patient');
         $pid = $patient->id;
          $history = DB::select('SELECT `record_no`, `patient_id`, `healthasst_id`, `center`, DATE_FORMAT(vacc_date, \'%d-%m-%Y\') as "vacc_date",
           `vaccine` FROM `vacc_record` WHERE patient_id = :somevariable ',array('somevariable'=>$pid));
        
        if (count($history)){
            foreach ($history as $value) {
                $temp2 = DB::table('employees')
                     ->where('id', '=', $value->healthasst_id)
                     ->get();
                $temp3 = $temp2[0]->first_name." ".$temp2[0]->last_name;
                $value->healthasst_id = $temp3;;
            }
        }

        if (Session::has('toast')){
           $temp2 = Session::get('toast');
           Session::forget('toast');
        }
        else 
            $temp2 = null;

        $data = array($patient->id,$patient->first_name." ".$patient->last_name,$history,$temp2);
        return view('ha.updatepatient4')->withData($data);
    }
    /**
     * takes the record no of the vaccination history and takes the vaccination history entry 
     * to the 3rd page. It stores the data into session.
     *
     * @param  recordno - record no 
     * @return redirect to the 3rd page of updating patient's vaccination history.
     */
    public function editPatient4($recordno){
        $history = DB::select('SELECT `record_no`, `patient_id`, `healthasst_id`, `center`, DATE_FORMAT(vacc_date, \'%d/%m/%Y\') as "vacc_date",
           `vaccine` FROM `vacc_record` WHERE record_no = :somevariable ',array('somevariable'=>$recordno));
        $data = $history[0];
        Session::put('history2',$data);
        return Redirect::to('/editpatient3');
        
    }
    /**
     * take the vaccination history data from the session and sends it to the
     * view to load the page.
     * 
     * @return view page of 3rd page of updating patient's vaccination history.
     */

    public function editPatient5(){
        $data = Session::get('history2');
        return view('ha.updatepatient5')->withData($data);
    }

    /**
     * this updates the existing vaccination history of the patient.At first it validates
     * the forms.Then it updates the new value into the database (vacchistory) table.
     *
     * @param request that contains the values of the forms 
     * @return redirect to the 2nd page of updating patient's vaccination history.
     */

    public function editPatient6(Request $request){
         $validator = Validator::make($request->all(),[
            'vaccine'=>'required',
            'CenterName'=>'required',
            'vaccine_date'=> 'required|date',       
        ]);
         if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('/editpatient3')->withErrors($validator);
         }
         else {
            $ha = Session::get('user')->id;
            $patient = Session::get('patient')->id;
            $record = Session::get('history2')->record_no;
            $date1 = Carbon::createFromFormat('d/m/Y', $request->vaccine_date); 
             
             DB::select("update vacc_record
                set center = '$request->CenterName' , 
                vacc_date = '$date1' ,
                vaccine = '$request->vaccine' ,
                patient_id = '$patient' ,
                healthasst_id = '$ha'
                where record_no = $record");

            Session::put('toast','Patient\'s vaccine history is updated.');
            return Redirect::to('/editpatient2');

    }
}
    

    

}
