<?
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/fpdf.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/fpdi.php');
	
	class Invoice extends FPDI{	
	
		var $Invoice;
		var $See;
		
		function setInvoice($oData){
			$this->Invoice = $oData;			
		}
		
		function setSee($oData){
			$this->See = $oData;			
		}
		
		function CreateInvoice($InvoiceId){
			
			$Database = new Database();
			$Invoice = $this->Invoice;
			
			$oSettings = $Database->Select("SELECT * FROM `system_invoices_settings` ORDER BY system_invoices_settings.`setting_id`", rows_object);

			$this->SetFont('Arial','B',10);
			$this->Cell(200,5,utf8_decode($Invoice->invoice_company),0);
			$this->Ln();
			$this->Cell(200,5,"T.a.v.: ".utf8_decode($Invoice->invoice_name),0);
			$this->Ln();
			$this->Cell(200,5,utf8_decode($Invoice->invoice_address),0);
			$this->Ln();
			$this->Cell(200,5,$Invoice->invoice_zipcode." ".utf8_decode($Invoice->invoice_place),0);
			$this->Ln(20);
			
			$this->SetFont('Arial','',9);
			switch($this->See){
				case 1:
					$this->Cell(40,5,"Venray,",0);
				break;
				case 2:
					$this->Cell(40,5,"Maassluis,",0);
				break;
				case 6:
					$this->Cell(40,5,"Tilburg,",0);
				break;
				case 7:
					$this->Cell(40,5,"Breda,",0);
				break;
				case 8:
					$this->Cell(40,5,"Tilburg,",0);
				break;
				case 9:
					$this->Cell(40,5,"Maastricht,",0);
				break;
				case 10:
					$this->Cell(40,5,"'s-Hertogenbosch,",0);
				break;							
			}
			$this->SetFont('Arial','B',9);
			$this->Cell(100,5,date("d-m-Y", strtotime($Invoice->invoice_date)),0);
			$this->Ln();
			
			$this->SetFont('Arial','',9);
			$this->Cell(40,5,"Factuurnummer:",0);
			$this->SetFont('Arial','B',9);
			$this->Cell(100,5,$Invoice->invoice_invoiceid,0);
			$this->Ln();

			$this->SetFont('Arial','',9);
			$this->Cell(40,6,"Contractnummer:",0);
			$this->Cell(100,5,utf8_decode($Invoice->invoice_contractnumber),0);
			
			if($Invoice->invoice_feature)
				$this->Ln();
			else
				$this->Ln(8);
			
			if($Invoice->invoice_feature){
				$this->SetFont('Arial','',9);
				$this->Cell(40,5,"Uw kenmerk:",0);
				$this->Cell(100,5,utf8_decode($Invoice->invoice_feature),0);
				$this->Ln(8);
			}
			
			$this->Cell(200,13,'Telefoonservice voor de periode '.$oSettings[4]->setting_value,0,1,'L');
			$this->Ln(3);
			
			$this->SetFont('Arial','B',9);
			$this->Cell(80,4,'Omschrijving dienst',0,0,'L');
			$this->Cell(20,4,'Aantal',0,0,'R');
			$this->Cell(25,4,'Prijs',0,0,'R');
			$this->Cell(65,4,'Bedrag',0,0,'R');
				
			$h = 5;
			$CalcTotal = 0;
			
			$InvoiceItems = $Database->Select("SELECT system_invoices_items.* FROM `system_invoices_items` WHERE system_invoices_items.`invoice_id` = '".$InvoiceId."' AND system_invoices_items.`item_group` = '0' ORDER BY system_invoices_items.`item_id`", rows_object);
			if(count($InvoiceItems)){
				
				$this->Ln(7);
				$this->SetFont('Arial','B',9);
				$this->Cell(80,$h,'Abonnementen',0,0,'L');
				$this->Cell(20,$h,'',0,0,'R');
				$this->Cell(25,$h,'',0,0,'R');
				$this->Cell(65,$h,'',0,0,'R');
				
				foreach($InvoiceItems as $Item){
				
					$this->Ln();
					$this->SetFont('Arial','',9);
					$this->Cell(5,$h,'',0,0,'L');
					$this->Cell(75,$h,utf8_decode($Item->item_name),0,0,'L');
					$this->Cell(20,$h,$Item->item_amount,0,0,'R');
					$this->Cell(25,$h,@number_format(str_replace(",",".",$Item->item_price),2,',','.'),0,0,'R');
					$this->Cell(65,$h,@number_format($Item->item_amount * str_replace(",",".",$Item->item_price),2,',','.'),0,0,'R');
					
					$CalcTotal += $Item->item_amount * str_replace(",",".",$Item->item_price);
				
				}
			}
			
			$InvoiceItems = $Database->Select("SELECT system_invoices_items.* FROM `system_invoices_items` WHERE system_invoices_items.`invoice_id` = '".$InvoiceId."' AND system_invoices_items.`item_group` = '1' ORDER BY system_invoices_items.`item_id`", rows_object);
			if(count($InvoiceItems)){
				
				$this->Ln(10);
				$this->SetFont('Arial','B',9);
				$this->Cell(80,$h,'Gesprekken',0,0,'L');
				$this->Cell(20,$h,'',0,0,'R');
				$this->Cell(25,$h,'',0,0,'R');
				$this->Cell(65,$h,'',0,0,'R');
				
				foreach($InvoiceItems as $Item){
				
					$this->Ln();
					$this->SetFont('Arial','',9);
					$this->Cell(5,$h,'',0,0,'L');
					$this->Cell(75,$h,utf8_decode($Item->item_name),0,0,'L');
					$this->Cell(20,$h,$Item->item_amount,0,0,'R');
					$this->Cell(25,$h,@number_format(str_replace(",",".",$Item->item_price),2,',','.'),0,0,'R');
					$this->Cell(65,$h,@number_format($Item->item_amount * str_replace(",",".",$Item->item_price),2,',','.'),0,0,'R');
					
					$CalcTotal += $Item->item_amount * str_replace(",",".",$Item->item_price);
				
				}
			}
			
			$InvoiceItems = $Database->Select("SELECT system_invoices_items.* FROM `system_invoices_items` WHERE system_invoices_items.`invoice_id` = '".$InvoiceId."' AND system_invoices_items.`item_group` = '3' ORDER BY system_invoices_items.`item_id`", rows_object);
			if(count($InvoiceItems)){
				
				$this->Ln(7);
				$this->SetFont('Arial','B',9);
				$this->Cell(80,$h,'Fax/E-mail berichten',0,0,'L');
				$this->Cell(20,$h,'',0,0,'R');
				$this->Cell(25,$h,'',0,0,'R');
				$this->Cell(65,$h,'',0,0,'R');
				
				foreach($InvoiceItems as $Item){
				
					$this->Ln();
					$this->SetFont('Arial','',9);
					$this->Cell(5,$h,'',0,0,'L');
					$this->Cell(75,$h,utf8_decode($Item->item_name),0,0,'L');
					$this->Cell(20,$h,$Item->item_amount,0,0,'R');
					$this->Cell(25,$h,@number_format(str_replace(",",".",$Item->item_price),2,',','.'),0,0,'R');
					$this->Cell(65,$h,@number_format($Item->item_amount * str_replace(",",".",$Item->item_price),2,',','.'),0,0,'R');
					
					$CalcTotal += $Item->item_amount * str_replace(",",".",$Item->item_price);
				
				}
			}
			
			$InvoiceItems = $Database->Select("SELECT system_invoices_items.* FROM `system_invoices_items` WHERE system_invoices_items.`invoice_id` = '".$InvoiceId."' AND system_invoices_items.`item_group` = '2' ORDER BY system_invoices_items.`item_id`", rows_object);
			if(count($InvoiceItems)){
				
				$this->Ln(7);
				$this->SetFont('Arial','B',9);
				$this->Cell(80,$h,'Overige kosten',0,0,'L');
				$this->Cell(20,$h,'',0,0,'R');
				$this->Cell(25,$h,'',0,0,'R');
				$this->Cell(65,$h,'',0,0,'R');
				
				foreach($InvoiceItems as $Item){
				
					$this->Ln();
					$this->SetFont('Arial','',9);
					$this->Cell(5,$h,'',0,0,'L');
					$this->Cell(75,$h,utf8_decode($Item->item_name),0,0,'L');
					$this->Cell(20,$h,$Item->item_amount,0,0,'R');
					$this->Cell(25,$h,@number_format(str_replace(",",".",$Item->item_price),2,',','.'),0,0,'R');
					$this->Cell(65,$h,@number_format($Item->item_amount * str_replace(",",".",$Item->item_price),2,',','.'),0,0,'R');
					
					$CalcTotal += $Item->item_amount * str_replace(",",".",$Item->item_price);
				
				}
			}
										
			$this->Ln(7);
			$this->SetFont('Arial','B',9);
			$this->Cell(145,$h,'Subtotaal',0,0,'R');
			$this->Cell(25,$h,'',0,0,'R');
			$this->SetFont('Arial','',9);
			$this->Cell(20,$h,@number_format($CalcTotal,2,',','.'),0,0,'R');
			
			if($Invoice->invoice_discount_name && $Invoice->invoice_discount_value){
				
				$this->Ln();
				$this->SetFont('Arial','B',9);
				$this->Cell(145,$h,$Invoice->invoice_discount_name,0,0,'R');
				$this->Cell(25,$h,'',0,0,'R');
				$this->SetFont('Arial','',9);
				$this->Cell(20,$h,"-".@number_format(($CalcTotal/100) * number_format($Invoice->invoice_discount_value,0) ,2,',','.'),0,0,'R');	
				
				$CalcTotal = $CalcTotal - ($CalcTotal / 100 * number_format($Invoice->invoice_discount_value,0));
				
				$this->Ln();
				$this->SetFont('Arial','B',9);
				$this->Cell(145,$h,'Subtotaal',0,0,'R');
				$this->Cell(25,$h,'',0,0,'R');
				$this->SetFont('Arial','',9);
				$this->Cell(20,$h,@number_format($CalcTotal,2,',','.'),0,0,'R');	
						
			}
			
			$this->Ln();
			$this->SetFont('Arial','B',9);
			$this->Cell(145,$h,'21% BTW',0,0,'R');
			$this->Cell(25,$h,'',0,0,'R');
			$this->SetFont('Arial','',9);
			$this->Cell(20,$h,@number_format(($CalcTotal/100) * 21 ,2,',','.'),0,0,'R');	
			
			$CalcTotal = $CalcTotal + ($CalcTotal / 100 * 21);
			
			$this->Ln();
			$this->SetFont('Arial','B',9);
			$this->Cell(145,$h,'Totaal EUR',0,0,'R');
			$this->Cell(25,$h,'',0,0,'R');
			$this->SetFont('Arial','',9);
			$this->Cell(20,$h,@number_format($CalcTotal,2,',','.'),0,0,'R');
			
			$this->Ln(7);
			$this->SetFont('Arial','',9);
			
			if($Invoice->invoice_type == "incasso"){

				$this->Cell(50,$h,'Ons incassant ID:',0,0,'L');
				switch($this->See){
					case 1:
						$this->Cell(150,$h,$oSettings[0]->setting_value,0,0,'L');
					break;
					case 2:
						$this->Cell(150,$h,$oSettings[7]->setting_value,0,0,'L');
					break;
					case 6:
						$this->Cell(150,$h,$oSettings[11]->setting_value,0,0,'L');
					break;
					default:
						$this->Cell(150,$h,$oSettings[0]->setting_value,0,0,'L');
					break;
				}
				$this->Ln();
				$this->Cell(50,$h,'Uw machtigingskenmerk:',0,0,'L');
				$this->Cell(150,$h,utf8_decode($Invoice->invoice_contractid),0,0,'L');
				$this->Ln(7);
				$this->Cell(200,$h,'Deze rekening wordt automatisch geincasseerd van rekeningnummer '.$Invoice->invoice_iban,0,0,'L');
				
			}
			else{
				
				$this->Cell(200,$h,'Gaarne uw betaling binnen 14 dagen na factuurdatum, onder vermelding van factuurnummer '.$Invoice->invoice_invoiceid,0,0,'L');

			}
			switch($this->See){
				case 1:
					$this->Ln(7);
					$this->SetFont('Arial','',9);
					$this->Cell(50,$h,'Rabobank Horst-Venray',0,0,'L');
					$this->Cell(150,$h,'IBAN: NL45 RABO 0153946490, BIC: RABONL2U',0,0,'L');
				break;
				case 2:
					$this->Ln(7);
					$this->SetFont('Arial','',9);
					$this->Cell(50,$h,'Rabobank Westland ',0,0,'L');
					$this->Cell(150,$h,'IBAN: NL50 RABO 0148436412, BIC: RABONL2U',0,0,'L');
				break;
				case 6:
					$this->Ln(7);
					$this->SetFont('Arial','',9);
					$this->Cell(50,$h,'Rabobank Horst-Venray',0,0,'L');
					$this->Cell(150,$h,'IBAN: NL45 RABO 0153946490, BIC: RABONL2U',0,0,'L');
				break;
				default:
					$this->Ln(7);
					$this->SetFont('Arial','',9);
					$this->Cell(50,$h,'Rabobank Horst-Venray',0,0,'L');
					$this->Cell(150,$h,'IBAN: NL45 RABO 0153946490, BIC: RABONL2U',0,0,'L');
				break;
			}
		}
	
	#	Page header
		function Header(){
									
			if(is_null($this->_tplIdx)){
				switch($this->See){
					case 1:
					case 5:
					case 7:
					case 8:
					case 9:
					case 10:
						$this->setSourceFile('briefpapier_tasvenray.pdf');
					break;
					case 2:
						$this->setSourceFile('briefpapier_taswestland.pdf');
					break;
					case 6:
						$this->setSourceFile('briefpapier_tastilburg.pdf');
					break;
				}
				$this->_tplIdx = $this->importPage(1);   
			}
			
			$Invoice = $this->Invoice;
			
			if($Invoice->invoice_send_type == "mail")
				$this->useTemplate($this->_tplIdx);
			
			$this->SetLeftMargin(14);
			$this->Ln(40);
		}
	
	#	Page footer
		function Footer(){
			$this->SetY(-20);
			$this->SetFont('Helvetica','',9);
			$this->Cell(0,5,'Pagina '.$this->PageNo().' van {nb}',0,1,'R');
		}
	}

?>