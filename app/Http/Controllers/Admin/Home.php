<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Routing\Controller as BaseController;
use Storage;
use Symfony\Component\HttpFoundation\Request;

class Home extends BaseController
{

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        return view('/admin/Products'); //->with(['Product' => $QR, 'Distributors' => $QR1]);
    }

    public function GetProductdata(Request $request)
    {
        $columns = array(
            0 => 'studentId',
            1 => 'images',
            2 => 'name',
            3 => 'email',
            4 => 'address',
        );

        $sql = "select * from student where IsDelete!='1'";
        $query = DB::select($sql);
        $totalData = count($query);
        $totalFiltered = $totalData;
        if (!empty($request['search']['value'])) { // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $searchString = "'%" . str_replace(",", "','", $request['search']['value']) . "%'"; //wrapping qoutation
            $sql .= " and (name  like (" . $searchString . ") ";
            $sql .= " or email like (" . $searchString . ") ";
            $sql .= " or address like (" . $searchString . ") )";
        }

        $query = DB::Select($sql);
        $totalFiltered = count($query);

        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . " " . $request['order'][0]['dir'] . " LIMIT " . $request['start'] . " ," . $request['length'] . "   "; // adding length

        $query = DB::select($sql);
        $data = array();
        $cnts = $request['start'] + 1;
        $cnt = 1;
        foreach ($query as $row) {
            $btn1 = "<button  onclick='editproductPrice(" . $row->studentId . ")'  class='btn btn-info btn-sm btn-change' title='Edit' id='VideoTagid'><i class='fas fa-edit'></i></button>&nbsp;<button  title='Delete' onclick='deleteproPrice(" . $row->studentId . ")' id='del' class='btn btn-danger btn-sm btn-change'><i class='far fa-trash'></i></button>";
            $image = "";
            if ($row->images == "") {
                $image = "<img src='" . asset('/storage/app/PlaceHolder/placeholder-image.PNG') . "' width='45'>";
            } else {
                $image = "<img src='" . asset('/storage/app/product_image/' . $row->images) . "' width='45'>";
            }
            $nestedData = array();
            $nestedData[] = $cnt++;
            $nestedData[] = $image;
            $nestedData[] = $row->name;
            $nestedData[] = $row->email;
            $nestedData[] = $row->address;
            $nestedData[] = $btn1;
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($request['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data, // total data array
        );
        echo json_encode($json_data);
    }

    public function Getdetail(Request $request)
    {
        $GetData = DB::table('student')->where('studentId', $request->id)->first();
        echo json_encode(array('Data' => $GetData));
    }
    public function AddData(Request $request)
    {
        if ($request->file('file12')) {
            $dir = "product_image";
            $files = $request->file12;
            $fileName = strtolower($request->file12->getClientOriginalName());
            Storage::putFileAs($dir, $files, $fileName);

            $insert = [
                'name' => $request->Name,
                'email' => $request->Email,
                'address' => $request->Address,
                'images' => $fileName,
                'createdate' => date('Y-m-d H:i:s'),
                'updatedate' => date('Y-m-d H:i:s'),
            ];
            DB::table('student')->insert($insert);
            return Redirect('/');
        } else {
            $insert = [
                'name' => $request->Name,
                'email' => $request->Email,
                'address' => $request->Address,
                'images' => '',
                'createdate' => date('Y-m-d H:i:s'),
                'updatedate' => date('Y-m-d H:i:s'),
            ];
            DB::table('student')->insert($insert);
            return Redirect('/');
        }

    }
    public function UpdateData(Request $request)
    {
       
        if ($request->file('file')) {

            $dir = "product_image";
            $files = $request->file;
            $fileName = strtolower($request->file->getClientOriginalName());
            Storage::putFileAs($dir, $files, $fileName);

            $up = [
                'name' => $request->Name,
                'email' => $request->Email,
                'address' => $request->Address,
                'images' => $fileName,
            ];
            DB::table('student')->where('studentId', $request->studentId)->update($up);
            return Redirect('/');
        } else {
            $up = [
                'name' => $request->Name,
                'email' => $request->Email,
                'address' => $request->Address,
            ];
            DB::table('student')->where('studentId', $request->studentId)->update($up);
            return Redirect('/');
        }

    }

}
