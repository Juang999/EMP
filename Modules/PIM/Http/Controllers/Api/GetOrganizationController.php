<?php

namespace Modules\PIM\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Traits\Tools;

class GetOrganizationController extends Controller
{
    use Tools;

    public function index()
    {
        try {
            $direktur = DB::table('public.orgdir_mstr')
                ->select(DB::raw(
                    "public.orgdir_mstr.dir_id, public.orgdir_mstr.dir_code, public.orgdir_mstr.dir_desc,
                            CONCAT(public.emp_mstr.emp_fname,' ', public.emp_mstr.emp_mname,' ', public.emp_mstr.emp_lname) AS director_name, public.emp_mstr.emp_dir_id"))
                ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_dir_id', '=', 'public.orgdir_mstr.dir_id')
                ->where([
                    ['public.emp_mstr.emp_div_id', '=', NULL],
                    ['public.emp_mstr.emp_dpt_id', '=', NULL],
                    ['public.emp_mstr.emp_sect_id', '=', NULL],
                    ['public.emp_mstr.emp_ssect_id', '=', NULL],
                    ['public.emp_mstr.emp_usect_id', '=', NULL]
                ])
                ->get();

            $collection = collect($direktur);

            $collection->each(function ($filter, $key) {
                // $filter->divisi = DB::table('public.orgdiv_mstr')
                //         ->select(DB::raw(
                //             "public.orgdiv_mstr.div_id, public.orgdiv_mstr.div_code, public.orgdiv_mstr.div_desc,
                //                     CONCAT(public.emp_mstr.emp_fname,' ', public.emp_mstr.emp_mname,' ', public.emp_mstr.emp_lname) AS division_name, public.emp_mstr.emp_dir_id,  public.emp_mstr.emp_div_id"))
                //         ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_div_id', '=', 'public.orgdiv_mstr.div_id')
                //         ->where([
                //             ['public.emp_mstr.emp_dpt_id', '=', NULL],
                //             ['public.emp_mstr.emp_sect_id', '=', NULL],
                //             ['public.emp_mstr.emp_ssect_id', '=', NULL],
                //             ['public.emp_mstr.emp_usect_id', '=', NULL],
                //             ['public.orgdiv_mstr.div_dir_id', '=', $filter->dir_id]
                //         ])->get();

                // $collection = collect($filter->divisi);

                // $collection->each(function ($filter, $key) {
                //     $filter->departemen = DB::table('public.orgdpt_mstr')
                //         ->select(DB::raw(
                //             "public.orgdpt_mstr.dpt_id, public.orgdpt_mstr.dpt_code, public.orgdpt_mstr.dpt_desc,
                //                     CONCAT(public.emp_mstr.emp_fname,' ', public.emp_mstr.emp_mname,' ', public.emp_mstr.emp_lname) AS departement_name, public.emp_mstr.emp_div_id, public.emp_mstr.emp_dpt_id"))
                //         ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_dpt_id', '=', 'public.orgdpt_mstr.dpt_id')
                //         ->where([
                //             ['public.emp_mstr.emp_sect_id', '=', NULL],
                //             ['public.emp_mstr.emp_ssect_id', '=', NULL],
                //             ['public.emp_mstr.emp_usect_id', '=', NULL],
                //             ['public.orgdpt_mstr.dpt_div_id', '=', $filter->div_id]
                //         ])
                //         ->get();

                //     $collection = collect($filter->departemen);

                //     $collection->each(function ($filter, $key) {
                //         $filter->seksi = DB::table('public.orgsect_mstr')
                //         ->select(DB::raw(
                //             "public.orgsect_mstr.sect_id, public.orgsect_mstr.sect_code, public.orgsect_mstr.sect_desc,
                //                     CONCAT(public.emp_mstr.emp_fname,' ', public.emp_mstr.emp_mname,' ', public.emp_mstr.emp_lname) AS section_name, public.emp_mstr.emp_dpt_id, public.emp_mstr.emp_sect_id"))
                //         ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_sect_id', '=', 'public.orgsect_mstr.sect_id')
                //         ->where([
                //             ['public.emp_mstr.emp_ssect_id', '=', NULL],
                //             ['public.emp_mstr.emp_usect_id', '=', NULL],
                //             ['public.orgsect_mstr.sect_dpt_id', '=', $filter->dpt_id]
                //         ])
                //         ->get();

                //         $collection = collect($filter->seksi);

                //         $collection->each(function ($filter, $key) {
                //             $filter->sub_seksi = DB::table('public.orgssect_mstr')
                //                 ->select(DB::raw("
                //                 public.orgssect_mstr.ssect_id, public.orgssect_mstr.ssect_code, public.orgssect_mstr.ssect_desc,
                //                 CONCAT(public.emp_mstr.emp_fname,' ', public.emp_mstr.emp_mname,' ', public.emp_mstr.emp_lname) AS sub_section_name, public.emp_mstr.emp_sect_id, public.emp_mstr.emp_ssect_id"))
                //                 ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_ssect_id', '=', 'public.orgssect_mstr.ssect_id')
                //                 ->where([
                //                     ['public.emp_mstr.emp_usect_id', '=', NULL],
                //                     ['public.orgssect_mstr.ssect_sect_id', '=', $filter->sect_id]
                //                 ])
                //                 ->get();

                //                 $collection = collect($filter->sub_seksi);

                //                 $collection->each(function ($filter, $Key) {
                //                     $filter->unit_sub_seksi = DB::table('public.orgusect_mstr')
                //                     ->select(DB::raw('
                //                     public.orgusect_mstr.usect_id, public.orgusect_mstr.usect_code, public.orgusect_mstr.usect_desc'))
                //                     ->where([
                //                         ['public.orgusect_mstr.usect_ssect_id', '=', $filter->ssect_id]
                //                     ])
                //                     ->get();

                //                     $collection = collect($filter->unit_sub_seksi);

                //                     $collection->each(function ($filter, $key) {
                //                         $filter->total_member =  DB::table('public.emp_mstr')
                //                         ->where([
                //                             ['emp_usect_id', '=', $filter->usect_id]
                //                         ])
                //                         ->count();
                //                     });

                //                 });

                //             $filter->unit_seksi = DB::table('public.orgusect_mstr')
                //                 ->select(DB::raw('
                //                 public.orgusect_mstr.usect_id, public.orgusect_mstr.usect_code, public.orgusect_mstr.usect_desc,
                //                 public.emp_mstr.emp_fname, public.emp_mstr.emp_sect_id, public.emp_mstr.emp_usect_id'))
                //                 ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_usect_id', '=', 'public.orgusect_mstr.usect_id')
                //                 ->where([
                //                     ['public.emp_mstr.emp_ssect_id', '=', NULL],
                //                     ['public.orgusect_mstr.usect_sect_id', '=', $filter->sect_id],
                //                 ])
                //                 ->get();
                //         });

                //         $filter->sub_seksi = DB::table('public.orgssect_mstr')
                //         ->select(DB::raw(
                //             "public.orgssect_mstr.ssect_id, public.orgssect_mstr.ssect_code, public.orgssect_mstr.ssect_desc,
                //                     CONCAT(public.emp_mstr.emp_fname,' ', public.emp_mstr.emp_mname,' ', public.emp_mstr.emp_lname) AS sub_section_name, public.emp_mstr.emp_dpt_id, public.emp_mstr.emp_ssect_id"))
                //         ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_ssect_id', '=','public.orgssect_mstr.ssect_id')
                //         ->where([
                //             ['public.emp_mstr.emp_sect_id', '=', NULL],
                //             ['public.emp_mstr.emp_usect_id', '=', NULL],
                //             ['public.orgssect_mstr.ssect_dept_id', '=', $filter->dpt_id],
                //             ['public.orgssect_mstr.ssect_sect_id', '=', NULL]
                //         ])
                //         ->get();

                //         $filter->unit_sub_seksi = DB::table('public.orgusect_mstr')
                //         ->select(DB::raw(
                //             "public.orgusect_mstr.usect_id, public.orgusect_mstr.usect_code, public.orgusect_mstr.usect_desc,
                //                     CONCAT(public.emp_mstr.emp_fname,' ', public.emp_mstr.emp_mname,' ', public.emp_mstr.emp_lname) AS unit_sub_section_name, public.emp_mstr.emp_dpt_id, public.emp_mstr.emp_usect_id"))
                //         ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_usect_id', '=','public.orgusect_mstr.usect_id')
                //         ->where([
                //             ['public.emp_mstr.emp_sect_id', '=', NULL],
                //             ['public.emp_mstr.emp_ssect_id', '=', NULL],
                //             ['public.orgusect_mstr.usect_dpt_id', '=', $filter->dpt_id],
                //             ['public.orgusect_mstr.usect_sect_id', '=', NULL],
                //             ['public.orgusect_mstr.usect_ssect_id', '=', NULL],
                //         ])
                //         ->get();
                //     });

                //     $filter->seksi = DB::table('public.orgsect_mstr')
                //         ->select(DB::raw(
                //             "public.orgsect_mstr.sect_id, public.orgsect_mstr.sect_code, public.orgsect_mstr.sect_desc,
                //                     CONCAT(public.emp_mstr.emp_fname,' ', public.emp_mstr.emp_mname,' ', public.emp_mstr.emp_lname) AS section_name, public.emp_mstr.emp_div_id, public.emp_mstr.emp_sect_id"))
                //         ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_sect_id', '=', 'public.orgsect_mstr.sect_id')
                //         ->where([
                //             ['public.emp_mstr.emp_dpt_id', '=', NULL],
                //             ['public.emp_mstr.emp_ssect_id', '=', NULL],
                //             ['public.emp_mstr.emp_usect_id', '=', NULL],
                //             ['public.orgsect_mstr.sect_div_id', '=', $filter->div_id],
                //             ['public.orgsect_mstr.sect_dpt_id', '=', NULL]
                //         ])
                //         ->get();

                //     $filter->sub_seksi = DB::table('public.orgssect_mstr')
                //         ->select(DB::raw(
                //             "public.orgssect_mstr.ssect_id, public.orgssect_mstr.ssect_code, public.orgssect_mstr.ssect_desc,
                //                     CONCAT(public.emp_mstr.emp_fname,' ', public.emp_mstr.emp_mname,' ', public.emp_mstr.emp_lname) AS sub_section_name, public.emp_mstr.emp_div_id, public.emp_mstr.emp_ssect_id"))
                //         ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_ssect_id', '=','public.orgssect_mstr.ssect_id')
                //         ->where([
                //             ['public.emp_mstr.emp_dpt_id', '=', NULL],
                //             ['public.emp_mstr.emp_sect_id', '=', NULL],
                //             ['public.emp_mstr.emp_usect_id', '=', NULL],
                //             ['public.orgssect_mstr.ssect_div_id', '=', $filter->div_id],
                //             ['public.orgssect_mstr.ssect_dept_id', '=', NULL],
                //             ['public.orgssect_mstr.ssect_sect_id', '=', NULL]
                //         ])
                //         ->get();

                //     $filter->unit_sub_seksi = DB::table('public.orgusect_mstr')
                //         ->select(DB::raw(
                //             "public.orgusect_mstr.usect_id, public.orgusect_mstr.usect_code, public.orgusect_mstr.usect_desc,
                //                     CONCAT(public.emp_mstr.emp_fname,' ', public.emp_mstr.emp_mname,' ', public.emp_mstr.emp_lname) AS unit_sub_section_naem, public.emp_mstr.emp_div_id, public.emp_mstr.emp_usect_id"))
                //         ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_usect_id', '=', 'public.orgusect_mstr.usect_id')
                //         ->where([
                //             ['public.emp_mstr.emp_dpt_id', '=', NULL],
                //             ['public.emp_mstr.emp_sect_id', '=', NULL],
                //             ['public.emp_mstr.emp_ssect_id', '=', NULL],
                //             ['public.orgusect_mstr.usect_div_id', '=', $filter->div_id],
                //             ['public.orgusect_mstr.usect_dpt_id', '=', NULL],
                //             ['public.orgusect_mstr.usect_sect_id', '=', NULL],
                //             ['public.orgusect_mstr.usect_ssect_id', '=', NULL]
                //         ])
                //         ->get();
                // });

                        // dd($filter->divisi);
                $filter->departemen = DB::table('public.orgdpt_mstr')
                        ->select(DB::raw(
                            "public.orgdpt_mstr.dpt_id, public.orgdpt_mstr.dpt_code, public.orgdpt_mstr.dpt_desc, public.orgdpt_mstr.dpt_dir_id,
                                    CONCAT(public.emp_mstr.emp_fname,' ', public.emp_mstr.emp_mname,' ', public.emp_mstr.emp_lname) AS departement_name, public.emp_mstr.emp_dir_id, public.emp_mstr.emp_dpt_id"))
                        ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_dpt_id', '=', 'public.orgdpt_mstr.dpt_id')
                        ->where([
                            ['public.emp_mstr.emp_div_id', '=', NULL],
                            ['public.emp_mstr.emp_sect_id', '=', NULL],
                            ['public.emp_mstr.emp_ssect_id', '=', NULL],
                            ['public.emp_mstr.emp_usect_id', '=', NULL],
                            ['public.orgdpt_mstr.dpt_dir_id', '=', $filter->dir_id],
                            ['public.orgdpt_mstr.dpt_div_id', '=', NULL],
                        ])
                        ->get();

                $collection = collect($filter->departemen);

                $collection->each(function ($filter, $key) {
                    $filter->seksi = DB::table('public.orgsect_mstr')
                    ->select(DB::raw(
                        "public.orgsect_mstr.sect_id, public.orgsect_mstr.sect_code, public.orgsect_mstr.sect_desc,
                                CONCAT(public.emp_mstr.emp_fname,' ', public.emp_mstr.emp_mname,' ', public.emp_mstr.emp_lname) AS section_name, public.emp_mstr.emp_dpt_id, public.emp_mstr.emp_sect_id"))
                    ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_sect_id', '=', 'public.orgsect_mstr.sect_id')
                    ->where([
                        ['public.emp_mstr.emp_ssect_id', '=', NULL],
                        ['public.emp_mstr.emp_usect_id', '=', NULL],
                        ['public.orgsect_mstr.sect_dpt_id', '=', $filter->dpt_id]
                    ])
                    ->get();

                    $collection = collect($filter->seksi);

                    $collection->each(function ($filter, $key){
                        $filter->sub_seksi = DB::table('public.orgssect_mstr')
                        ->select(DB::raw("
                        public.orgssect_mstr.ssect_id, public.orgssect_mstr.ssect_code, public.orgssect_mstr.ssect_desc,
                        CONCAT(public.emp_mstr.emp_fname,' ', public.emp_mstr.emp_mname,' ', public.emp_mstr.emp_lname) AS sub_section_name, public.emp_mstr.emp_ssect_id"))
                        ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_ssect_id', '=', 'public.orgssect_mstr.ssect_id')
                        ->where([
                            ['public.emp_mstr.emp_sect_id', '=', NULL],
                            ['public.emp_mstr.emp_usect_id', '=', NULL],
                            ['public.orgssect_mstr.ssect_sect_id', '=', $filter->sect_id]
                        ])
                        ->get();

                        $collection = collect($filter->sub_seksi);

                        $collection->each(function ($filter, $Key) {
                            $filter->unit_sub_seksi = DB::table('public.orgusect_mstr')
                            ->select(DB::raw('
                            public.orgusect_mstr.usect_id, public.orgusect_mstr.usect_code, public.orgusect_mstr.usect_desc'))
                            ->where([
                                ['public.orgusect_mstr.usect_ssect_id', '=', $filter->ssect_id]
                            ])
                            ->get();

                            $collection = collect($filter->unit_sub_seksi);

                            $collection->each(function ($filter, $key) {
                                $filter->total_member =  DB::table('public.emp_mstr')
                                    ->where([
                                        ['emp_usect_id', '=', $filter->usect_id]
                                    ])
                                    ->get();
                            });
                        });

                        $filter->unit_sub_seksi = DB::table('public.orgusect_mstr')
                            ->select(DB::raw('
                            public.orgusect_mstr.usect_id, public.orgusect_mstr.usect_code, public.orgusect_mstr.usect_desc'))
                            ->where([
                                ['public.orgusect_mstr.usect_sect_id', '=', $filter->sect_id]
                            ])
                            ->get();

                            $collection = collect($filter->unit_sub_seksi);

                            $collection->each(function ($filter, $key) {
                                $filter->total_member =  DB::table('public.emp_mstr')
                                    ->where([
                                        ['emp_usect_id', '=', $filter->usect_id]
                                    ])
                                    ->get();
                            });
                    });

                    $filter->sub_seksi = DB::table('public.orgssect_mstr')
                        ->select(DB::raw("
                        public.orgssect_mstr.ssect_id, public.orgssect_mstr.ssect_code, public.orgssect_mstr.ssect_desc,
                        CONCAT(public.emp_mstr.emp_fname,' ', public.emp_mstr.emp_mname,' ', public.emp_mstr.emp_lname) AS sub_section_name, public.emp_mstr.emp_ssect_id"))
                        ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_ssect_id', '=', 'public.orgssect_mstr.ssect_id')
                        ->where([
                            ['public.emp_mstr.emp_sect_id', '=', NULL],
                            ['public.emp_mstr.emp_usect_id', '=', NULL],
                            ['public.orgssect_mstr.ssect_dept_id', '=', $filter->dpt_id]
                        ])
                        ->get();

                        $collection = collect($filter->sub_seksi);

                        $collection->each(function ($filter, $Key) {
                            $filter->unit_sub_seksi = DB::table('public.orgusect_mstr')
                            ->select(DB::raw('
                            public.orgusect_mstr.usect_id, public.orgusect_mstr.usect_code, public.orgusect_mstr.usect_desc'))
                            ->where([
                                ['public.orgusect_mstr.usect_ssect_id', '=', $filter->ssect_id]
                            ])
                            ->get();

                            $collection = collect($filter->unit_sub_seksi);

                            $collection->each(function ($filter, $key) {
                                $filter->total_member =  DB::table('public.emp_mstr')
                                    ->where([
                                        ['emp_usect_id', '=', $filter->usect_id]
                                    ])
                                    ->get();
                            });
                    });

                });

                $filter->seksi = DB::table('public.orgsect_mstr')
                        ->select(DB::raw(
                            "public.orgsect_mstr.sect_id, public.orgsect_mstr.sect_code, public.orgsect_mstr.sect_desc, public.orgsect_mstr.sect_dir_id,
                                    CONCAT(public.emp_mstr.emp_fname,' ', public.emp_mstr.emp_mname,' ', public.emp_mstr.emp_lname) AS section_name, public.emp_mstr.emp_dir_id, public.emp_mstr.emp_sect_id"))
                        ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_sect_id', '=', 'public.orgsect_mstr.sect_id')
                        ->where([
                            ['public.emp_mstr.emp_div_id', '=', NULL],
                            ['public.emp_mstr.emp_dpt_id', '=', NULL],
                            ['public.emp_mstr.emp_ssect_id', '=', NULL],
                            ['public.emp_mstr.emp_usect_id', '=', NULL],
                            ['public.orgsect_mstr.sect_dir_id', '=', $filter->dir_id],
                            ['public.orgsect_mstr.sect_div_id', '=', NULL],
                            ['public.orgsect_mstr.sect_dpt_id', '=', NULL],
                        ])
                        ->get();

                $filter->sub_seksi = DB::table('public.orgssect_mstr')
                        ->select(DB::raw(
                                "public.orgssect_mstr.ssect_id, public.orgssect_mstr.ssect_code, public.orgssect_mstr.ssect_desc,
                                        CONCAT(public.emp_mstr.emp_fname,' ', public.emp_mstr.emp_mname,' ', public.emp_mstr.emp_lname) AS sub_section_name, public.emp_mstr.emp_dir_id, public.emp_mstr.emp_ssect_id"))
                        ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_ssect_id', '=', 'public.orgssect_mstr.ssect_id')
                        ->where([
                            ['public.emp_mstr.emp_div_id', '=', NULL],
                            ['public.emp_mstr.emp_dpt_id', '=', NULL],
                            ['public.emp_mstr.emp_sect_id', '=', NULL],
                            ['public.emp_mstr.emp_usect_id', '=', NULL],
                            ['public.orgssect_mstr.ssect_dir_id', '=', $filter->dir_id],
                            ['public.orgssect_mstr.ssect_div_id', '=', NULL],
                            ['public.orgssect_mstr.ssect_dept_id', '=', NULL],
                            ['public.orgssect_mstr.ssect_sect_id', '=', NULL],
                        ])
                        ->get();

                $filter->unit_sub_seksi = DB::table('public.orgusect_mstr')
                            ->select(DB::raw(
                                "public.orgusect_mstr.usect_id, public.orgusect_mstr.usect_code, public.orgusect_mstr.usect_desc,
                                        CONCAT(public.emp_mstr.emp_fname,' ', public.emp_mstr.emp_mname,' ', public.emp_mstr.emp_lname) AS unit_sub_section_name, public.emp_mstr.emp_dir_id, public.emp_mstr.emp_usect_id"
                            ))
                            ->leftJoin('public.emp_mstr', 'public.emp_mstr.emp_usect_id', '=', 'public.orgusect_mstr.usect_id')
                            ->where([
                                ['public.orgusect_mstr.usect_dir_id', '=', $filter->dir_id]
                            ])
                            ->get();
            });

            return $this->response('berhasil', 'beerhasil mengambil struktur organisasi', $direktur, 200);
        } catch (\Throwable $th) {
            return $this->response('gagal', 'gagal mengambil struktur organisasi', $th->getMessage(), 400);
        }
    }
}
