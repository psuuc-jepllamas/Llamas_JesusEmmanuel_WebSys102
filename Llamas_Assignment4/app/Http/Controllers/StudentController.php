<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function insertform(){
        return view('stud_create');
    }

    public function insert(Request $request){
        $name = $request -> input('stud_name');
        DB::insert('insert into student (name) values(?)', [$name]);
        return redirect('/view-records');
    }

    public function index(){
        $users = DB::select("select * from student");
        return view('stud_view', ['users'=>$users]);
    }

    public function show($id){
        $users = DB::select("select * from student where id = ?",[$id]);
        return view('stud_update', ['users'=>$users]);
    }

    public function edit(Request $request, $id){
        $name = $request->input('stud_name');
        DB::update('update student set name = ? where id = ?', [$name, $id]);
        return redirect('/view-records');
    }

    public function indexDelete(){
        $users = DB::select('select * from student');
        return view('stud_delete_view',['users'=>$users]);
    }

    public function destroy($id){
        DB::delete('delete from student where id = ?',[$id]);
        return redirect('/view-records');
    }
}
