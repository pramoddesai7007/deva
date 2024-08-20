<style>
  .blink {
    animation: blinker 1s linear infinite;
  }

  @keyframes blinker {
    50% {
      opacity: 0;
    }
  }
</style>
<style>
    .fs-21{
        font-size: 11px!important;
    }
    .btn {
        font-size: 11px!important;
        border-radius: 2px;
    }
    .overlay-orange {
        background-color: #d25822b5;
        border-radius: 0.25rem;
        top: 14px;
        align-items: center;
        height: 284px;
        display: grid;
        width: 90%;
        overflow: auto;
    }
    .overlay-purpul {
        background-color: #b439e0b5;
        border-radius: 0.25rem;
        top: 14px;
        align-items: center;
        height: 284px;
        display: grid;
        width: 90%;
        overflow: auto;
    }
    .overlay-darkred {
        background-color: red;
        border-radius: 0.25rem;
        top: 14px;
        align-items: center;
        height: 284px;
        display: grid;
        width: 90%;
        overflow: auto;
    }
</style>
<link rel="stylesheet" href="<?php echo MOD_URL.$module;?>/assets/css/roomlist.css">
<?php
$status = array(
    '' => 'Select Status',
    '0' => 'Checkin',
    '1' => 'Available',
    '2' => 'Booked',
    //'3' => 'Assigned to clean',
    '3' => 'Cleanup',
    '4' => 'Booked',
    '5' => 'Under maintenance',
    '6' => 'Dirty',
    '7' => 'Blocked',
    '8' => 'Do not reserve',
    '9' => 'Under Process',
);
?>
<div class="row">
    <?php if($this->permission->method('room_reservation','create')->access()): ?>
    <div class="col-sm-12 col-md-12">
        <div class="card mb-4 flex-fill w-100">
            <!--Content Header (Page header)-->
            <div class="card-header">
                <div class="content-header row align-items-center g-0">
                    <div class="col-lg-12 col-xl-4 mb-3 header-title">
                        <div class="d-flex align-items-center justify-content-center justify-content-xl-start">
                            <h1 class="font-weight-bolder">Room status</h1>
                        </div>
                    </div>
                    <nav aria-label="breadcrumb" class="col-md-12 col-lg-8 col-xl-5 mb-3 d-flex justify-content-center">
                        <div class="mr-2">
                            <input class="form-control datepickers" id="search_date" placeholder="Search Date"
                                type="text" value="" />
                        </div>

                        <div class="mr-2 d-flex" style="display: none!important;">
                            <select name="somename" class="basic-single" id="search_status">
                                <option selected="selected" value="null"><?php echo display("search")." ".display("status") ?></option>
                                <option value="4"><?php echo display("checkin") ?></option>
                                <option value="0"><?php echo display("booked") ?></option>
                                <option value="1"><?php echo display("available") ?></option>
                            </select>
                        </div>

                        <div class="mr-2 d-flex" style="display: none!important;">
                            <select name="somename" class="basic-single" id="search_apt">
                                <option selected="selected"  value="null"><?php echo display('floor_name') ?></option>
                                <?php foreach($floordetails as $btype){ ?>
                                <option value="<?php echo html_escape($btype->floorid); ?>">
                                    <?php echo html_escape($btype->floorname);?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mr-2">
                            <button type="button"
                                onclick="showResult(null,$('#search_date').val(),$('#search_status').find(':selected').val(),$('#search_apt').find(':selected').val())"
                                class="btn btn-success" id="search">Search</button>
                        </div>
                    </nav>
                    <div class="col-md-12 col-lg-4 mb-3 col-xl-3 header-title">
                        <form class="search" action="#" method="get">
                            <div class="search__inner">
                                <input type="text" style="padding-left:40px; height:40px"
                                    onkeyup="showResult(this.value)" class="search__text" placeholder="Search...">
                                <i class="typcn typcn-zoom-outline search__helper" data-sa-action="search-close"></i>
                            </div>
                        </form>
                        <!--/.search-->
                    </div>
                </div>
            </div>
            <!--/.Content Header (Page header)-->

            <div class="row p-3" id="allRooms">
                <?php $sl = 1; ?>
                <?php foreach ($roomlist as $list) { ?>
                <?php 
                        $room_type = $this->db->select("roomtype")->from("roomdetails")->where("roomid", $list->roomid)->get()->row();
                        $room_image = $this->db->select("room_imagename")->from("room_image")->where("room_id", $list->roomid)->get()->row();
                        $floor = $this->db->select("floorname")->from("tbl_floor")->where("floorid", $list->floorid)->get()->row();
                    ?>
                <?php 
                $id = $this->db->select("bookedid,bookingstatus,checkoutdate")->from("booked_info")->where("checkindate<=",date("Y-m-d H:i:s"))->where("checkoutdate>=",date("Y-m-d H:i:s"))->where("FIND_IN_SET(".$list->roomno.",room_no)<>",0)->where_in("bookingstatus",array(0,4))->get()->row();

                //kiran
                $new_time = date("Y-m-d H:i:s", strtotime('-1 hours', strtotime($id->checkoutdate)));
                //var_dump($id->checkoutdate); var_dump($new_time); 
                //kiran

                if(!empty($id)?$id->bookingstatus==4:""){
                    $list->status = 0;
                }
                if($id){
                ?>
                <div class="col-sm-6 col-lg-4 col-xl-2 col-xxl-2 mb-3">
                    <div class="position-relative d-flex justify-content-center">
                        <div class="hotel-image">
                            <img src="<?php echo base_url((!empty($room_image))?$room_image->room_imagename:"assets/img/room-setting/room_images.png"); ?>"
                                class="image-inner" alt="">
                        </div>
                        <div
                            class="scroll-bar overlay-<?php if($id->checkoutdate >= $new_time && $id->checkoutdate >= $curr_time){echo "darkred";}elseif($list->status==2 | $list->status==4){echo "green";} if($list->status==1){echo "black";} if($list->status==0){echo "red";}?> px-4 py-3 text-center text-white position-absolute">
                            <h2 class="fs-21 mt-3 font-weight-bold">
                                <?php echo display('floor_name')." "; echo html_escape($floor->floorname); ?></h2>
                            <h3 class="fs-21 mt-3 font-weight-bold">
                                <?php echo display('room_no')." "; echo html_escape($list->roomno); ?></h3>
                            <p class="mb-1">
                                <?php echo display('room_name')." :"; echo html_escape($room_type->roomtype); ?></p>
                            <?php
                            if($list->status==2 | $list->status==4 | $list->status==0){
                                    $time = $this->db->select("checkoutdate")->from("booked_info")->where("checkindate<=",date("Y-m-d H:i:s"))->where("checkoutdate>=",date("Y-m-d H:i:s"))->where("FIND_IN_SET(".$list->roomno.",room_no)<>",0)->where_in("bookingstatus",array(0,4))->get()->row();
                                    if(!empty($time->checkoutdate)){
                                    $diff = strtotime($time->checkoutdate) - strtotime(date("Y-m-d H:i:s"));
                                    $dur = $time->checkoutdate;
                                    echo " "; ?>
                            <p class="mb-1x\ <?php if($id->checkoutdate >= $new_time && $id->checkoutdate >= $curr_time){echo "blink";} ?>">
                                <?php echo display('checkout')." :"; echo html_escape(date("Y-m-d",strtotime($time->checkoutdate))); ?>
                            </p>
                            <p class="mb-1 countdown-text" id="time_<?php echo $sl; ?>"></p>
                            <input type="hidden" value="<?php echo $dur; ?>" id="<?php echo $sl; ?>" class='sl'>
                            <?php 
                                      }
                                    }else{ ?>
                            <p class="mb-1"><?php echo display('checkout')." : None";  ?></p>
                            <p class="mb-1 countdown-text">0.0</p>
                            <?php }
                                    ?>
                            <input type="hidden" id="date_time" value="<?php echo date("Y-m-d"); ?>">
                            <button type="button"
                                class="btn btn-<?php if($list->status==2 | $list->status==4){echo "primary";} if($list->status==1){echo "success";} if($list->status==0){echo "warning";}?> mb-2 font-weight-bold <?php if($id->checkoutdate >= $new_time && $id->checkoutdate >= $curr_time){echo "blink";} ?>"
                                id="<?php echo empty($id)?"":"b_".$id->bookedid; ?>" value="<?php echo $list->roomno; ?>"
                                data-toggle="modal"
                                onclick="Detail(<?php echo empty($id)?0:$id->bookedid; ?>,<?php echo $list->roomno; ?>)"
                                data-target="#exampleModal1"><?php echo html_escape($status[$list->status]); ?></button>
                        </div>
                    </div>
                </div>
                <?php }else{ 
                //echo $list->status;
                ?> 
                <div class="col-sm-6 col-lg-4 col-xl-2 col-xxl-2 mb-3">
                    <div class="position-relative d-flex justify-content-center">
                        <div class="hotel-image">
                            <img src="<?php echo base_url((!empty($room_image))?$room_image->room_imagename:"assets/img/room-setting/room_images.png"); ?>"
                                class="image-inner" alt="">
                        </div>
                        <div
                            class="scroll-bar overlay-<?php if($list->status==2 | $list->status==4){echo "green";} if($list->status==1){echo "black";} if($list->status==0){echo "red";}if($list->status==7){echo "orange";}if($list->status==3){echo "purpul";}?> px-4 py-3 text-center text-white position-absolute">
                            <h2 class="fs-21 mt-3 font-weight-bold">
                                <?php echo display('floor_name')." "; echo html_escape($floor->floorname); ?></h2>
                            <h3 class="fs-21 mt-3 font-weight-bold">
                                <?php echo display('room_no')." "; echo html_escape($list->roomno); ?></h3>
                            <p class="mb-1">
                                <?php echo display('room_name')." :"; echo html_escape($room_type->roomtype); ?></p>
                            <?php
                            if($list->status==2 | $list->status==4 | $list->status==0){
                                    $time = $this->db->select("checkoutdate")->from("booked_info")->where("checkindate<=",date("Y-m-d H:i:s"))->where("checkoutdate>=",date("Y-m-d H:i:s"))->where("FIND_IN_SET(".$list->roomno.",room_no)<>",0)->where_in("bookingstatus",array(0,4))->get()->row();
                                    if(!empty($time->checkoutdate)){
                                    $diff = strtotime($time->checkoutdate) - strtotime(date("Y-m-d H:i:s"));
                                    $dur = $time->checkoutdate;
                                    echo " "; ?>
                            <p class="mb-1">
                                <?php echo display('checkout')." :"; echo html_escape(date("Y-m-d",strtotime($time->checkoutdate))); ?>
                            </p>
                            <p class="mb-1 countdown-text" id="time_<?php echo $sl; ?>"></p>
                            <input type="hidden" value="<?php echo $dur; ?>" id="<?php echo $sl; ?>" class='sl'>
                            <?php 
                                      }
                                    }else{ ?>
                            <p class="mb-1"><?php echo display('checkout')." : None";  ?></p>
                            <p class="mb-1 countdown-text">0.0</p>
                            <?php }
                                    ?>
                            <input type="hidden" id="date_time" value="<?php echo date("Y-m-d"); ?>">
                            <button type="button"
                                class="btn btn-<?php if($list->status==2 | $list->status==4){echo "primary";} if($list->status==1){echo "success";} if($list->status==0){echo "warning";}if($list->status==7){echo "black";}if($list->status==3){echo "primary";}?> mb-2 font-weight-bold"
                                id="<?php echo empty($id)?"":"b_".$id->bookedid; ?>" value="<?php echo $list->roomno; ?>"
                                data-toggle="modal"
                                onclick="Detail(<?php echo empty($id)?0:$id->bookedid; ?>,<?php echo $list->roomno; ?>)"
                                data-target="#exampleModal1"><?php echo html_escape($status[$list->status]); ?></button>
                        </div>
                    </div>
                </div>    
                <?php } $sl++; ?>
                <?php } //die;?>
            </div>
        </div>
    </div>

    <!--- kiran chavan -->
    <div class="col-sm-12 col-md-12">
        <div class="card mb-4 flex-fill w-100">
            <!--Content Header (Page header)-->
            <div class="card-header">
                <div class="content-header row align-items-center g-0">
                    <div class="col-lg-12 col-xl-4 mb-3 header-title">
                        <div class="d-flex align-items-center justify-content-center justify-content-xl-start">
                            <h1 class="font-weight-bolder">Room Block / Available</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.Content Header (Page header)-->
            <div class="row" style="padding: 10px;">
            <div class="col-sm-6">
                <div class="col-md-12 col-lg-12 col-xl-12 mb-3">
                    <div class="form-group mb-0">
                        <label class="font-weight-600 mb-1">Room No</label>
                        <div class="icon-addon addon-md input-left-icon"> 
                            <select class="selectpicker form-select" data-live-search="true" data-width="100%" id="roomid">
                                <option value="" selected>Choose Room</option>
                                <?php foreach($roomlist as $list_room){ 
                                    if($list_room->status!=2 && $list_room->status!=0){?>
                                <option value="<?php echo $list_room->roomassignid;  ?>">
                                    <?php echo $list_room->roomno;3?></option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-12 mb-3">
                    <div class="form-group mb-0">
                        <label class="font-weight-600 mb-1">Room Status</label>
                        <div class="icon-addon addon-md input-left-icon">
                            <select class="selectpicker form-select" data-live-search="true" data-width="100%" id="room_status">
                                <option value="" selected>Choose Room Status</option>
                                <option value="1">Available</option>
                                <option value="3">Cleanup</option>
                                <option value="7">Block</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button type="button" class="btn btn-primary w-100p" onclick="changeStatus()"
                        id="bookingsave">Change</button>
                </div>
            </div>
            <div class="col-sm-6">
                <?php 
                $data["total_room"]  = $this->db->select('COUNT(*) as tot_room')->from('tbl_roomnofloorassign')->get()->result();
                $data["book_room"]  = $this->db->select('COUNT(*) as book_room')->from('tbl_roomnofloorassign')->where('status=',2)->get()->result();
                $data["avl_room"]  = $this->db->select('COUNT(*) as avl_room')->from('tbl_roomnofloorassign')->where('status=',1)->get()->result();
                $data["cleanup_room"]  = $this->db->select('COUNT(*) as cleanup_room')->from('tbl_roomnofloorassign')->where('status=',3)->get()->result();
                $data["block_room"]  = $this->db->select('COUNT(*) as block_room')->from('tbl_roomnofloorassign')->where('status=',7)->get()->result();
                ?>
                <div class="row">
                    <div class="col-sm-5"><label style="font-weight: bold;">Total Room </label></div>
                    <div class="col-sm-4"><label><input type="text" name="tot_room" readonly value="<?php echo $data["total_room"]['0']->tot_room; ?>"></label></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><label style="font-weight: bold;">Booked Room </label></div>
                    <div class="col-sm-4"><label><input type="text" name="tot_room" readonly value="<?php echo $data["book_room"]['0']->book_room; ?>"></label></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><label style="font-weight: bold;">Available Room </label></div>
                    <div class="col-sm-4"><label><input type="text" name="tot_room" readonly value="<?php echo $data["avl_room"]['0']->avl_room; ?>"></label></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><label style="font-weight: bold;">Cleanup Room </label></div>
                    <div class="col-sm-4"><label><input type="text" name="tot_room" readonly value="<?php echo $data["cleanup_room"]['0']->cleanup_room; ?>"></label></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><label style="font-weight: bold;">Blocked Room </label></div>
                    <div class="col-sm-4"><label><input type="text" name="tot_room" readonly value="<?php echo $data["block_room"]['0']->block_room; ?>"></label></div>
                </div>
            </div>
            </div>

            <div class="row p-3" id="allRooms">
                
            </div>
        </div>
    </div>

    <!--- kiran chavan -->
    <div class="col-sm-6 col-md-6">
        <div class="card mb-4 flex-fill w-100">
            <!--Content Header (Page header)-->
            <div class="card-header">
                <div class="content-header row align-items-center g-0">
                    <div class="col-lg-12 col-xl-12 mb-3 header-title">
                        <div class="d-flex align-items-center justify-content-center justify-content-xl-start">
                            <h1 class="font-weight-bolder">Late checkout Report</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.Content Header (Page header)-->
            <div class="row" style="padding: 10px;">
            <div class="col-sm-12">
                <div class="col-md-12 col-lg-12 col-xl-12 mb-3">
                    <div class="table-responsive">
                    <table width="100%" id="latecheckout"
                                        class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <!-- <th><?php echo display('sl_no') ?></th> -->
                                                <th><?php echo display('booking_number') ?></th>
                                                <th><?php echo display('room_name') ?></th>
                                                <th><?php echo display('room_no') ?></th>
                                                <th><?php echo display('customer') ?></th>
                                                <th><?php echo display('number_of_person') ?></th>
                                                <!-- <th><?php echo display('check_in') ?></th> -->
                                                <th><?php echo display('check_out') ?></th>
                                                <!-- <th><?php echo display('booking_date') ?></th>
                                                <th><?php echo display('booking_status') ?></th>
                                                <th><?php echo display('payment_status') ?></th>
                                                <th><?php echo display('total_amount') ?></th>
                                                <th><?php echo display('paid_amount') ?></th>
                                                <th><?php echo display('due_amount') ?></th>
                                                <th><?php echo display('action') ?></th> -->
                                            </tr>
                                        </thead>
                                        <!-- <tfoot>
                                            <tr>
                                                <th colspan="8" style="text-align:right"><?php echo display('total') ?>:
                                                </th>
                                                <th></th>
                                                <th colspan="1" style="text-align:right"><?php echo display('due_amount'); ?>:
                                                </th>
                                                <th></th>
                                            </tr>
                                        </tfoot> -->
                                        <tbody>
                                            <?php $i=0; 
                                            $seprate_room = '';
                                            foreach($bookings as $book){
                                                $i++;
                                                $seprate_room       = explode(',', $book->room_no); 
                                                $seprate_type       = explode(',', $book->roomtype);
                                                $seprate_nuofpeople = explode(',', $book->nuofpeople); 
                                                $room_sr = 0;
                                                foreach($seprate_room as $room){ 

                                                ?>
                                            <tr>
                                                <!-- <td><?php echo $i;?></td> -->
                                                <td><?php echo html_escape($book->booking_number);?></td>
                                                <td><?php echo html_escape($seprate_type[$room_sr]);//echo html_escape($book->roomtype);?></td>
                                                <td><?php echo html_escape($seprate_room[$room_sr]);?></td>
                                                <td><?php echo html_escape($book->firstname.' '.$book->lastname);?></td>
                                                <td><?php echo html_escape($seprate_nuofpeople[$room_sr]);?></td>
                                                <!-- <td><?php echo html_escape($book->checkindate);?></td> -->
                                                <td><?php echo html_escape($book->checkoutdate);?></td>
                                                <!-- <td><?php echo html_escape($book->date_time);?></td>
                                                <td><?php if($book->bookingstatus==5){ echo display("checkout");} else if($book->bookingstatus==0){ echo display('pending');} else if($book->bookingstatus==1){ echo display("cancel");} else if($book->bookingstatus==4){ echo display("checkin");}?>
                                                </td>
                                                <td><?php if($book->bookingstatus==5){if($book->creditamt>0){echo display("credit");} else{ echo display('complete');}}else{if($book->total_price<=$book->paid_amount){echo display("complete");}else{echo display('pending');}}?>
                                                </td>
                                                <td><?php echo html_escape($book->total_price);?></td>
                                                <td><?php echo html_escape($book->paid_amount);?></td>
                                                <td><?php echo ($book->total_price-$book->paid_amount)<0 ? 0 : html_escape($book->total_price-$book->paid_amount);?></td>
                                                <td><a href="<?php echo base_url("reports/booking-details/".html_escape($book->bookedid)) ?>"
                                                        class="btn btn-success btn-sm" data-toggle="tooltip"
                                                        data-placement="top" data-original-title="Details"
                                                        title="Details"><i class="ti-eye"></i></a>&nbsp;<a
                                                        href="<?php echo base_url("reports/customer-reciept/".html_escape($book->bookedid)) ?>"
                                                        class="btn btn-success btn-sm" data-toggle="tooltip"
                                                        data-placement="top" data-original-title="Customer Invoice"
                                                        title="Customer Invoice"><i class="ti-receipt"></i></a></td> -->
                                            </tr>
                                            <?php $room_sr = $room_sr+1; }  } ?>
                                        </tbody>
                                    </table>
                                </div>
                </div>
            </div>
            </div>

            <div class="row p-3" id="allRooms">
                
            </div>
        </div>
    </div>
    <!--- kiran chavan -->
    <!--- kiran chavan -->
    <!--- kiran chavan -->
    <div class="col-sm-6 col-md-6">
        <div class="card mb-4 flex-fill w-100">
            <!--Content Header (Page header)-->
            <div class="card-header">
                <div class="content-header row align-items-center g-0">
                    <div class="col-lg-12 col-xl-12 mb-3 header-title">
                        <div class="d-flex align-items-center justify-content-center justify-content-xl-start">
                            <h1 class="font-weight-bolder">Guest/Room Book</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.Content Header (Page header)-->
            <div class="row" style="padding: 10px;">
            <div class="col-sm-12">
                <div class="col-md-12 col-lg-12 col-xl-12 mb-3">
                    <div class="table-responsive">
                    <table width="100%" id="guset_room_list"
                                        class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo display('booking_number') ?></th>
                                                <th><?php echo display('room_no') ?></th>
                                                <th><?php echo display('customer') ?></th>
                                                <!-- <th><?php echo display('sl_no') ?></th> -->
                                                <th><?php echo display('room_name') ?></th>
                                                <th><?php echo display('check_in') ?></th>
                                                <th><?php echo display('check_out') ?></th>
                                                <th><?php echo display('number_of_person') ?></th>
                                                <th>Guest id</th>
                                                <!-- <th><?php echo display('booking_date') ?></th>
                                                <th><?php echo display('booking_status') ?></th>
                                                <th><?php echo display('payment_status') ?></th>
                                                <th><?php echo display('total_amount') ?></th>
                                                <th><?php echo display('paid_amount') ?></th>
                                                <th><?php echo display('due_amount') ?></th>
                                                <th><?php echo display('action') ?></th> -->
                                            </tr>
                                        </thead>
                                        <!-- <tfoot>
                                            <tr>
                                                <th colspan="8" style="text-align:right"><?php echo display('total') ?>:
                                                </th>
                                                <th></th>
                                                <th colspan="1" style="text-align:right"><?php echo display('due_amount'); ?>:
                                                </th>
                                                <th></th>
                                            </tr>
                                        </tfoot> -->
                                        <tbody>
                                            <?php $i=0; 
                                            $seprate_room = '';
                                            //var_dump($guest_room);
                                            $seprate_room       = ''; 
                                            $seprate_type       = '';
                                            $seprate_nuofpeople = ''; 
                                            foreach($guest_room as $book){
                                                $i++;
                                                $seprate_room       = explode(',', $book->room_no);  //var_dump("--".$book->room_no);
                                                $seprate_type       = explode(',', $book->roomtype);
                                                $seprate_nuofpeople = explode(',', $book->nuofpeople); 
                                                $room_sr = 0;
                                                foreach($seprate_room as $room){ 
                                                ?>
                                            <tr>
                                                <td><?php echo html_escape($book->booking_number);?></td>
                                                <td><?php echo $seprate_room[$room_sr];?></td>
                                                <td><?php echo html_escape($book->firstname.' '.$book->lastname);?></td>
                                                <!-- <td><?php echo $i;?></td> -->                      
                                                <td><?php echo html_escape($seprate_type[$room_sr]);//echo html_escape($book->roomtype);?></td>                 
                                                <td><?php echo html_escape($book->checkindate);?></td>
                                                <td><?php echo html_escape($book->checkoutdate);?></td>
                                                <td><?php echo html_escape($seprate_nuofpeople[$room_sr]);?></td>
                                                <td><?php echo html_escape($book->cutomerid);?></td>
                                                <!-- <td><?php echo html_escape($book->date_time);?></td>
                                                <td><?php if($book->bookingstatus==5){ echo display("checkout");} else if($book->bookingstatus==0){ echo display('pending');} else if($book->bookingstatus==1){ echo display("cancel");} else if($book->bookingstatus==4){ echo display("checkin");}?>
                                                </td>
                                                <td><?php if($book->bookingstatus==5){if($book->creditamt>0){echo display("credit");} else{ echo display('complete');}}else{if($book->total_price<=$book->paid_amount){echo display("complete");}else{echo display('pending');}}?>
                                                </td>
                                                <td><?php echo html_escape($book->total_price);?></td>
                                                <td><?php echo html_escape($book->paid_amount);?></td>
                                                <td><?php echo ($book->total_price-$book->paid_amount)<0 ? 0 : html_escape($book->total_price-$book->paid_amount);?></td>
                                                <td><a href="<?php echo base_url("reports/booking-details/".html_escape($book->bookedid)) ?>"
                                                        class="btn btn-success btn-sm" data-toggle="tooltip"
                                                        data-placement="top" data-original-title="Details"
                                                        title="Details"><i class="ti-eye"></i></a>&nbsp;<a
                                                        href="<?php echo base_url("reports/customer-reciept/".html_escape($book->bookedid)) ?>"
                                                        class="btn btn-success btn-sm" data-toggle="tooltip"
                                                        data-placement="top" data-original-title="Customer Invoice"
                                                        title="Customer Invoice"><i class="ti-receipt"></i></a></td> -->
                                            </tr>
                                            <?php $room_sr = $room_sr+1; }  } ?>
                                        </tbody>
                                    </table>
                                </div>
                </div>
            </div>
            </div>

            <div class="row p-3" id="allRooms">
                
            </div>
        </div>
    </div>
    <!--- kiran chavan -->



    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-green text-white">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><?php echo display("room_no") ?> : <span
                            id="number"></span> </h5>
                    <button type="button" class="bg-green border-0 fs-23" data-dismiss="modal"><i
                            class="hvr-buzz-out fas fa-times text-white "></i></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-3" id="list1">
                            <!-- <div class="col-12 col-lg-6" style="display:none;">
                                <p class="mb-0 p-2"><i class="hvr-buzz-out far fa-building mr-2"></i><?php echo display("booking_status") ?> :
                                </p>
                            </div>
                            <div class="col-12 col-lg-6" style="display:none;">
                                <div class="room-status">
                                    <p class="mb-0" id="status"></p>
                                </div>
                            </div> -->
                            <div class="col-12 col-lg-6">
                                <p class="mb-0 p-2"><i class="hvr-buzz-out far fa-user mr-2"></i></i><?php echo display("customer_name") ?> :</p>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="room-status">
                                    <p class="mb-0" id="customer"></p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <p class="mb-0 p-2"><i class="hvr-buzz-out fas fa-phone-alt mr-2"></i><?php echo display("customer")." ".display("phone") ?> :
                                </p>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="room-status">
                                    <p class="mb-0" id="phone"></p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <p class="mb-0 p-2"><i class="hvr-buzz-out far fa-calendar-alt mr-2"></i><?php echo display("checkin") ?> :</p>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="room-status">
                                    <p class="mb-0" id="checkin"></p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <p class="mb-0 p-2"><i class="hvr-buzz-out far fa-calendar-alt mr-2"></i><?php echo display("checkout") ?> :</p>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="room-status">
                                    <p class="mb-0" id="checkout"></p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <p class="mb-0 p-2"><i class="hvr-buzz-out far fa-calendar-alt mr-2"></i><?php echo display("roomtype") ?> :</p>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="room-status">
                                    <p class="mb-0" id="room_type"></p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <p class="mb-0 p-2"><i class="hvr-buzz-out fas fa-dollar-sign mr-2"></i><?php echo display("paid_amount") ?> :
                                </p>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="room-status">
                                    <p class="mb-0" id="paid_amount"></p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <p class="mb-0 p-2"><i class="hvr-buzz-out fas fa-dollar-sign mr-2"></i><?php echo display("due_amount") ?> :
                                </p>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="room-status">
                                    <p class="mb-0" id="due_amount"></p>
                                </div>
                            </div>
                            <?php $car_parking = $this->db->where('directory', 'car_parking')->where('status', 1)->get('module')->num_rows();
			                if ($car_parking == 1) { ?>
                            <div class="col-12 col-lg-6">
                                <p class="mb-0 p-2"><i class="hvr-buzz-out fas fa-car-side mr-2"></i><?php echo display("parking_status") ?> :
                                </p>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="room-status">
                                    <p class="mb-0" id="pstatus"></p>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="col-12 col-lg-6">
                                <p class="mb-0 p-2"><i class="hvr-buzz-out fas fa-map-marker-alt mr-2"></i><?php echo display("customer")." ".display("address") ?>
                                     :</p>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="room-status">
                                    <p class="mb-0 text-center" id="address"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3" id="list2">
                            <!-- <div class="col-12 col-lg-6">
                                <p class="mb-0 p-2"><i class="hvr-buzz-out far fa-building mr-2"></i><?php echo display("booking_status") ?> :
                                </p>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="room-status">
                                    <p class="mb-0" id="status1"><?php echo display("available") ?></p>
                                </div>
                            </div> -->
                            <div class="col-12 col-lg-6">
                                <p class="mb-0 p-2"><i class="hvr-buzz-out fas fa-list mr-2"></i><?php echo display("roomtype") ?> :</p>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="room-status">
                                    <p class="mb-0" id="roomType"></p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <p class="mb-0 p-2"><i class="hvr-buzz-out fas fa-dollar-sign mr-2"></i><?php echo display("rent_day") ?> :
                                </p>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="room-status">
                                    <p class="mb-0" id="rpd"></p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <p class="mb-0 p-2"><i class="hvr-buzz-out fas fa-male mr-2"></i><?php echo display("adults") ?> :
                                </p>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="room-status">
                                    <p class="mb-0" id="adults"></p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <p class="mb-0 p-2"><i class="hvr-buzz-out far fa-user mr-2"></i></i><?php echo display("extra_capacity") ?> :
                                </p>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="room-status">
                                    <p class="mb-0" id="extra"></p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <p class="mb-0 p-2"><i class="hvr-buzz-out fas fa-star mr-2"></i><?php echo display("rating") ?> :
                                </p>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="room-status">
                                    <p class="mb-0" id="rating"></p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-9">
                            </div>
                            <div class="col-12 col-lg-3">
                                <input type="button" id="bookNow" class="btn btn-success mb-1 mt-2 font-weight-bold"
                                    value="Book Now">
                            </div>
                        </div>
                        <div class="row" id="list3">
                            <div class="col-12">
                                <p><i class="hvr-buzz-out far fa-file-alt mr-1"></i> <?php echo display("note") ?> </p>
                                <div class="d-flex mb-2">
                                    <input type="text" class="form-control w-50" id="problem_note"
                                        placeholder="Note a problem" value="">
                                    <input type="hidden" id="bookedid" value="">
                                    <input type="hidden" id="roomno" value="">
                                    <button type="button" class="border-0 bg-transparent pr-0" id="save_note">
                                        <i class="hvr-buzz-out fas fa-plus-square fs-30 mb-2 text-success"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <div class="row">
                                    <div class="card p-2 shadow-lg w-100">
                                        <div class="card-header p-0 mb-2 d-flex justify-content-between ">
                                            <p class="mb-0 font-weight-bold fs-16"><?php echo display("problem_list") ?></p>
                                        </div>

                                        <div class="problem-item scroll-bar" id="problem_list">
                                        </div>
                                    </div>
                                </div>
                                <div class="i-check m-0 d-flex justify-content-between align-items-center mt-1">
                                    <label class="mb-0" for="flat-checkbox-1"></label>
                                    <button type="button" class="btn btn-success" id="solved">
                                    <?php echo display("solved") ?>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card p-2 shadow-lg">
                                            <div class="card-header p-0 mb-2">
                                                <p class="mb-0 font-weight-bold fs-16"><?php echo display("solved")." ".display("list") ?></p>
                                            </div>
                                            <ol class="mb-0 problem-item scroll-bar" id="solved_list">
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <!-- end modal -->
</div>
<script src="<?php echo MOD_URL.$module;?>/assets/js/timer.js"></script>
<script src="<?php echo MOD_URL.$module;?>/assets/js/roomlist.js"></script>