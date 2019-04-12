<?php

namespace App\Http\Controllers;

use App\Models\Opskrift;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Redirect;
use DB;


class OpskriftController extends Controller
{
    /**
     * Display a listing of the resource sorted by navn.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $opskrifter = Opskrift::orderBy('navn')->get();
      return view('opskrifter.index', compact('opskrifter'));

      // Carbon::parse('2012-9-5 23:26:11.223', 'Europe/Paris')->timezone->getName();
    }

    /**
     * Display a listing of the resource sorted by time.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_time_sort()
    {
      $opskrifter = Opskrift::orderBy('tid')->get();
      return view('opskrifter.index', compact('opskrifter'));

      // Carbon::parse('2012-9-5 23:26:11.223', 'Europe/Paris')->timezone->getName();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('opskrifter.create', compact('opskrifter'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
          'navn' => 'required|string|max:32',
          'tid' => 'required|date_format:H:i',
          'beskrivelse' => 'required|string',
          'ingr' => 'required|array|min:1',
          'ingr.*' => 'required|string|distinct|max:32',
          'qt' => 'required|array|min:1',
          'qt.*' => 'required|integer|min:1',
          'enhed' => 'required|array',
          'enhed.*' => 'required|string',
        ]);


        $input = Input::all();
        $o_navn = $input['navn'];

        DB::beginTransaction();

        $o_id = DB::table('opskrift')->insertGetId(
            ['navn' => $input['navn'], 'tid' => $input['tid'], 'beskrivelse' => $input['beskrivelse']]
        );

        function checkIfExist($name){
          try {
            $i_id = DB::table('ingrediens')
                          ->where('ingrediens.navn', 'LIKE', $name)
                          ->select('id')
                          ->get();
          }
          catch (\Exception $e) {
              $i_id = 0;
          }
          finally {
              return $i_id;
          }
        }
        foreach ($input['ingr'] as $ingName) {
          $count = array_search($ingName, $input['ingr']);   // index, in arr, being processed.

          $i_id = checkIfExist($ingName);           // Check ingrediense inputs
          try {
            if (count($i_id)>0) {
              DB::table('relation')->insert(
                  [ 'o_id' => $o_id, 'i_id' => $i_id[0]->id, 'qt' => $input['qt'][$count] ]
              );
            } else {
              $i_id = DB::table('ingrediens')->insertGetId(
                  [ 'navn' => $ingName, 'enhed' => $input['enhed'][$count] ]
              );
              DB::table('relation')->insert(
                  [ 'o_id' => $o_id, 'i_id' => $i_id, 'qt' => $input['qt'][$count] ]
              );
            }
          } catch (\Exception $e) {
            DB::rollBack();
          }
        }
        DB::commit();
        return view('opskrifter.receipt', compact('o_id', 'o_navn', 'input'))->with('message', ' er blevet oprettet nuuuuu!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Opskrift  $opskrifter
     * @return \Illuminate\Http\Response
     */
    public function show(Opskrift $opskrifter)
    {
      $opskriften = DB::table('relation')
          ->join( 'opskrift', 'o_id', '=', 'opskrift.id' )
          ->join( 'ingrediens', 'i_id', '=', 'ingrediens.id' )
          ->select( 'relation.qt', 'opskrift.id', 'opskrift.navn as o_navn', 'opskrift.tid', 'opskrift.beskrivelse', 'ingrediens.navn as i_navn', 'ingrediens.enhed' )
          ->where( 'opskrift.id', '=', $opskrifter->id )
          ->get();

      $beskrivelse = preg_split('/[0-9]+/', $opskriften[0]->beskrivelse, null, PREG_PATTERN_ORDER);

      return view('opskrifter.show', compact('opskriften', 'beskrivelse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Opskrift  $opskrifter
     * @return \Illuminate\Http\Response
     */
    public function edit(Opskrift $opskrifter)
    {
      $opskriften = DB::table('relation')
          ->join( 'opskrift', 'o_id', '=', 'opskrift.id' )
          ->join( 'ingrediens', 'i_id', '=', 'ingrediens.id' )
          ->select( 'relation.qt', 'relation.o_id', 'relation.i_id', 'opskrift.navn as o_navn', 'opskrift.tid', 'opskrift.beskrivelse', 'ingrediens.navn as i_navn', 'ingrediens.enhed' )
          ->where( 'opskrift.id', '=', $opskrifter->id )
          ->get();

        return view('opskrifter.edit', compact('opskrifter', 'opskriften'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Opskrift  $opskrifter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Opskrift $opskrifter)
    {
        $input = Input::all();
        $o_id = $opskrifter->id;
        $o_navn = $input['navn'];

        DB::beginTransaction();

        DB::table('opskrift')
            ->where('id', $o_id)
            ->update(['navn' => $input['navn'], 'tid' => $input['tid'],'beskrivelse' => $input['beskrivelse']]);

            function checkIfExist($name){
              try {
                $i_id = DB::table('ingrediens')
                              ->where('ingrediens.navn', 'LIKE', $name)
                              ->select('id')
                              ->get();
              }
              catch (\Exception $e) {
                  $i_id = 0;
              }
              finally {
                  return $i_id;
              }
            }
            foreach ($input['ingr'] as $ingName) {
              $count = array_search($ingName, $input['ingr']);   // index, in arr, being processed.

              $i_id = checkIfExist($ingName);                    // Check ingrediense inputs
              try {
                if (count($i_id)>0) {

                  DB::table('relation')
                    ->updateOrInsert(
                        ['o_id' => $o_id, 'i_id' => $input['i_id'][$count]],
                        [ 'i_id' => $i_id[0]->id, 'qt' => $input['qt'][$count] ]
                    );

                } else {

                  $i_id = DB::table('ingrediens')->insertGetId(
                      [ 'navn' => $ingName, 'enhed' => $input['enhed'][$count] ]
                  );
                  DB::table('relation')
                    ->updateOrInsert(
                        ['o_id' => $o_id, 'i_id' => $input['i_id'][$count]],
                        [ 'i_id' => $i_id[0]->id, 'qt' => $input['qt'][$count] ]
                    );
                }
              } catch (\Exception $e) {
                DB::rollBack();
              }
            }

            // handle new added ingredience

            $oldIngrArr = DB::table('relation')
                ->select( 'relation.o_id', 'relation.i_id')
                ->where( 'relation.o_id', '=', $opskrifter->id )
                ->get();

            if (count($input['ingr']) > count($oldIngrArr)) {
              $aon = count($input['ingr']) - count($oldIngrArr);               // amount of new ingredience
              for ($i= (count($input['ingr'])-$aon); $i < count($input['ingr']); $i++) {
                $i_id = checkIfExist($input['ingr'][$i]);

                try {
                  if (count($i_id)>0) {
                    DB::table('relation')->insert(
                        [ 'o_id' => $o_id, 'i_id' => $i_id[0]->id, 'qt' => $input['qt'][$i] ]
                    );
                  } else {
                    $i_id = DB::table('ingrediens')->insertGetId(
                        [ 'navn' => $input['ingr'][$i], 'enhed' => $input['enhed'][$i] ]
                    );
                    DB::table('relation')->insert(
                        [ 'o_id' => $o_id, 'i_id' => $i_id, 'qt' => $input['qt'][$i] ]
                    );
                  }
                } catch (\Exception $e) {
                  DB::rollBack();
                }
              }
            }

        DB::commit();

        return view('opskrifter.receipt', compact('o_id', 'o_navn', 'input'))->with('message', ' er blevet opdateret nuuuuu!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Opskrift  $opskrifter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Opskrift $opskrifter)
    {
      DB::table('relation')
        ->where('o_id', '=', $opskrifter->id)
        ->delete();

      $opskrifter->delete();

      return Redirect::route('opskrifter.index')->with('message', 'Opskrift slettet.');
    }
}
