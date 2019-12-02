<?php

namespace App\Http\Controllers\Entries;

use App\Entries;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Abraham\TwitterOAuth\TwitterOAuth;

class EntriesController extends Controller
{
    public function index()
    {
        //Top 3 by User
        $entries = User:: join(DB::raw("(SELECT idUser,title,content,creation_date
                                        FROM
                                        (SELECT idUser, title , content,creation_date, 
                                            @idUser_rank := IF(@current_iduser = idUser, @idUser_rank + 1, 1) AS idUser_rank,
                                            @current_iduser := idUser 
                                            FROM entries
                                            ORDER BY idUser,creation_date DESC
                                        ) ranked
                                        WHERE idUser_rank <= 3) AS topentries") ,'topentries.idUser','users.id')
                        ->paginate(2);
        return view('entries/index', ['entries' => $entries]);
    }

    public function create()
    {
        return view('entries.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idUser' => ['required', 'string', 'max:255'],
                'title' => ['required', 'string', 'max:255'],
                'content' => ['required', 'string','string', 'max:255']
            ]);
    
            $entryCreated = Entries::create([
                'idUser' => $request->idUser,
                'title' => $request->title,
                'content' => $request->content,
            ]);

            return back()->with("created","Post created successfully");

        } catch (\Throwable $th) {
            return back()->with("error","Something was worng contact your admin");
        }
        
        
    }

    public function edit( $id)
    {
        $entry = Entries::where('id', $id)->firstOrFail();
        return view('entries.edit',['entry' => $entry]);
    }

    public function update(Request $request){

        try {
            $request->validate([
                'idEntry' => ['required', 'string', 'max:255'],
                'idUser' => ['required', 'string', 'max:255'],
                'title' => ['required', 'string', 'max:255'],
                'content' => ['required', 'string','string', 'max:255']
            ]);
    
            $updatedRow = Entries::where('id',$request->idEntry)
            ->update(["title"=>$request->title,"content"=>$request->content]);
    
            if($updatedRow>0)
                return back()->with('updated','Entry updated successfully');
            else if($updatedRow == 0)
                return back()->with('warning','Entry not exist');
        } catch (\Throwable $th) {
            return back()->with('error','Something was worng contact your admin');
        }
        
    }
}
