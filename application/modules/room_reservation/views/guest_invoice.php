<link type="text/css" href="<?php echo MOD_URL.$module;?>/assets/css/table.css">
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="card">

    <div class="row">
        <div class="col-sm-12">
            <div class="card-footer text-right">
                <a class="btn btn-info" onclick="printContent('printArea')" title="Print"><span
                        class="ti-printer text-white"></span>
                </a>
            </div>
            <div id="printArea">
                <div class="card-body">
                    <div class="row">
                    <div class="col-sm-8 text-center" style="margin-left: 185px">
                      <?php if(!empty($commoninfo->invoice_logo)){?>
                      <img src="<?php echo base_url();?><?php echo html_escape($commoninfo->invoice_logo)?>"
                      class="imgxs img-responsive" alt="" style="display: block; margin: 0 auto;"
                      width="230px" height="95px">
                     <?php }?>
                   </div>


                        <div class="col-sm-8 text-center" style="padding-top: 35px; margin-left: 185px">
                            <p class="p_bottom_m_bottom"><strong
                                    class="b_padding_border_font"><?php echo display('guest_registration_card') ?></strong>
                            </p>
                            <h4 class="f_size_22px"><?php echo html_escape($storeinfo->storename);?></h4>
                            <p class="f_size_18px"> <?php echo html_escape($storeinfo->address);?></p>
                        </div>
                        <div class="col-sm-2">&nbsp;</div>
                        <div class="col-xs-12 table-responsive p_bootom " height="500%">
                        <style>
                          .center-table {
                              width: 60%;
                              margin: 0 auto; 
                              margin-left: 20%; 
                              margin-right: 10%; 
                              line-height: 2.5;
                            }
                      </style>
                        
                        <?php 
                          $datediff = strtotime($bookinfo->checkoutdate) - strtotime ($bookinfo->checkindate);
                          $datediff = ceil($datediff/(60*60*24));
                          $totalnight = $datediff;
                        ?>
                         <table  border="1.5" class="center-table">
                           <tr style=>
                             <th><?php echo display('name_of_the_guest') ?></th>
                           </tr>
                          <tr>
                             <td><strong>1. <?php echo html_escape($customerinfo->firstname.' '. $customerinfo->lastname);?></strong> </td> 
                             
                          </tr>
                           <tr>
                               <td><strong>2. </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                               
                           </tr>
                           <tr>
                               <td>&nbsp;</td>
                           </tr>
                           <tr>
                               <td><strong><?php echo display('booking_number') ?>:
                                </strong><?php echo html_escape($bookinfo->booking_number);?></td>
                           </tr>
                           <tr>
                               <td><strong><?php echo display('add') ?>:
                                </strong><?php echo html_escape($customerinfo->address);?></td>
                           </tr>
                           <tr>
                               <td><strong><?php echo display('dob') ?>:
                                </strong><?php echo html_escape($customerinfo->dob);?></td>
                           </tr>
                           <tr>
                               <td><strong><?php echo display('mobile') ?>:
                                </strong><?php echo html_escape($customerinfo->cust_phone);?></td>
                           </tr>
                           <tr>
                            <td colspan="2"><strong><?php echo display('passport_no') ?>:
                            </strong><?php echo html_escape($customerinfo->profession);?></td>
                           </tr>
                           <tr>
                            <td colspan="2"><strong><?php echo display('nationality') ?>: </strong><input
                              type="checkbox"
                              <?php if($customerinfo->isnationality=='native'){display('checked');}?>
                              disabled="disabled" name="isnationality" value="Native">
                              <?php echo html_escape($storeinfo->country);?>
                              <input type="checkbox"
                              <?php if($customerinfo->isnationality=='foreigner'){display('checked');}?>
                              disabled="disabled" name="isnationality" id="materialInline2"
                              value="Foreign"> <?php echo display('foreign') ?>
                            </td>
                           </tr>
       
                            <tr>
                                <td><strong><?php echo display('national_id') ?>:
                                    </strong><?php echo html_escape($customerinfo->pid);?></td>
                            </tr>
                        </table>
                      
                      <table  border="1.5" class="center-table">
                          <tr>
                            <th colspan="1"><?php echo display('for_foreign_guest') ?></th>
                          </tr>
                          <tr>
                            <td colspan="1"><strong>1.</strong></td>
                          </tr>
                          <tr>
                            <td colspan="1"><strong>2.</strong></td>
                          </tr>
                          <tr>
                             <td colspan="1"><strong><?php echo display('add') ?>:
                             </strong><?php echo html_escape($customerinfo->address);?></td>
                          </tr>
                          <tr>
                              <td colspan="1"><strong><?php echo display('nationality') ?>: </strong>
                              <?php echo html_escape($customerinfo->nationality);?></td>
                          </tr>
                          <tr>
                             <td colspan="1"><strong><?php echo display('passport_no') ?>: </strong>
                             <?php echo html_escape($customerinfo->passport);?></td>
                          </tr>
                          <tr>
                              <td><strong><?php echo display('visa_reg_no') ?>:
                              </strong><?php echo html_escape($customerinfo->visano);?></td>
                          </tr>
        
                          <tr>
                            <td><strong><?php echo display('purpose') ?>: </strong>
                                <input type="checkbox"
                                    <?php if($customerinfo->purpose=='Tourist'){ echo display('checked');}?>
                                    disabled="disabled" name="isnationality" value="Tourist">
                                 <?php echo display('tourist') ?>
                               <input type="checkbox"
                                   <?php if($customerinfo->purpose=='Business'){ echo display('checked');}?>
                                   disabled="disabled" name="isnationality" value="Business">
                                  <?php echo display('business') ?>
                                  <input type="checkbox"
                                <?php if($customerinfo->purpose=='Official'){ echo display('checked');}?>
                                disabled="disabled" name="isnationality" value="Official">
                                 <?php echo display('official') ?>
                            </td>
                         </tr>
                       </table>
    
                        <table  border="1.5" class="center-table">
    
                            <tr>
                                <td><strong><?php echo display('checkin_date') ?>:
                                    </strong><?php echo html_escape($bookinfo->checkindate);?></td>
                            </tr>
                           <tr>
                               <td><strong><?php echo display('checkout_date') ?>:
                                   </strong><?php echo html_escape($bookinfo->checkoutdate);?></td>
                           </tr>
                           <tr>
                               <td><strong><?php echo display('try_duration') ?>:
                                   </strong><?php echo html_escape($totalnight);?> <?php echo display('nights') ?>
                               </td>
                           </tr>
                           <tr>
                               <td><strong><?php echo display('checkin_time') ?>:
                                   </strong><?php echo html_escape($storeinfo->checkouttime);?>
                                   <?php echo display('noon') ?></td>
                           </tr>
                            <tr>
                                <td><strong><?php echo display('checkout_time') ?>:
                                    </strong><?php echo html_escape($storeinfo->checkouttime);?>
                                    <?php echo display('noon') ?></td>
                            </tr>
                      </table>

                        <br>
                        <div class="col-sm-4 pl-0 pt-4" style="margin-left: 350px;" >
                        
                            <table width="100%" border="1" style= "line-height:2.5"> 
                                <tr >
                                    <td class="text-center"><?php echo display('room') ?></td>
                                    <td class="text-center"><?php echo display('adults') ?></td>
                                    <td class="text-center"><?php echo display('defaultrate') ?></td>
                                    <td class="text-center">Total</td>
                                </tr>
                                <tr style="height: 50px;">
                                    <td class="text-center"><?php echo html_escape($bookinfo->room_no);?></td>
                                    <td class="text-center"><?php echo html_escape($bookinfo->nuofpeople);?></td>
                                    <td class="text-center">&#x20b9; <?php echo html_escape($bookinfo->roomrate);?>
                                    <td class="text-center">&#x20b9; <?php 
                                     $roomrate   = explode(",",$bookinfo->roomrate);
                                     $roomrateSum = array_sum($roomrate);
                                    echo html_escape($roomrateSum) * html_escape($totalnight);?></td>
                                </tr>

                            </table>
                        
                        </div>
                    </div>
                </div>
                <br>
                    <div class="container-fluid">
                      <div class="row justify-content-center">
                     <div class="col-sm-4  pt-4  d-flex justify-content-center" style="margin-left:    38px;" > 
                         <table width="100%" border="1">
                             <tr style="height:50px;">
                                <td>&nbsp;</td>
                             </tr>   
                            
                             <tr >
                                <td class="text-center">
                                <strong><?php echo display('font_desk_office_signature') ?><strong></td>
                             </tr>
                        </table>
                        </div>
                        <div class="col-sm-4 pr-0  pt-4  d-flex justify-content-center">
                            <table width="100%" border="1">
                                <tr style="height: 50px;" >
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><strong><?php echo display('guest_signature') ?></strong>
                                    </td>
                                </tr>

                            </table>
                        </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</div>