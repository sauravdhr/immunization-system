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
* This controller class handles the admin's part of the job.Admin's part includes-
* approving temporary employees,deleting campaigns and vaccine entries.
* 
*
*/
class AdminController extends Controller
{



    /**
     * loads the first page of approve employee.It contains the temporary employee accounts
     * ready to be approved or denied.
     *  
     * @return view of the first page of approving employee
     */

   public function approveEmployee(){
        $temp1 = DB::select('select * from temp_employees');
        
        if (Session::has('toast')){
          $temp2 = Session::get('toast');
          Session::forget('toast');
        }
        else 
          $temp2 = null;

        
        $temp = array($temp1,$temp2);
        return view('admin.approveEmployee')->withTemp($temp);
   }
   /**
     * takes the emp-no of the temporary employee and sends the details of temporary 
     * employee to the next page via storing and restoring from the session.
     *
     * @param employee number from the temp_employee table
     * @return redirect to the 2nd page of approving employees.
     */

   public function approveEmployee2($emp_no){
        
        $temp = DB::select('select * from temp_employees
            where emp_no = :somevariable',array('somevariable' => $emp_no ));
        Session::put('approve',$temp[0]);
        return Redirect::to('approveEmployee2');
   }
    /**
     * gets the 2nd page of approving employee where the details of the 
     * employee is displayed alongside the option of whether approve or denying
     * the employee.
     *
     * @return view of the 2nd page of approving employee
     */

   public function approveEmployee3(){
        $data = Session::get('approve');
        if ($data == null) return redirect('/');
        return view('admin.approveEmployee2')->withData($data);
   }
    /**
     * handles the approving of the employee
     *
     * @param  request that is used just for the approve button
     * @return  redirect to the first page of approving employee
     */

   public function approveEmployee4(Request $request){
        $data = Session::get('approve');
        $empno = $data->emp_no;
        DB::table('temp_employees')->
            where('emp_no', '=', $empno)->delete();

        $employee = new Employee;
        $employee->id           = $data->id;
        $employee->email        = $data->email;
        $employee->password     = $data->password;
        $employee->first_name   = $data->first_name;
        $employee->last_name    = $data->last_name;
        $employee->gender       = $data->gender;
        $employee->designation  = $data->designation;
        $employee->email        = $data->email;
        $employee->address      = $data->address;
        $employee->mobile_no    = $data->mobile_no;
        $employee->save();
        Session::put('toast','temporary employee is approved successfully');
        return Redirect::to('approveEmployee');

   }

    /**
     * handles the denying part of the employee
     *
     * @param takes the employee number
     * @return redirect to the first page of approving employee
     */

   public function approveEmployee5($emp_no){
        $data = Session::get('approve');
        DB::table('temp_employees')->
            where('emp_no', '=', $emp_no)->delete();
        Session::put('toast','temporary employee is disapproved successfully');
        return Redirect::to('approveEmployee');
   }

   /**
     * loads the first page of deleting campaign.it shows all the campaigns
     *
     *   
     * @return view page of first page of deleting campaigns.
     */

   public function deleteCampaign(){

      $temp1 = DB::select('select * from campaigns');
        
      if (Session::has('toast')){
        $temp2 = Session::get('toast');
        Session::forget('toast');
      }
      else 
        $temp2 = null;

      $temp = array($temp1,$temp2);
      return view('admin.deleteCampaign')->withTemp($temp);

   }

    /**
     * takes the campaign no and sends the details of the campaigns to the next page.
     * stores the details into the session only to be picked up later by the next page. 
     *
     * @param  campaign no 
     * @return redirect to the 2nd page of campaign deleting
     */

   public function deleteCampaign2($campaign_no){
      $temp = DB::table('campaigns')
                     ->where('campaign_no', '=', $campaign_no)
                     ->get();

        $temp2 = DB::select('select A.* from centers as A,campaigncenters as B
            where B.campaign_no = :somevariable 
            and A.center_no = B.center_no',array('somevariable'=> $campaign_no));
        
        $data = array($temp,$temp2);
        Session::put('data',$data);
        return Redirect::to('/deleteCampaign2');
   }

    /**
     * loads the 2nd page of deleting campaign deleting.
     * takes the details of campaign from the session and shows it into the view
     *
     * @param campaign no 
     * @return redirect to the 2nd page of campaign deleting
     */

   public function deleteCampaign3(){
        $data = Session::get('data');
        return view('admin.deleteCampaign2')->withData($data);
    }

    /**
     * deletes the campaign.also deletes the associated data from campaigncenters
     * and events table.it is necessary to delete the campaign entirely.
     *
     * @param  request that is just used for the button
     * @return redirect to the 1st page of campaign deleting
     */

    public function deleteCampaign4(Request $request){
        
        $data = Session::get('data');
        $campaign_no = $data[0][0]->campaign_no;
        $temp = DB::select('select cc_no from campaigncenters where
          campaign_no = :somevariable',array('somevariable' => $campaign_no));
        
        foreach ($temp as $line){
          $a = $line->cc_no;
          $tem = DB::table('events')->
          where('cc_no', '=', $a)->delete();
        }
        DB::table('campaigncenters')->
        where('campaign_no', '=', $campaign_no)->delete();

        DB::table('campaigns')->
        where('campaign_no', '=', $campaign_no)->delete();

        var_dump(array($campaign_no,$temp));

        Session::put('toast','Campaign deleted successfully.');
        return Redirect::to('deleteCampaign');
    } 
    /**
     * loads the first page of vaccine delete. It shows all the entries. The admin
     * has to choose one entry among all.
     *
     * 
     * @return view page of 1st page of vaccine delete.
     */

    public function deleteVaccine(){
      $temp1 = DB::select('select * from vaccines');
        
      if (Session::has('toast')){
        $temp2 = Session::get('toast');
        Session::forget('toast');
      }
      else 
        $temp2 = null;
        
      $temp = array($temp1,$temp2);
      return view('admin.deleteVaccine')->withTemp($temp);
    }
    /**
     * takes the vaccine no, gets the vaccine details from the database and 
     * saves it into the session for the next page to pick
     *
     * @param  vaccine no: vaccine entry number in the table.
     * @return redirect to the 2nd page of vaccine delete.
     */

    public function deleteVaccine2($vaccineno){
      $temp1 = DB::select('select * from vaccines where vaccine_no = :somevariable'
        ,array('somevariable' => $vaccineno));
      $temp = $temp1[0];
      Session::put('data',$temp);
      return Redirect::to('deleteVaccine2');
    }

    /**
     * loads the 2nd page of vaccine delete.
     * picks the details of vaccine data entry from the session and sends it to the view.   
     *
     *  
     * @return view page of the 2nd page of vaccine delete.
     */

    public function deleteVaccine3(){
      $temp = Session::get('data');
      return view('admin.deleteVaccine2')->withTemp($temp);
    }

    /**
     * deletes the selected vaccine entry from the database.
     *
     * @param  request: only used for the delete button
     * @return redirect to the 1st page of vaccine delete.
     */

    
    public function deleteVaccine4(Request $request){
      $temp = Session::get('data');
      $vaccineno = $temp->vaccine_no;

      DB::table('vaccines')->
            where('vaccine_no', '=', $vaccineno)->delete();

      Session::put('toast','Vaccine entry deleted successfully.');
      return Redirect::to('deleteVaccine');

    }

}
