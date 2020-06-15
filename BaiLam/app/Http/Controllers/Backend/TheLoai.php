<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ViewBag;
class TheLoai extends Controller
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    private function soanHTML($ele , $mode){

        
       $html = "";
        if($mode == 1 ){
        $html = "
        <ul class= \"theLoai nav nav-bar\">
            <li class=\" font-muli nav-item\" id = \"li-{$ele->id}\">
                <label class=\"myRadio\" for=\"theloai-{$ele->id}\">
                    <input value = {$ele->id} type=\"radio\" style=\"display: contents;\" name=\"theLoai\" id=\"theloai-{$ele->id}\">
                    <span class=\"custom-tick\"></span>
                    <span>{$ele->tenTheLoai} </span>
                </label>
                
            </li>
           
        </ul>
      ";
    }
       else if($mode == 2){
        $html = "
        <ul class= \"theLoai nav nav-bar\">
            <li class=\" font-muli nav-item\" id = \"li-{$ele->id}\">
                <label class=\"myRadio\" for=\"theloai-{$ele->id}\">
                    <input  value = {$ele->id} type=\"radio\" style=\"display: contents;\" name=\"theLoai\" id=\"theloai-{$ele->id}\">
                    <span class=\"custom-tick\"></span>
                    <span>{$ele->tenTheLoai} </span>
                </label>";
         
       }else{
           $html = "</li>
           
           </ul>
         ";
       }
      
        return $html;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mang =  \App\Model\theloai::all();
        $pre_parent= 0;
        $parent = 0;
        $count = $mang->count();
        $html = "";
        if($count == 0) 
        return view('backend.page.content.theloai.theloai-create')->with(['html'=>$html]);
        $trangThai =  array();
        $demThe = 0;
        // Khoi tao mang trang thai
        for($i = 0;$i < $count ; $i++)array_push($trangThai, 0);
        $index  = 0;
        

        // echo "Test";
        
       
     
        while($index < $count){
           
            for($i = 0;$i < $count ; $i++){
                 // if ($trangThai[$i] != 0) continue;
                if($trangThai[$i] == 0&& $parent == $mang[$i]->ID_Cha){
                    // Them Vao 
                  
                    $index++;
                    $trangThai[$i] =1;
                    if($mang[$i]->soLuongNode != 0){
                        $temp = $parent;
                        $parent = $mang[$i]->id;
                        $pre_parent = $temp; 
                        $html .= TheLoai::soanHTML($mang[$i],2);
                        $demThe ++;
                    }
                    else{
                       $html .= TheLoai::soanHTML($mang[$i],1);
                    }
                    
                    // echo $mang[$i]->tenTheLoai ."</br>"; 

                }
                if($i == $count-1 && $demThe != 0) {
                       
                    $html .= TheLoai::soanHTML($mang[$i],3); 
                    $demThe -=1;
             }
               
            }

            
            $parent = $pre_parent;
            foreach($mang as $m) {
                if($m->id === $pre_parent) $pre_parent = $m->ID_Cha;
                break;
            }

            
        }
        // print($html);
       
        return view('backend.page.content.theloai.theloai-create')->with(['html'=>$html]);

    }
      

 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $table = new \App\Model\theloai();
         $table->tenTheLoai = $request->get('tenTheLoai');
         $table->mieuTa = $request->mieuTa;
         $table->ID_Cha = $request->theLoai;
         $table->save();
         if($table->ID_Cha != 0){
             $tab = \App\Model\theloai::where('id',$table->ID_Cha)->first();
             $tab->soLuongNode ++;
             $tab->save(); 
         }
        $ob = (object)[
            'tenTheLoai'=>$table->tenTheLoai,
            'id'=>$table->id,
            ];
    

        $html ="";
        $html = TheLoai::soanHTML($ob,1);

        // return view('test')->with(['html',$html]);
      

        

        return \response()->json(
            [
                'yes'=>true,
                'result'=>$html
            ]
            ,200
        );
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
