<?php 
require_once(APPPATH.'libraries/tcpdf/tcpdf.php'); 

class MYPDF extends TCPDF {

    //Page header
   

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-9);
        $this->SetX(-10);
        // Set font
        //$this->SetFont('calibri', '',8);
        // Page number
            $this->SetY(-20);
         $this->SetX(20);
         //$this->Cell(0, 10, 'Prepared By Tuljai HR Services ', 0, false, 'L', 0, '', 0, false, 'T', 'M');
    }
}
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->setPrintHeader(false);
// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell marg,ins
$pdf->setCellMargins(1, 1.2, 1, 1);
// set margins
$pdf->SetMargins(5, 5, 5, 5);
//$pdf->SetMargins(PDF_MARGIN_LEFT,PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// $pdf->setPageOrientation('L');

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//var_dump(dirname(__FILE__).'/lang/eng.php');die;
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell marg,ins
$pdf->setCellMargins(1, 1.2, 1, 1);
// set font
//$pdf->SetFont('calibri', '', 12);

// add a page
$pdf->AddPage();

// set some text to print

  //$leave=1;
$bookingtype = $this->db->select("booktypetitle")->from("bookingtype")->where("booktypeid",$bookinfo->booking_type)->get()->row();

$table .=   '<html><body>';
$table .='    <table style="width:100%;" >
<tr><td style="border: 1px solid black";>
    <div class="table-responsive">
    <table class="table table-striped table-hover" >
        <tbody>
<tr>
                <td colspan="2" style="border: 1px solid black;border-right: none;">
                    <div><img src="'.base_url().html_escape(!empty($commominfo->invoice_logo)?$commominfo->invoice_logo: 'assets/img/header-logo.png').'" class="img-fluid mb-3" alt=""></div>
                </td>
                <td colspan="6" style="border: 1px solid black;border-left: none;text-align: left;">
                    <address>
                    <strong><h2>&nbsp;'.html_escape($storeinfo->storename).'</strong></h2>
                    <strong>&nbsp;&nbsp;Address :-</strong>'.html_escape($storeinfo->address).'<br>
                    <strong>Contact No :-</strong>'.html_escape($storeinfo->phone).'<br>
                    <strong>'.display('email').':-</strong>
                    <a href="mailto:#">'.html_escape($storeinfo->email).'</a>
                    </address>
                </td>
            </tr>  
            <tr>
                <td colspan="8" style="border: none;">
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;border-top: 1px solid black;border-left: 1px solid black;">
        Bill No. : '.html_escape($bookinfo->booking_number).'
                </td>
                <td colspan="4" style="text-align: center;border-top: 1px solid black;">
        <span style="font-size:17px;font-weight: bold;color:#17a2b8;">Reservation Details</span>
                </td>
                <td colspan="2" style="text-align: center;border-top: 1px solid black;border-right: 1px solid black;">
        Booking Date : '.date('d-m-Y h:i:s A',strtotime($bookinfo->date_time)).'
                </td>
            </tr>
        <tr>
            <td colspan="8" style="border: 1px solid black;margin:40px;">
                    <table style="padding:2px;">
                        <tr>
                            <td style="border:none;">Grc No :</td>
                            <td style="border:none;"></td>
                            <td style="border:none;">Arrival Date :</td>
                            <td style="border:none;">'.date('d-m-Y',strtotime($bookinfo->checkindate)).'</td>
                        </tr>
                        <tr>
                            <td style="border:none;">Group/CrewId :</td>
                            <td style="border:none;"></td>
                            <td style="border:none;">Arrival Time :</td>
                            <td style="border:none;">'.date('h:i:s A',strtotime($bookinfo->checkindate)).'</td>
                        </tr>
                        <tr>
                            <td style="border:none;">Name :</td>
                            <td style="border:none;"> '.html_escape($bookinfo->firstname.' '.$bookinfo->lastname).'</td>
                            <td style="border:none;">Departure Date :</td>
                            <td style="border:none;">'.date('d-m-Y',strtotime($bookinfo->checkoutdate)).'</td>
                        </tr>
                        <tr>
                            <td style="border:none;">Address :</td>
                            <td style="border:none;"></td>
                            <td style="border:none;">Departure Time :</td>
                            <td style="border:none;">'.date('h:i:s A',strtotime($bookinfo->checkoutdate)).'</td>
                        </tr>
                        <tr>
                            <td style="border:none;">Contact :</td>
                            <td style="border:none;">'.date('h:i:s A',strtotime($bookinfo->cust_phone)).'</td>
                            <td style="border:none;"></td>
                            <td style="border:none;"></td>
                        </tr>
                        <tr>
                            <td style="border:none;">Booking Type :</td>
                            <td style="border:none;">
                                '.$bookingtype->booktypetitle.'
                            </td>
                            <td style="border:none;"></td>
                            <td style="border:none;"></td>
                        </tr>
                    </table>
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
                    No. Person
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    Discount
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    Gst Amt
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    Extra Person
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    RoomTotal Amt.
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    Totalwith Gst
                </th>
            </tr>';
            //echo "----";
            //var_dump($bookinfo);
            $typeid         = explode(",",$bookinfo->roomid);    
            $nuofpeople     = explode(",",$bookinfo->nuofpeople);      
            $separateroomno = explode(',', $bookinfo->room_no);
            $extraperson    = explode(",",$bookinfo->extraperson); 
            $i = 0;
            $count = count($separateroomno);
            foreach($separateroomno as $room){
                $roomtype = $this->db->select("roomtype")->from("roomdetails")->where("roomid",$typeid[$i])->get()->row();
            $table .='<tr>
                <th style="border: 1px solid black;text-align:center;">
                    '.$room.'
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    '.$roomtype->roomtype.'
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    '.$nuofpeople[$i].'
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    0
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    '.html_escape($bookinfo->total_gstamt).'
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    '.$extraperson[$i].'
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    '.html_escape($bookinfo->total_price-$bookinfo->total_gstamt).'
                </th>
                <th style="border: 1px solid black;text-align:center;">
                    '.html_escape($bookinfo->total_price).'
                </th>
            </tr> ';    
            $tot_price += $bookinfo->total_price;
            } $i++;
$table .='<tr>
                <th colspan="7" style="text-align: right;border: 1px solid black;">Grand Total</th>
                <th style="border: 1px solid black;text-align:right">'.$tot_price.'</th>
            </tr>  ';
 $table .= '</table>
    </div>
</td></tr>   
 </table>



 <footer >


</footer>

</body>
</html>

';
$pdf->WriteHTMLCell(0, 0, '', '', $table,  0, 1, 0, true, 'A4', true);


$pdf->lastPage();

// ---------------------------------------------------------
ob_clean();
$filename=APPPATH.'pdf/avd_book'.str_replace(' ', '_', $bookinfo->bookedid).'.pdf';

$pdf->Output($filename, 'F');
//$pdf->Output('kk.pdf', 'I');
            //exit();
//var_dump($path);die;
