

<?php



// require_once  './vendores/autoload.php';
require_once 'C:\xampp\htdocs\germanythememaster\germany-theme\vendores\autoload.php';


$mpdf = new \Mpdf\Mpdf();
$mpdf->Bookmark('Start the document ');


$html = '<body>

  <div style="background-color: #323759; padding:5px;"></div>

  <div class="row" >
            <div class="div_left">
            <img class="img_bom" src="C:\xampp\htdocs\germanythememaster\germany-theme\images\logo\pdglogo.png" alt="logo">
                  <span  style="font-size:11px;"><u>Bewerbung.one|Nordkanalstr.52,20097 Hamburg</u></span>
                  <address class="text-muted">
                      '.$items['user_name'].'<br>
                      '.$items['street_no'].', '.$items['house_no'].'<br>
                      '.$items['zip_code'].', '.$items['city'].'<br><br>
                      <abbr title="Email"></abbr> '. $items['email'] .' <br>
                      <abbr title="Phone"></abbr> '. $items['mobile'] .'

                  </address>
            </div>
    <div class="div_right" >

                                    <div class="invoice_no">
                                        <p >#'.$items['order_id'].'</p>
                                        <span>'. \Carbon\Carbon::parse($items['order_created_at'])->format('d.m.Y h:m').'</span>
                                    </div>

                                        <p class="rech_h2">RECHNUNG</p>


                                        <p class="p-1" style="background-color: #323759 ;margin-left:50px; padding:5px;">
                                        <b style="color: lightgrey">STATUS</b>  ';
                                        if($items['order_status']==1||$items['order_status']==2||$items['order_status']==3){
                                          $html.='<span style="color:#ecd399;" >Zahlung ausstehend </span> ';
                                        }elseif($items['order_status']==4){
                                          $html.= '
                                        <span style="color:lightblue;" >Rechnung wurde bezahlt </span> ';
                                        }elseif($items['order_status']==-1){
                                          $html.='
                                        <span style="color:pink;" >Storniert/Abgebrochen </span>';
                                        }elseif($items['order_status']==-2){
                                          $html.='
                                          <span style="color:lightgreen;" > zurückerstatten </span> ';
                                        }else{
                                          $html.=' <span style="color:red;" >
                                          noch nicht veröffentlicht </span> ';
                                        }
                                        $html.= ' </p>


                                        <table class="tbl_div">
                                        <tr >
                                        <td class="tbl_div_tr" style="border-right: 1px solid #323759">Bestellnummer <br><br>
                                        '.$items['order_id'].'
                                        </td>
                                        <td class="tbl_div_tr" style="border-right: 1px solid #323759">Bestelldatum <br><br>
                                        '. \Carbon\Carbon::parse($items['order_created_at'])->format('d.m.Y').'
                                        </td>
                                        <td class="tbl_div_tr">Fertigstellung <br><br>
                                        '. \Carbon\Carbon::parse($items['order_completion_date'])->format('d.m.Y').'
                                        </td>
                                        </tr>

                                        </table>






    </div>

  </div>
  <div class="main_tbl">
  <table class="tbl_data" >

                                    <tr class="header_da">
                                        <th class="th_pad">Nr</th>
                                        <th class="da_tr">Produkt</th>
                                        <th >Preis</th>
                                    </tr>
                                    <tr class="tbody_bo">
                                        <td class="th_pad">1</td>
                                        <td style="padding:10px;">

                                            <p style="font-size: 1.2em">
                                            '.$items['product_name'].'</p>
                                            <p style="font-size: 0.8em" class="text-muted">'.$items['product_language'].'</p>
                                        </td>
                                        <td class="th_price">'.$items['product_price'].' €</td>
                                    </tr>';
                                    if($items['express']!=0){ $html.='
                                        <tr tbody_bo>
                                            <td class="th_pad">2</td>
                                            <td style="padding:10px;">
                                                <p style="font-size: 1.2em">Express 24</p>
                                                <p style="font-size: 0.8em" class="text-muted">Express 24h service</p>
                                            </td>
                                            <td class="th_price">'.$items['express'].' €</td>
                                        </tr>

                                        ';
                                    } $html.='
                                    <tr tbody_bo>
                                        <td class="th_pad"> ';
                                        if($items['express']!=0){
                                          $html.= '3';
                                        } else {
                                         $html.=' 2';
                                        }$html .='</td>
                                        <td style="padding:10px;">
                                            <p style="font-size: 1.2em">'.$items['design_name'].'</p>
                                            <p style="font-size: 0.8em" class="text-muted">'.$items['design_category'].'</p>
                                        </td>
                                        <td class="th_price">'.$items['design_price'].' €</td>
                                    </tr>


                                    <tr tbody_bo>
                                        <td class="th_pad">3</td>
                                        <td style="padding:10px;">
                                            <p style="font-size: 1.2em">'.$items['website_name'].'</p>
                                            <p style="font-size: 0.8em" class="text-muted">'.$items['website_category'].'</p>
                                        </td>
                                        <td class="th_price">'.$items['website_price'].' €</td>
                                    </tr>


  </table>

                                <p class="total_pr">Zwischensumme: '.$items['price'] .'€</p>
                                <p class="total_prp">19% Umsatzsteuer: '.$items['tax'].' €</p>






 </div>

  <div class="row1" >
            <div class="div_left2">
              <p class="vieln">Vielen Dank!</p>

            </div>
    <div class="div_right2" >

      <h3 >Gesamt: '.$items['total_price'].' €</h3>


    </div>

 </div>
<div class="row3" >
            <div class="div_left3">
            <table class="bnk_tbl">
            <tr>
                <td align="right" style="padding: 5px"><b>Name der Bank:</b></td>
                <td>Postbank</td>
            </tr>
            <tr>
                <td  align="right" style="padding: 5px "><b>Namer der Firma:</b></td>
                <td>Graviando OHG</td>
            </tr>
            <tr>
                <td align="right" style="padding: 5px " ><b>Verwendungszweck:</b></td>
                <td style="color: blueviolet">#'.$items['order_id'].'<span style="color: black">
                (bitte  <b> exakt</b> so angeben)</span>
                </td>
            </tr>
            <tr>
                <td align="right" style="padding: 5px "><b>IBAN:</b></td>
                <td>DEB2440100460413924468</td>
            </tr>
            <tr>
                <td align="right" style="padding: 5px "><b></b></td>
                <td>PBNKDEFF</td>
            </tr>
        </table>

            </div>
    <div class="div_right3" >

    <p  class="paypal"><img src="C:\xampp\htdocs\germanythememaster\germany-theme\images\logo\paypallogo.png" alt="paypallogo" ></p>
    <p style="color:black" class="bnk_tbl2">Rufen Sie folgende Seite auf :</p>
    <p class="bnk_tbl3"><a href="https://die.bewerbung.one/paypal/35468">https://die.bewerbung.one/paypal/35468</a></p>


    </div>

</div>

<div class="row5">
            <div class="div5_1">
							<p style="margin-bottom: 0;font-weight: bold"></p>
							<address>
								Ak SERVICE OHG <br>
								Nordkanalstr. 52 <br>
								20097 Hamburg
							</address>
						</div>
						<div class="div5_2">
							<p style="margin-bottom: 0;font-weight: bold"></p>
							<address>

								info@graviando.com <br>
								www.graviando.com
							</address>
						</div>

            <div class="div5_3">
							<address>
								Bank: Postbank <br>
								Name: Graviando OHG <br>
								IBAN: DEB2440100460413924468<br>
								BIC:PBNKDEFF
							</address>
						</div>
						<div class="div5_4">
							<address>
								St-Nr:46/624/01612 <br>
								USt-ID-Nr:DE319824375 <br>
								HReg Nr:HRA 123458 <br>
								Amtsgericht:Hamburg
							</address>
						</div>

</div>
<div style="background-color: #323759; padding:5px;"></div>

</body>

';



// echo($html);
// die;
// include("/mpdf.php");

$mpdf->SetDisplayMode('fullpage');
// LOAD a stylesheet
$stylesheet = file_get_contents('C:\xampp\htdocs\germanythememaster\germany-theme\public\tbl_style.css');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html);
$filename = $refercen_num->reference_num.'.pdf';
$destination = $path;
// $mpdf->Output(''.$items['order_id'].'.pdf','D');
 $mpdf->Output($destination.$filename,'F');
?>
