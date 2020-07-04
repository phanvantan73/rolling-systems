<?php

namespace App\Http\Controllers\Api;

use App\Models\Staff;
use App\Models\Diary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\GenerateDataChartTrait;

class UserController extends Controller
{
	use GenerateDataChartTrait;
	
    public function index(Request $request)
    {
    	$year = $request->year ?? '2020';
    	$data = $this->generateDataForChart($year);

    	return response()->json([
    		'data' => $data,
    	]);
    }

    public function checkin(Request $request)
    {
        $id = $request->id ?? '1111';
        $temperature = $request->temp ?? 0.0;
        $today = date("Y-m-d");
        $now = date("H:i:s");

        $staff = Staff::where('id', $id)->first();
        // $result = mysqli_query($connect, $query);
        // $rowcount = mysqli_num_rows($result);

        //không có nhân viên
        if(!$staff) {
            // header("HTTP/1.1 501 Not Implemented");
            // $response = array('tableId' => "-2");
            // echo json_encode($response);
            return response()->json([
                'tableId' => '-2',
            ], 501, ['Not Implemented']);
        }
        else { //nếu có
            // $query =  "SELECT * FROM diary WHERE idNv='$id' AND day='$today'";
            $toDayDiaries = Diary::where('idNv', $id)->where('day', $today)->first();
            // $result = mysqli_query($connect, $query);
            // $rowcount = mysqli_num_rows($result);
            //điểm danh lần 1 trong ngày
            if(!$toDayDiaries) {
                //nếu lớn hơn 37.3 thì insert vào ngoại trừ timein timeout
                if($temperature > 37.3) {
                    // $query = "INSERT INTO diary (temp, idNv, day) VALUES ('$temperature', '$id', '$today')";
                    $diaryOverTemp = Diary::create([
                        'temp' => $temperature,
                        'timein' => '',
                        'idNv' => $id,
                        'timeout' => '',
                        'day' => $today,
                    ]);
                    if ($diaryOverTemp) {
                        // header("HTTP/1.1 200 OK");
                        // $response = array('tableId' => "-3");
                        // echo json_encode($response);
                        return response()->json([
                            'tableId' => '-3',
                        ], 200, ['OK']);
                    } else {
                        // echo 'aa';
                        // header("HTTP/1.1 501 Not Implemented");
                        // $response = array('status' => 3,'tableId' => 0);
                        // echo json_encode($response);
                        return response()->json([
                            'status' => 3,
                            'tableId' => 0,
                        ], 501, ['Not Implemented']);
                    }
                }
                //ngược lại thì insert vào ngoại trừ timeout
                else {
                    // $query = "INSERT INTO diary (temp, idNv, timein, day) VALUES ('$temperature', '$id','$now', '$today')";
                    $diaryWithoutCheckOut = Diary::create([
                        'temp' => $temperature,
                        'timein' => $now,
                        'idNv' => $id,
                        'timeout' => '',
                        'day' => $today,
                    ]);
                    if ($diaryWithoutCheckOut) {
                        // $query =  "SELECT * FROM NHANVIEN WHERE id='$id'";
                        $staff = Staff::where('id', $id)->first();
                        // $result = mysqli_query($connect, $query);
                        // while($row = mysqli_fetch_assoc($result)) {
                        //     $tableId = $row['tableId'];
                        // }
                        // header("HTTP/1.1 200 OK");
                        // $response = array('tableId' => $tableId, 'status' => 1);
                        // echo json_encode($response);

                        return response()->json([
                            'status' => 1,
                            'tableId' => $staff->tableId,
                        ], 200, ['OK']);
                    } else {
                        // echo 'aa';
                        // header("HTTP/1.1 501 Not Implemented");
                        // $response = array('status' => 3,'tableId' => 0);
                        // echo json_encode($response);
                        return response()->json([
                            'status' => 3,
                            'tableId' => 0,
                        ], 501, ['Not Implemented']);
                    }
                }
                
            } 
            //điểm danh lần 2 trong ngày
            if($toDayDiaries) {
                // $query =  "SELECT * FROM diary WHERE idNv='$id' AND day='$today'";
                $firstDiary = Diary::where('idNv', $id)->where('day', $today)->first();
                // $result = mysqli_query($connect, $query);
                // if (mysqli_num_rows($result) > 0) {
                if ($firstDiary) {
                    // output data of each row
                    if ($firstDiary->timein == null) {
                        if($temperature > 37.3) {
                            // $query = "UPDATE diary SET temp='$temperature' WHERE idNv='$id' AND day='$today'";
                            $updateStatus = Diary::where('idNv', $id)->where('day', $today)->update([
                                'temp' => $temperature,
                            ]);
                            // if (mysqli_query($connect, $query)) {  
                            if ($updateStatus) {         
                                // header("HTTP/1.1 203 Non-Authoritative Information");
                                // $response = array('tableId' => "-3");
                                // echo json_encode($response);
                                return response()->json([
                                    'tableId' => '-3',
                                ], 203, ['Non-Authoritative Information']);
                            } else {
                                // header("HTTP/1.1 501 Not Implemented");
                                // $response = array('tableId' => "-1");
                                // echo json_encode($response);
                                return response()->json([
                                    'tableId' => '-1',
                                ], 501, ['Not Implemented']);
                            }
                        }
                        else {
                            // $query = "UPDATE diary SET timein='$now', temp='$temperature' WHERE idNv='$id' AND day='$today'";
                            $updateStatus = Diary::where('idNv', $id)->where('day', $today)->update([
                                'timein' => $now,
                                'temp' => $temperature,
                            ]);

                            // if (mysqli_query($connect, $query)) {           
                            if ($updateStatus) {  
                                // $query =  "SELECT * FROM NHANVIEN WHERE id='$id'";
                                $staff = Staff::where('id', $id)->first();
                                // $result = mysqli_query($connect, $query);
                                // while($row = mysqli_fetch_assoc($result)) {
                                //     $tableId = $row['tableId'];
                                // }

                                // header("HTTP/1.1 203 Non-Authoritative Information");
                                // $response = array('tableId' => $tableId, 'status' => 1);
                                // echo json_encode($response);
                                return response()->json([
                                    'tableId' => $staff->tableId,
                                    'status' => 1,
                                ], 203, ['Non-Authoritative Information']);

                            } else {
                                // header("HTTP/1.1 501 Not Implemented");
                                // $response = array('tableId' => "-1");
                                // echo json_encode($response);
                                return response()->json([
                                    'tableId' => '-1',
                                ], 501, ['Not Implemented']);
                            }
                        }
                    } else {
                        if($firstDiary->timeout == null) {
                            // $query = "UPDATE diary SET timeout='$now' WHERE idNv='$id' AND day='$today'";
                            $updateStatus = Diary::where('idNv', $id)->where('day', $today)->update([
                                'timeout' => $now,
                            ]);
                            // if (mysqli_query($connect, $query)) {     
                            if ($updateStatus) {      
                                // $query =  "SELECT * FROM NHANVIEN WHERE id='$id'";
                                $staff = Staff::where('id', $id)->first();
                                // $result = mysqli_query($connect, $query);
                                // while($row = mysqli_fetch_assoc($result)) {
                                //     $tableId = $row['tableId'];
                                // }

                                // header("HTTP/1.1 203 Non-Authoritative Information");
                                // $response = array('tableId' => $tableId, 'status' => 2);
                                // echo json_encode($response);
                                return response()->json([
                                    'status' => 2,
                                    'tableId' => $staff->tableId,
                                ], 203, ['Non-Authoritative Information']);
                            } else {
                                // header("HTTP/1.1 501 Not Implemented");
                                // $response = array('tableId' => "-1");
                                // echo json_encode($response);
                                return response()->json([
                                    'tableId' => '-1',
                                ], 501, ['Not Implemented']); 
                            }
                        }else {
                            // header("HTTP/1.1 501 Not Implemented");
                            // $response = array('tableId' => "-1");
                            // echo json_encode($response);
                            return response()->json([
                                'tableId' => '-1',
                            ], 501, ['Not Implemented']); 
                        }
                    }
                    // while($row = mysqli_fetch_assoc($result)) {
                    //     if($row['timein'] == null) {
                    //         if($temperature > 37.3) {
                    //             $query = "UPDATE diary SET temp='$temperature' WHERE idNv='$id' AND day='$today'";
                    //             if (mysqli_query($connect, $query)) {           
                    //                 header("HTTP/1.1 203 Non-Authoritative Information");
                    //                 $response = array('tableId' => "-3");
                    //                 echo json_encode($response);

                    //             } else {
                    //                 header("HTTP/1.1 501 Not Implemented");
                    //                 $response = array('tableId' => "-1");
                    //                 echo json_encode($response);
                    //             }
                    //         }
                    //         else {
                    //             $query = "UPDATE diary SET timein='$now', temp='$temperature' WHERE idNv='$id' AND day='$today'";
                    //             if (mysqli_query($connect, $query)) {           
                    //                 $query =  "SELECT * FROM NHANVIEN WHERE id='$id'";
                    //                 $result = mysqli_query($connect, $query);
                    //                 while($row = mysqli_fetch_assoc($result)) {
                    //                     $tableId = $row['tableId'];
                    //                 }

                    //                 header("HTTP/1.1 203 Non-Authoritative Information");
                    //                 $response = array('tableId' => $tableId, 'status' => 1);
                    //                 echo json_encode($response);

                    //             } else {
                    //                 header("HTTP/1.1 501 Not Implemented");
                    //                 $response = array('tableId' => "-1");
                    //                 echo json_encode($response);
                    //             }
                    //         }
                    //     }else{
                    //         if($row['timeout'] == null) {
                    //             $query = "UPDATE diary SET timeout='$now' WHERE idNv='$id' AND day='$today'";
                    //             if (mysqli_query($connect, $query)) {           
                    //                 $query =  "SELECT * FROM NHANVIEN WHERE id='$id'";
                    //                 $result = mysqli_query($connect, $query);
                    //                 while($row = mysqli_fetch_assoc($result)) {
                    //                     $tableId = $row['tableId'];
                    //                 }

                    //                 header("HTTP/1.1 203 Non-Authoritative Information");
                    //                 $response = array('tableId' => $tableId, 'status' => 2);
                    //                 echo json_encode($response);

                    //             } else {
                    //                 header("HTTP/1.1 501 Not Implemented");
                    //                 $response = array('tableId' => "-1");
                    //                 echo json_encode($response);
                    //             }
                    //         }else {
                    //             header("HTTP/1.1 501 Not Implemented");
                    //             $response = array('tableId' => "-1");
                    //             echo json_encode($response);
                    //         }
                    //     }
                        
                    // }
                } 
            }
        }
    }
}
