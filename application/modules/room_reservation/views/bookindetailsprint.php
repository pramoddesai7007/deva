<link type="text/css" href="<?php echo MOD_URL;?>room_reservation/assets/css/table.css">
<div class="card">
    <div class="card-body" id="printArea">
        <?php
        $firstdate = $bookinfo->checkindate;
        $lastdate = $bookinfo->checkoutdate;
        $datediff = strtotime($lastdate) - strtotime($firstdate);
        $datediff = ceil($datediff/(60*60*24));
      //  $total_price = $bookinfo->total_price*$datediff
         ?>
        <!--div class="row">
            <div class="col-sm-6">
                <img src="<?php echo base_url();?><?php echo html_escape(!empty($commominfo->invoice_logo)?$commominfo->invoice_logo: 'assets/img/header-logo.png')?>" class="img-fluid mb-3" alt="">
                <br>
                <address>
                    <strong><?php echo html_escape($storeinfo->storename);?></strong><br>
                    <?php echo html_escape($storeinfo->address);?><br>
                <abbr title="Phone"><?php echo display('mobile') ?>:</abbr> <?php echo html_escape($storeinfo->phone);?>
            </address>
            <address>
                <strong><?php echo display('email') ?></strong><br>
                <a href="mailto:#"><?php echo html_escape($storeinfo->email);?></a>
            </address>
        </div>
        <?php
            $firstdate = $bookinfo->checkindate;
            $lastdate = $bookinfo->checkoutdate;
            $datediff = strtotime($lastdate) - strtotime($firstdate);
            $datediff = ceil($datediff/(60*60*24));
        ?>
        <div class="col-sm-6 text-right">
            <h1 class="h3"><?php echo display('booking_number') ?> #<?php echo html_escape($bookinfo->booking_number);?></h1>
            <div><?php echo display('booking_date') ?>: <?php echo html_escape($bookinfo->date_time);?></div>
            <div class="text-danger m-b-15"><?php echo display('payment_status') ?>:
                <?php if(isset($bookinfo->paid_amount)){?>
                <?php if($bookinfo->paid_amount < $bookinfo->total_price*$datediff){ echo display("unpaid");}else{ echo display("paid");}?>
                <?php } else{echo display("unpaid");}?>
            </div>
            <address>
                <strong><?php echo display('guest_info') ?></strong><br>
                <?php echo html_escape((!empty($customerinfo->firstname)?$customerinfo->firstname.' '.$customerinfo->lastname:'User Deleted'));?><br>
                <?php echo display('address') ?>: <?php echo html_escape(!empty($customerinfo->address)?$customerinfo->address:null);?><br>
            <abbr title="Phone"><?php echo display('mobile') ?>:</abbr> <?php echo html_escape(!empty($customerinfo->cust_phone)?$customerinfo->cust_phone:null);?>
        </address>
        <address>
            <strong><?php echo display('email') ?></strong><br>
            <a href="mailto:#"><?php echo html_escape(!empty($customerinfo->email)?$customerinfo->email:null);?></a>
        </address>
    </div>
</div-->
<!--div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <tbody>
            <tr>
                <td>
                    <div><strong><?php echo display('roomtype') ?></strong></div>
                </td>
                <?php
                    $allroomtype="";
                    $roomid = explode(",",$bookinfo->roomid);
                    for($i=0;$i<count($roomid); $i++){
                        $roomtype = $this->db->select("roomtype")->from("roomdetails")->where("roomid",$roomid[$i])->get()->row();
                        $allroomtype .= $roomtype->roomtype.",";
                    }
                 ?>
                <td><?php echo trim($allroomtype,",");?></td>
            </tr>
            <tr>
                <td>
                    <div><strong><?php echo display('room_no') ?></strong></div>
                </td>
                <td><?php echo html_escape(!empty($bookinfo->room_no)?$bookinfo->room_no:null);?></td>
            </tr>
            <tr>
                <td>
                    <div><strong><?php echo display('checkin') ?></strong></div>
                </td>
                <td><?php echo html_escape($bookinfo->checkindate);?></td>
                <tr>
                    <td>
                        <div><strong><?php echo display('checkout') ?></strong></div>
                    </td>
                    <td><?php echo html_escape($bookinfo->checkoutdate);?></td>
                </tr>
                <tr>
                    <td>
                        <div><strong><?php echo display('booking_status') ?></strong></div>
                    </td>
                    <td><?php if($bookinfo->bookingstatus==0){ echo display('pending');}if($bookinfo->bookingstatus==2){ echo display('complete');}if($bookinfo->bookingstatus==1){ echo display("cancel");}if($bookinfo->bookingstatus==4){ echo display("checkin");}if($bookinfo->bookingstatus==5){ echo display("checkout");}?></td>
                </tr>
                <tr>
                    <td>
                        <div><strong><?php echo display('adults') ?></strong></div>
                    </td>
                    <td><?php echo html_escape($bookinfo->nuofpeople);?></td>
                </tr>
                <tr>
                    <td>
                        <div><strong><?php echo display('number_of_rooms') ?></strong></div>
                    </td>
                    <td><?php echo html_escape($bookinfo->total_room);?></td>
                    <?php if($bookinfo->coments=="Booking from admin"){
                        $totalroom=1;
                    }else{
                        $totalroom = $bookinfo->total_room;
                    } ?>
                </tr>
                <tr>
                    <td>
                        <div><strong><?php echo display('nights') ?></strong></div>
                    </td>
                    <td><?php
                            echo html_escape($datediff);
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped table-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo display('date') ?></th>
                    <th><?php echo display('price') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                                    $totaldiscount=0;
                                    $roomrate=0;
                                    $x=0;
                                    $total=0;
                                    $roomId = explode(",", $bookinfo->roomid);
                                    $roomRate = explode(",", $bookinfo->roomrate);
                                    $disamount = $this->db->select("discountamount")->from("booked_details")->where("bookedid", $bookinfo->bookedid)->get()->row();
                                    for($li = 0; $li < count($roomId); $li++){
                                        for($i = 0; $i < $datediff; $i++){
                                        $alldays= date("Y-m-d", strtotime($firstdate . ' + ' . $i . 'day'));
                                        $x++;
                                        $getroom=$this->db->select("*")->from('tbl_room_offer')->where('roomid',$roomId[$li])->where('offer_date',$alldays)->get()->row();
                                        if(!empty($getroom)){
                                            $singleDiscount=$getroom->offer*$totalroom;
                                            $totaldiscount=$totaldiscount+$singleDiscount;
                                            $roomrate=$roomRate[$li];
                                            }
                                        else{
                                            $roomrate=$roomRate[$li];
                                            }
                                        $price=($totalroom*$roomrate);
                                        $total=$total+$price;
                    ?>
                    <tr>
                        <td>
                            <div><strong><?php echo $x;?></strong></div>
                        </td>
                        <td><?php echo html_escape($alldays);?></td>
                        <td><?php echo html_escape($roomrate);?></td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div-->
    <!--div class="row">
        <div class="col-sm-8">
        </div>
        <div class="col-sm-4">
            <ul class="list-unstyled text-right">
                <li>
                    <strong><?php echo display('subtotal'); ?>:</strong> <?php $grprice=$totalroom*$total;
                    $grprice=$grprice;
                    echo (($grprice!=0)?$grprice:$grprice=$total); $grprice -= $disamount->discountamount*$datediff;?>
                </li>
                <?php $totaltax = 0; ?>
                <?php if(empty($btaxinfo->bookedid)){ ?>
                    <?php foreach($taxinfo as $tax){ ?>
                    <li>
                        <strong><?php echo html_escape($tax->taxname); ?> <?php echo html_escape($tax->rate);?>%:</strong> <?php $singletax=0; $singletax=$tax->rate*$grprice/100;
                        echo html_escape($singletax); $totaltax+=$singletax; ?>
                    </li>
                    <?php } ?>
                <?php }else{ ?>
                    <?php $taskname = explode(",", $btaxinfo->taskname);
                    $rate = explode(",", $btaxinfo->rate); ?>
                    <?php for($bt=0; $bt<count($taskname); $bt++){ ?>
                    <li>
                        <strong><?php echo html_escape($taskname[$bt]); ?> <?php echo html_escape($rate[$bt]);?>%:</strong> <?php $singletax=0; $singletax=$rate[$bt]*$grprice/100;
                        echo html_escape($singletax); $totaltax+=$singletax; ?>
                    </li>
                    <?php } ?>
                <?php } ?>
                <li>
                    <strong><?php echo display('tax') ?> :</strong> <?php echo html_escape($totaltax);?>
                </li>
                <?php if($bookinfo->bookingstatus==5){ ?>
                    <?php if(isset($btaxinfo->complementary)){ ?>
                        <li>
                            <strong><?php echo display('complementary') ?> :</strong> <?php echo html_escape($btaxinfo->complementary);?>
                        </li>
                    <?php } ?>
                    <?php if(isset($btaxinfo->extrabpc)){ ?>
                        <li>
                            <strong><?php echo display("extra_bpc"); ?> :</strong> <?php echo html_escape($btaxinfo->extrabpc);?>
                        </li>
                    <?php } ?>
                    <?php if(isset($btaxinfo->ex_discount)){ ?>
                        <li>
                            <strong><?php echo display('discount') ?> :</strong> <?php echo html_escape($btaxinfo->ex_discount);?>
                        </li>
                        <?php $percent = ($btaxinfo->ex_discount*100)/$grprice;
                            $reducetax = ($totaltax*$percent)/100;
                            $totaltax-=$reducetax;
                         ?>
                    <?php } ?>
                    <?php if(isset($btaxinfo->additional_charges)){ ?>
                        <li>
                            <strong><?php echo display("additional_charges"); ?> :</strong> <?php echo html_escape($btaxinfo->additional_charges);?>
                        </li>
                    <?php } ?>
                    <?php if(isset($btaxinfo->special_discount)){ ?>
                        <li>
                            <strong><?php echo display("special_discount"); ?> :</strong> <?php echo html_escape($btaxinfo->special_discount);?>
                        </li>
                    <?php } ?>
                    <?php if(isset($btaxinfo->swimming_pool)){ ?>
                        <li>
                            <strong><?php echo display("swimming_pool"); ?> :</strong> <?php echo html_escape($btaxinfo->swimming_pool);?>
                        </li>
                    <?php } ?>
                    <?php if(isset($btaxinfo->restaurant)){ ?>
                        <li>
                            <strong><?php echo display("restaurant"); ?> :</strong> <?php echo html_escape($btaxinfo->restaurant);?>
                        </li>
                    <?php } ?>
                    <?php if(isset($btaxinfo->hallroom)){ ?>
                        <li>
                            <strong><?php echo display("hall_room"); ?> :</strong> <?php echo html_escape($btaxinfo->hallroom);?>
                        </li>
                    <?php } ?>
                    <?php 
                    $postedbill =  $btaxinfo->complementary+$btaxinfo->extrabpc-$btaxinfo->ex_discount+$btaxinfo->additional_charges-$btaxinfo->special_discount+$btaxinfo->swimming_pool+$btaxinfo->restaurant+$btaxinfo->hallroom; 
                }else{
                    $postedbill = 0;
                    $reducetax = 0;
                }
                ?>
                <li>
                    <strong><?php echo display('grand_total') ?>:</strong> <?php if($currency->position==1){echo html_escape($currency->curr_icon);}?><?php echo number_format($totaltax+$postedbill+$grprice,2);?><?php if($currency->position==2){echo html_escape($currency->curr_icon);}?>
                    <br /><strong><?php echo display('paid_amount') ?>:</strong> <?php if($currency->position==1){echo html_escape($currency->curr_icon);}?><?php if (!empty($bookinfo->paid_amount)){echo $bookinfo->paid_amount+$postedbill-$reducetax;} else echo "0";?><?php if($currency->position==2){echo html_escape($currency->curr_icon);}?>
                    <br /><strong><?php echo display('due_amount') ?>:</strong> <?php if($currency->position==1){echo html_escape($currency->curr_icon);}?><?php if (!empty($bookinfo->paid_amount)){echo ($grprice+$totaltax+$postedbill+$reducetax)-($bookinfo->paid_amount+$postedbill);} else echo html_escape($grprice+$totaltax+$postedbill);?><?php if($currency->position==2){echo html_escape($currency->curr_icon);}?>
                </li>
            </ul>
        </div>
    </div-->


<table class="table table-striped table-hover" ><tr><td style="padding: 40px;padding-top: 10px;padding-bottom: 10px;border: 1px solid black;" celspacing="0">
    <div class="table-responsive">
    <table class="table table-striped table-hover" cellspacing="0">
        <tbody>
            <tr>
                <td colspan="3" style="border: 1px solid black;border-right: none;">
                    <div><img src="<?php echo base_url();?><?php echo html_escape(!empty($commominfo->invoice_logo)?$commominfo->invoice_logo: 'assets/img/header-logo.png')?>" class="img-fluid mb-3" alt=""></div>
                </td>
                <td colspan="8" style="border: 1px solid black;border-left: none;text-align: left;">
                    <address>
                    <strong><h2><?php echo html_escape($storeinfo->storename);?></strong></h2>
                    <strong>Address :-</strong><?php echo html_escape($storeinfo->address);?><br>
                    <strong>Contact No :-</strong><?php echo html_escape($storeinfo->phone);?><br>
                    <strong><?php echo display('email') ?>:-</strong>
                    <a href="mailto:#"><?php echo html_escape($storeinfo->email);?></a>
                    </address>
                </td>
            </tr>
            <tr>
                <td colspan="11" style="border: none;">
                    <div style="padding: 5px;">
                        
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;border: 1px solid black;border-bottom: none;border-right: none;">
        Bill No. : <?php echo html_escape($bookinfo->booking_number);?>
                </td>
                <td colspan="5" style="text-align: center;border: 1px solid black;border-bottom: none;border-right: none;border-left: none;">
        <span style="font-size:17px;font-weight: bold;color:#17a2b8;">Reservation Details</span>
                </td>
                <td colspan="3" style="text-align: center;border: 1px solid black;border-bottom: none;border-left: none;">
        Booking Date : <?php echo date('d-m-Y h:i:s A',strtotime($bookinfo->date_time));?>
                </td>
            </tr>
            <tr>
                <td colspan="11" style="border: 1px solid black;border-top: none;">
                    <div style="padding: 5px;border: 1px solid black;border-radius: 10px;margin: 20px;margin-top: 5px;">
                        <table style="width:100%;border:none;">
                            <tr>
                                <td style="border:none;">Grc No :</td>
                                <td style="border:none;"></td>
                                <td style="border:none;">Arrival Date :</td>
                                <td style="border:none;"><?php echo date('d-m-Y',strtotime($bookinfo->checkindate));?></td>
                            </tr>
                            <tr>
                                <td style="border:none;">Group/CrewId :</td>
                                <td style="border:none;"></td>
                                <td style="border:none;">Arrival Time :</td>
                                <td style="border:none;"><?php echo date('h:i:s A',strtotime($bookinfo->checkindate));?></td>
                            </tr>
                            <tr>
                                <td style="border:none;">Name :</td>
                                <td style="border:none;"> <?php echo html_escape($bookinfo->firstname.' '.$bookinfo->lastname);?></td>
                                <td style="border:none;">Departure Date :</td>
                                <td style="border:none;"><?php echo date('d-m-Y',strtotime($bookinfo->checkoutdate));?></td>
                            </tr>
                            <tr>
                                <td style="border:none;">Address :</td>
                                <td style="border:none;"></td>
                                <td style="border:none;">Departure Time :</td>
                                <td style="border:none;"><?php echo date('h:i:s A',strtotime($bookinfo->checkoutdate));?></td>
                            </tr>
                            <tr>
                                <td style="border:none;">Contact :</td>
                                <td style="border:none;"><?php echo date('h:i:s A',strtotime($bookinfo->cust_phone));?></td>
                                <td style="border:none;"></td>
                                <td style="border:none;"></td>
                            </tr>
                            <tr>
                                <td style="border:none;">Booking Type :</td>
                                <td style="border:none;">
                                    <?php $bookingtype = $this->db->select("booktypetitle")->from("bookingtype")->where("booktypeid",$bookinfo->booking_type)->get()->row(); 
                                    echo $bookingtype->booktypetitle;
                                    ?>
                                </td>
                                <td style="border:none;"></td>
                                <td style="border:none;"></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <th style="border: 1px solid black;text-align:center;">
                    Room No.
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    Room Type
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    Duration
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    No. Person
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    Discount
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    Gst Amt
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    Extra Bed
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    Extra Person
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    Extra Child
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    RoomTotal Amt.
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    Totalwith Gst
                </th>
            </tr>
            <?php 
            //echo "----";
            //var_dump($bookinfo);
            $typeid         = explode(",",$bookinfo->roomid);    
            $separateroomno = explode(',', $bookinfo->room_no);
            $nuofpeople     = explode(",",$bookinfo->nuofpeople); 
            $gstamt     = explode(",",$bookinfo->gstamt);   
            $roomrate     = explode(",",$bookinfo->roomrate);  
            $extrabed    = explode(",",$bookinfo->extrabed); 
            $extraperson    = explode(",",$bookinfo->extraperson); 
            $extrachild    = explode(",",$bookinfo->extrachild); 
            $i = 0;
            $count = count($separateroomno);
            foreach($separateroomno as $room){
                $roomtype = $this->db->select("roomtype, bedcharge, personcharge")->from("roomdetails")->where("roomid",$typeid[$i])->get()->row();

                $loc_extrabed[$i] = $extrabed[$i] * $roomtype->bedcharge * $datediff;
                $loc_extraperson[$i] = $extraperson[$i] * $roomtype->personcharge * $datediff;
                $loc_extrachild[$i] = $extrachild[$i] * ($roomtype->personcharge / 2) * $datediff;

                $loc_roomrate_bpc[$i] = ($roomrate[$i]* $datediff) + ($loc_extrabed[$i])+($loc_extraperson[$i])+($loc_extrachild[$i]);
                
               
            ?>
            <tr>
                <th style="border: 1px solid black;text-align:center;">
                    <?php echo $room;?>
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    <?php echo $roomtype->roomtype; ?>
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    <?php echo $datediff." Nights";?>
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    <?php echo $nuofpeople[$i];?>
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    <?php echo "0"; //html_escape($bookinfo->discountamount);?>
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    <?php echo $gstamt[$i]; // echo html_escape($bookinfo->total_gstamt);?>
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    <?php echo $loc_extrabed[$i]?>
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    <?php echo $loc_extraperson[$i]?>
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    <?php echo $loc_extrachild[$i]?>
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    <?php echo $loc_roomrate_bpc[$i]?>
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    <?php echo $loc_roomrate_bpc[$i]; $tot_price += $loc_roomrate_bpc[$i];?>
                </th>
            </tr>      
            <?php $i++;  } ?>
            <tr>
                <th colspan="10" style="text-align: right;border: 1px solid black;">Grand Total</th>
                <th style="border: 1px solid black;"><?php echo $tot_price; ?></th>
            </tr>    
            </tbody>
        </table>
    </div>
</td></tr></table>

</div>
<div class="card-footer">
    <button type="button" class="btn btn-info mr-2 print-list"onclick="printContent('printArea')"><span
    class="fa fa-print"></span></button>
</div>
</div>
<script src="<?php echo MOD_URL;?>room_reservation/assets/js/print.js"></script>
