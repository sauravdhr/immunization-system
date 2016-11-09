<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Patient;
use App\VaccRecord;
use App\CampaignCenter;
use App\Campaign;
use App\Notification;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use DB;
use Auth;
use Validator, Input, Redirect;
use Session;

/**
* handles the chief health officer's part.It includes creating a campaign,setting centers under 
* that campaign,assign health officer on those centers and send notifications to the patients.
*
*/

class CHOController extends Controller
{
     /**
     * shows the page for creating campaign
     * has a form that takes the necessary info to create a campaign.
     * 
     * @return view to the campaign creating page.
     */
    public function getCreateCampaign()
    {
        if (Session::has('toast')){
        $temp = Session::get('toast');
        Session::forget('toast');
        }
    else $temp = null;
        return view('cho.createCampaign')->withTemp($temp);
    }
     /**
     * shows the page for setting the centers
     * It is the first step.First select the campaign.
     * also we are sending the campaigns to this page.
     * Not all the campaigns.Only those that are created by
     * the logged-on user.
     * 
     * @return view to the set center part 1 page where campaign is to be selected.
     */
    public function getSetCenter()
    {
        $temp3 = DB::table('campaigns')
                     ->where('cho_id', '=', Session::get('user')->id)
                     ->get();

        
         $temp2 = null;
        $temp = array($temp3,$temp2);
        return view('cho.setCenter')->with('temp',$temp);
    }
     /**
     * shows the page for assigning health officer.The first step is selecting the 
     * campaign that the user created.
     * 
     * @return view with the campaigns that the users created.
     */
    public function getAssignHO(){
        $temp1 = DB::table('campaigns')
                     ->where('cho_id', '=', Session::get('user')->id)
                     ->get();
         if (Session::has('toast')){
            $temp2 = Session::get('toast');
            Session::forget('toast');
        }
        else $temp2 = null;
        $temp = array($temp1,$temp2);
        return view('cho.assignHO')->with('temp',$temp);
    }
    /**
     * This is the function that takes the campaign number of the selected campaign
     * and takes user to the next page with the list of centers that are selected
     * under this campaign and assigned health assistant if there is.
     *
     * @return redirect to url that lets the user select the centers.
     */
    public function getAssignHO2($campaign_no){
        $temp2 = DB::select('select B.*,
            (select CONCAT(first_name," ",last_name) 
            from employees where emp_no = A.ho_id) "health_officer" 
            from campaigncenters as A,centers as B
            where B.center_no = A.center_no 
            and
            A.campaign_no = :somevariable',array('somevariable' => $campaign_no));
        $data = $temp2;
        
        Session::put('centers3',$temp2);
        Session::put('cmpgn_id',$campaign_no);

        return Redirect::to('/assignHO2'); 
        
    }
    /**
     * This is the function that takes the center number of the selected center
     * and takes user to the next page with the list of health assistants available
     * are shown and user is allowed to select one of them to assign him to the previously
     * selected center.plus,necessary data such as center no and available health assistans
     * are put into sessions to use in the next page's function.
     *
     * @param center number
     * @return redirect to health assistant selecting page.
     */
    public function getAssignHO4($center_no){
        $cmpgn = Session::get('cmpgn_id');
        $data = DB::select('select emp_no,CONCAT(first_name," ",last_name) 
            "name" from employees where designation = "Health Officer"
            and emp_no not in (select CAST(ho_id AS UNSIGNED) "emp_no" 
                from campaigncenters where campaign_no = :somevariable)',array('somevariable'=>$cmpgn));
        Session::put('cntr',$center_no);
        Session::put('hos',$data);
        return Redirect::to('/assignHO3'); 
    }
    /**
     * gets the page where user selects the health assistants or clears its position of the 
     * assignment.There are one or more available health assistants and user will choose
     * one on this page.
     *
     * @return redirect to health assistant.
     */
    public function getAssignHO5(){
        $temp = Session::get('hos');
        return view('cho.assignHO3')->withTemp($temp);
    }
    /**
     * Takes the selected health assistants emp_no and and assigns him to the 
     * center.An update is made to the database in table campaigncenters 
     * after selection or clearing , takes the user to the list of centers.
     * 
     * 
     *
     * @param emp_id containing the employee number of the selected health assistant
     * @return redirect to the page where list of centers are.
     */
    public function getAssignHO6($emp_id){
        $center_no = Session::get('cntr');
        $campaign_no = Session::get('cmpgn_id');
        DB::update('update campaigncenters set ho_id = :var3 WHERE center_no = :var1
            and campaign_no = :var2',array('var1' => $center_no, 'var2' => $campaign_no , 'var3'=>$emp_id ));

        $temp2 = DB::select('select B.*,
            (select CONCAT(first_name," ",last_name) 
            from employees where emp_no = A.ho_id) "health_officer" 
            from campaigncenters as A,centers as B
            where B.center_no = A.center_no and
            A.campaign_no = :somevariable',array('somevariable' => $campaign_no));

        Session::put('toast','Health Assistant is assigned');
        Session::put('centers3',$temp2);
        return Redirect::to('/assignHO2'); 
    }
    /**
     * this is the page getter. the page shows the centers under the previously selected 
     * campaign are shown in here.
     * 
     *
     * @return redirect to health assistant.
     */
    public function getAssignHO3(){
        $temp1 = Session::get('centers3');
        
        
        if (Session::has('toast')){
            $temp2 = Session::get('toast');
            Session::forget('toast');
        }
        else $temp2 = null;
        
        $data = array($temp1,$temp2);



        return view('cho.assignHO2')->withData($data);

    }
    /**
     * 
     * this function clears the previously selected health assistant in the position of 
     * previously selected center.
     * 
     * 
     *
     * @param request 
     * @return redirect to the page of list of centers under the previously selected campaign
     */
    public function postAssignHO3(Request $request){
        $center_no = Session::get('cntr');
        $campaign_no = Session::get('cmpgn_id');
        $emp_id = '';
        DB::update('update campaigncenters set ho_id = :var3 WHERE center_no = :var1
            and campaign_no = :var2',array('var1' => $center_no, 'var2' => $campaign_no , 'var3'=>$emp_id ));

        $temp2 = DB::select('select B.*,
            (select CONCAT(first_name," ",last_name) 
            from employees where emp_no = A.ho_id) "health_officer" 
            from campaigncenters as A,centers as B
            where B.center_no = A.center_no and
            A.campaign_no = :somevariable',array('somevariable' => $campaign_no));
        Session::put('toast','Previously assigned Health Assistant is removed');
        Session::put('centers3',$temp2);
        return Redirect::to('/assignHO2');
    }
    /**
     * 
     * This function take the campaign number and takes the user to the page
     * where various available centers and selected centers are shown
     * for the user to select under the previously selected center.
     * 
     *
     * @param campaign_no - campaign number
     * @return redirect to the 2nd page of center setting, the list of available and selected centers.
     */
    public function getSetCenter2($campaign_no)
    {
        $temp = DB::select('select * from centers where not exists(select * from 
            campaigncenters where center_no = centers.center_no 
            and campaign_no = :somevariable)',array('somevariable' => $campaign_no));

        $temp2 = DB::select('select * from centers where exists(select * from 
            campaigncenters where center_no = centers.center_no 
            and campaign_no = :somevariable)',array('somevariable' => $campaign_no));

        Session::put('cmpgn_id',$campaign_no);
        Session::put('centers',$temp);
        Session::put('centers2',$temp2);
        return Redirect::to('/setCenter2');        
    }
    /**
     * 
     * acquires the selected and available centers from the previously stored sessions
     * and takes to the view page of center setting .
     * 
     * 
     *
     * @param 
     * @return view page of setting center
     */
    public function getSetCenter21()
    {
        $data=array(Session::get('centers'),Session::get('centers2'));
        return view('cho.setCenter2')->withData($data);        
    }
    /**
     * handles the event after user selects a center from the list of available center.
     * this means the selected center is now in the extracted from the first list and
     * inserted into the second list.first list means the available centers and second 
     * list means the selected centers.
     * 
     *
     * @param center number which makes the transition between the lists
     * @return redirect to the same page 
     */
    public function getSetCenter22($center_no){
        $temp1 = Session::get('centers');
        $temp2 = Session::get('centers2');
        $item = DB::select('select * from centers where center_no = :somevariable',array('somevariable' => $center_no));
        array_push($temp2,$item[0]);
        $item2 = array();

        foreach ($temp1 as $value) {
            if ($value->center_no != $center_no)
               array_push($item2,$value);
        } 
        Session::put('centers',$item2);
        Session::put('centers2',$temp2);
        return Redirect::to('/setCenter2'); 
    }
    /**
     * handles the event after user deselects a center from the list of selected center.
     * this means the selected center is now in the extracted from the second list and
     * inserted into the first list.first list means the available centers and second 
     * list means the selected centers.
     * 
     *
     * @param center number which makes the transition between the lists
     * @return redirect to the same page 
     */
    public function getSetCenter23($center_no){
        $temp1 = Session::get('centers');
        $temp2 = Session::get('centers2');
        $item = DB::select('select * from centers where center_no = :somevariable',array('somevariable' => $center_no));
        array_push($temp1,$item[0]);
        $item2 = array();

        foreach ($temp2 as $value) {
            if ($value->center_no != $center_no)
               array_push($item2,$value);
        } 
        Session::put('centers',$temp1);
        Session::put('centers2',$item2);
        return Redirect::to('/setCenter2'); 
    }
   /**
     * this functions deals the event when user clicks the confirm centers button.
     * It finally deletes the previously selected centers info from the database and
     * inserts new info into the database , mainly table named campaigncenters 
     * 
     * 
     *
     * @param request because a form was used just for the button that confirms
     * @return redirect to the page where first campaign has to be selected to set centers.
     */
    public function postSetCenter2(Request $request){
        $temp = Session::get('centers2');
        $temp2 = DB::table('campaigncenters')->get();
        
        if ( $temp2 != null ){
            $temp3 = DB::table('campaigncenters')->
            where('campaign_no', '=', Session::get('cmpgn_id'))->get();

            foreach ($temp3 as $line){
                $a = $line->cc_no;
                $temp = DB::table('events')->
                where('cc_no', '=', $a)->delete();
            }

            DB::table('campaigncenters')->
            where('campaign_no', '=', Session::get('cmpgn_id'))->delete();

        }
       
          foreach ($temp as $value) {
            $new = new CampaignCenter;
            $new->campaign_no = Session::get('cmpgn_id');
            $new->center_no = $value->center_no;
            $new->save();
            Session::put('toast','center is set successfully. Previous center and its assigned employee information is removed if it had any.Please Reassign them again');
        
          }
        
        return Redirect::to('/setCenter'); 
    }
    /**
     * Does the form validation and inserts data from forms into the database.
     * This is the function where new campaign gets created.
     *
     * @param requset that contains the values of the forms
     * @return to the same page.
     */
    public function postCreateCampaign(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'campaign_name' => 'required',
            'vaccine_name'=>'required',
            'campaign_date'=> 'required|date', 
            'start_age'=>'required|int',
            'end_age'=>'required|int',
        
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('/createCampaign')->withErrors($validator);
         }
         else{
            $cmpgn = array($request->campaign_name,$request->vaccine_name,$request->campaign_date,
                $request->start_age,$request->end_age);

            if ($request->campaign_date != null ){
                $date1 = Carbon::createFromFormat('d/m/Y', $request->campaign_date)->toDateString();
                $temp = DB::select('select * from campaigns where
                campaign_date = :somevariable',array('somevariable'=>$date1));
                
            
                if (count($temp))
                    return redirect('/createCampaign')->withErrors('There is already a campaign on that date');
            
            }
            
            $new = new Campaign;
            $new->campaign_name = $cmpgn[0];
            $new->cho_id = Session::get('user')->id;
            $new->vaccine_name = $cmpgn[1];
            $new->setDate($cmpgn[2]);
            $new->start_age = (int)$cmpgn[3];
            $new->end_age = (int)$cmpgn[4];
            $new->save();

            Session::put('toast','Campaign Created Successfully');
            return Redirect::to('/createCampaign');
            
         }
    }
    /**
     * Shows the page where campaign has to be selected to send a notification
     * to the patients.takes the campaigns created by the user and sends it to 
     * the view page.
     * 
     * 
     * @return view page of notification sending page 1
     */
    public function getNotifications(){
        $temp1 = DB::table('campaigns')
                     ->where('cho_id', '=', Session::get('user')->id)
                     ->get();
        if (Session::has('toast')){
            $temp2 = Session::get('toast');
            Session::forget('toast');
        }
        else $temp2 = null;
        $temp = array($temp1,$temp2);

        return view('cho.sendNotifications')->with('temp',$temp);
    }
    /**
     * This function takes the selected campaign number and takes it to the next page
     * where notification message is created.
     * 
     * 
     * 
     *
     * @param campaign number
     * @return redirect to the 2nd page of sending notification
     */
    public function getNotifications2($campaign_no){
        $temp = DB::table('campaigns')
                     ->where('campaign_no', '=', $campaign_no)
                     ->get();

        $temp2 = DB::select('select A.* from centers as A,campaigncenters as B
            where B.campaign_no = :somevariable 
            and A.center_no = B.center_no',array('somevariable'=> $campaign_no));
        $data = array($temp,$temp2);
        Session::put('data',$data);
        return Redirect::to('/notify2');
    }
    /**
     * this page gets the 2nd page of sending notifications.
     * takes the necessary info from the session that was saved before
     * and sends it to the view page.
     * 
     * @return sends view of the 2nd page
     */
    public function getNotifications3(){
        $data = Session::get('data');
        return view('cho.sendNotifications2')->withData($data);
    }
    /**
     * This function creates the notification.It handles the part when the user has
     * created the notification,after the click of send notification button.It first 
     * validate the text area and pushes the data into database in table named
     * notifications table
     * 
     *
     * @param request containing the message
     * @return redirect to the 1st page of notification sending page.
     */
    public function getNotifications4(Request $request){
       $data = Session::get('data');
       $campaign = $data[0][0]->campaign_no;
       $validator = Validator::make($request->all(),[
            'noti' => 'required',
        ]);
       if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('/notify2')->withErrors($validator);
         }
        else{
            $time2 = Carbon::now()->addHours(6)->toDateTimeString();
            $new = new Notification;
            $new->campaign_no = $campaign;
            $new->msg = $request->noti;
            $new->msg_date = $time2;
            $new->save();
            Session::put('toast','notification created successfully');
            return Redirect::to('/notify');
        }
        
    }
}
