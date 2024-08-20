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

<?php $sl = 1; ?>
<?php foreach ($roomlist as $list) { ?>
<?php 
    if(empty($list->date)){
        $list->date = date("Y-m-d");
    }
    $room_type = $this->db->select("roomtype")->from("roomdetails")->where("roomid", $list->roomid)->get()->row();
    $room_image = $this->db->select("room_imagename")->from("room_image")->where("room_id", $list->roomid)->get()->row();
    $floor = $this->db->select("floorname")->from("tbl_floor")->where("floorid", $list->floorid)->get()->row();
?>
<?php 
    $id = $this->db->select("bookedid,bookingstatus,checkoutdate")->from("booked_info")->where("date(checkindate)<=",$list->date)->where("date(checkoutdate)>=",$list->date)->where("FIND_IN_SET(".$list->roomno.",room_no)<>",0)->where_in("bookingstatus",array(0,4))->get()->row();

    //kiran
    $new_time  = date("Y-m-d H:i:s", strtotime('-1 hours', strtotime($id->checkoutdate)));
    $curr_time = date("Y-m-d H:i:s");
      //var_dump($id->checkoutdate); var_dump($new_time);  var_dump($curr_time); 
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
            class="overlay-<?php  if($id->checkoutdate >= $new_time && $id->checkoutdate >= $curr_time){echo "darkred";}elseif($list->status==2 | $list->status==4){echo "green";} if($list->status==1){echo "black";} if($list->status==0){echo "red";}?> px-4 py-3 text-center text-white position-absolute">
            <h2 class="fs-21 mt-3 font-weight-bold">
                <?php echo display('floor_name')." "; echo html_escape($floor->floorname); ?></h2>
            <h3 class="fs-21 mt-3 font-weight-bold">
                <?php echo display('room_no')." "; echo html_escape($list->roomno); ?></h3>
            <p class="mb-1">
                <?php echo display('room_name')." :"; echo html_escape($room_type->roomtype); ?></p>
            <?php
                            if($list->status==2 | $list->status==4 | $list->status==0){
                                    $time = $this->db->select("checkoutdate")->from("booked_info")->where("date(checkindate)<=",$list->date)->where("date(checkoutdate)>=",$list->date)->where("FIND_IN_SET(".$list->roomno.",room_no)<>",0)->where_in("bookingstatus",array(0,4))->get()->row();
                                    if(!empty($time->checkoutdate)){
                                    $diff = strtotime($time->checkoutdate) - strtotime($list->date);
                                    $dur = $time->checkoutdate;
                                    echo " "; ?>
            <p class="mb-1 <?php if($id->checkoutdate >= $new_time && $id->checkoutdate >= $curr_time){echo "blink";} ?>">
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
            <input type="hidden" id="date_time" value="<?php echo $list->date; ?>">
            <button type="button"
                class="btn btn-<?php if($list->status==2 | $list->status==4){echo "primary";} if($list->status==1){echo "success";} if($list->status==0){echo "warning";}?> mb-2 font-weight-bold <?php if($id->checkoutdate >= $new_time && $id->checkoutdate >= $curr_time){echo "blink";} ?>" 
                id="<?php echo empty($id)?"":"b_".$id->bookedid; ?>" value="<?php echo $list->roomno; ?>" data-toggle="modal"
                onclick="Detail(<?php echo empty($id)?0:$id->bookedid; ?>,<?php echo $list->roomno; ?>)" data-target="#exampleModal1"><?php echo html_escape($status[$list->status]); ?></button>
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
                <?php } $sl++; ?> <!-- kiran chavan -->
<?php } ?>
<script src="<?php echo MOD_URL.$module;?>/assets/js/timer.js"></script>