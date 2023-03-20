<?php

namespace App\Http\Controllers;

use App\Models\Juchu;
use Illuminate\Http\Request;
use App\Models\Bunbougu;
use App\Models\Kyakusaki;

class JuchuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $juchus = Juchu::latest()->paginate(5);
        $juchus = Juchu::select([
            'j.id',
            'j.kyakusaki_id',
            'j.bunbougu_id',
            'j.kosu',
            'j.joutai',
            'j.user_id',
            'k.name as kyakusaki_name',
            'b.name as bunbougu_name',
            'u.name as user_name',
            'g.name as joutai',
            ])
            ->from('juchus as j')
            ->join('kyakusakis as k', function($join) {
            $join->on('j.kyakusaki_id', '=', 'k.id');
            })
            ->join('bunbougus as b', function($join) {
            $join->on('j.bunbougu_id', '=', 'b.id');
            })
            ->join('users as u', function($join) {
            $join->on('j.user_id', '=', 'u.id');
            })
            ->join('joutais as g', function($join) {
            $join->on('j.joutai', '=', 'g.id');
            })
            ->orderBy('j.id', 'DESC')
            ->paginate(5);
            
        if(isset(\Auth::user()->name)){
            return view('juchu.index',compact('juchus'))->with('i', (request()->input('page', 1) - 1) * 5)->with('user_name',\Auth::user()->name);
        }else{
            return view('juchu.index',compact('juchus'))->with('i', (request()->input('page', 1) - 1) * 5)->with('user_name',null);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $bunbougus = Bunbougu::all();
        $kyakusakis = Kyakusaki::all();

        return view('juchu.create')->with('bunbougus',$bunbougus)->with('kyakusakis',$kyakusakis);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'kyakusaki_id' => 'required|integer',
            'bunbougu_id' => 'required|integer',
            'kosu' => 'required|integer|min:1|max:12',
            ]);
            $juchu = new Juchu;
            $juchu->kyakusaki_id = $request->input(["kyakusaki_id"]);
            $juchu->bunbougu_id = $request->input(["bunbougu_id"]);
            $juchu->kosu = $request->input(["kosu"]);
            $juchu->joutai = 1;
            $juchu->user_id = \Auth::user()->id;
            $juchu->save();
            return redirect()->route('juchus.index')
            ->with('success','受注登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Juchu  $juchu
     * @return \Illuminate\Http\Response
     */
    public function show(Juchu $juchu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Juchu  $juchu
     * @return \Illuminate\Http\Response
     */
    public function edit(Juchu $juchu)
    {
        //
        $bunbougus = Bunbougu::all();
        $kyakusakis = Kyakusaki::all();
        return view('juchu.edit',compact('juchu'))->with('bunbougus',$bunbougus)->with('kyakusakis',$kyakusakis);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Juchu  $juchu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Juchu $juchu)
    {
        //
        $request->validate([
            'kyakusaki_id' => 'required|integer',
            'bunbougu_id' => 'required|integer',
            'kosu' => 'required|integer|min:1|max:12',
            ]);
            $juchu->kyakusaki_id = $request->input(["kyakusaki_id"]);
            $juchu->bunbougu_id = $request->input(["bunbougu_id"]);
            $juchu->kosu = $request->input(["kosu"]);
            $juchu->joutai = 1;
            $juchu->user_id = \Auth::user()->id;
            $juchu->save();
            
        return redirect()->route('juchus.index')->with('success','受注入力を変更しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Juchu  $juchu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Juchu $juchu)
    {
        //
        $juchu->delete();
        return redirect()->route('juchus.index')->with('success','受注ID'.$juchu->id.'を削除しました');
    }
}
