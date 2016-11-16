<?

	class Boekhouding{
	
		private $Username 		= 'Margot van Kreij';
		private $SecurityCode1 	= '2edf44cc56770bc7c444fcbafacb47ae';
		private $SecurityCode2 	= '1D153AD5-659E-42AD-A4C4-1B54E18414DA';
		
		private $ClientConnection;
		private $SessionId;
		private $oRelations;
		private $oInvoices;
		
		private $FactuurRegel = array();
		
		private $Factuurnummer; //String
		private $Relatiecode; //String
		private $Datum; //DateTime
		private $Betalingstermijn = 14; //LongText
		private $Factuursjabloon = "Voorbeeld 1"; //String
		private $PerEmailVerzenden = false; //Boolean
		
		private $EmailOnderwerp; //String
		private $EmailBericht; //String
		private $EmailVanAdres; //String
		private $EmailVanNaam; //String
		
		private $AutomatischeIncasso = false; //Boolean
		
		private $IncassoIBAN; //String
		private $IncassoMachtigingSoort = "D"; //String
		private $IncassoMachtigingID; //String
		private $IncassoMachtigingDatumOndertekening; //DateTime
		private $IncassoMachtigingFirst = false; //Boolean
		private $IncassoMachtigingRecurrent = true; //Boolean
		private $IncassoRekeningNummer; //String
		private $IncassoTnv; //String
		private $IncassoPlaats; //String
		private $IncassoOmschrijvingRegel1; //String
		private $IncassoOmschrijvingRegel2; //String
		private $IncassoOmschrijvingRegel3; //String
		
		private $InBoekhoudingPlaatsen = true; //Boolean
		private $BoekhoudmutatieOmschrijving = "Factuur via trs"; //String
			
		public function __construct($Username = false,$SecurityCode1 = false,$SecurityCode2 = false){
			
			if($Username) 		$this->Username			= $Username;
			if($SecurityCode1) 	$this->SecurityCode1	= $SecurityCode1;
			if($SecurityCode2) 	$this->SecurityCode2	= $SecurityCode2;
			
			$this->ClientConnection = new SoapClient('http://soap.e-boekhouden.nl/soap.asmx?wsdl');
			$this->MakeSession();
			
			return true;
			
		}
			
		public function MakeSession(){
			
			$OpenSession = $this->ClientConnection->OpenSession(array(
					'Username' 			=> $this->Username,
					'SecurityCode1' 	=> $this->SecurityCode1,
					'SecurityCode2' 	=> $this->SecurityCode2
				)
			);
			
			$this->SessionId = $OpenSession->OpenSessionResult->SessionID;
	
		}
		
		public function getRelation($ID = false, $Code = false, $Trefwoord = false){
			
			$oRelations = $this->ClientConnection->GetRelaties(array(
					'SessionID' 		=> $this->SessionId,
					'SecurityCode2' 	=> $this->SecurityCode2,
					'cFilter' 			=> array("Trefwoord" => $Trefwoord, "Code" => $Code, "ID" => $ID)
				)
			);
			
			$this->oRelations = $oRelations->GetRelatiesResult->Relaties->cRelatie;
			
			if(!is_array($this->oRelations)){
				
				$this->Relatiecode		= $this->oRelations->Code;
				$this->IncassoTnv		= $this->oRelations->Bedrijf;
				$this->IncassoPlaats	= $this->oRelations->Plaats;
				$this->IncassoIBAN		= $this->oRelations->Bankrekening;
				
			}
					
		}
		
		public function getInvoices($Factuurnr = false, $RelatieCode = false, $Van = false, $Tot = false){
			
			echo $Van." ".$Tot;
			
			$oRelations = $this->ClientConnection->GetFacturen(array(
					'SessionID' 		=> $this->SessionId,
					'SecurityCode2' 	=> $this->SecurityCode2,
					'cFilter' 			=> array("Factuurnummer" => $Factuurnr, "Relatiecode" => $RelatieCode, "DatumVan" => $Van, "DatumTm" => $Tot)
				)
			);
			
			$this->oInvoices = $oRelations;
			
			print_r($oRelations);
				
		}
		
		public function AddInvoiceRole($Amount, $Eenheid = false, $Code = false, $Omschrijving, $PrijsPerEenheid, $BTWCode, $TegenrekeningCode = false, $KostenPlaatsID = false){
			
			$this->FactuurRegel[] = array(
				"Aantal" 			=> $Amount,
				"Eenheid"			=> $Eenheid,
				"Code"				=> $Code,
				"Omschrijving" 		=> $Omschrijving,
				"PrijsPerEenheid" 	=> $PrijsPerEenheid,
				"BTWCode" 			=> $BTWCode,
				"TegenrekeningCode" => $TegenrekeningCode,
				"KostenplaatsID" 	=> $KostenPlaatsID);
			
			return true;
			
		}
		
		public function CreateInvoice(){
			
			$Responce = $this->ClientConnection->AddFactuur(array(
					'SessionID' 		=> $this->SessionId,
					'SecurityCode2' 	=> $this->SecurityCode2,
					'oFact' 			=> array(
						"Factuurnummer" 						=> $this->Factuurnummer,
						"Relatiecode" 							=> $this->Relatiecode,
						"Datum" 								=> $this->Datum,
						"Betalingstermijn" 						=> $this->Betalingstermijn,
						"Factuursjabloon" 						=> $this->Factuursjabloon,
						"PerEmailVerzenden" 					=> $this->PerEmailVerzenden,
						"EmailOnderwerp" 						=> $this->EmailOnderwerp,
						"EmailBericht" 							=> $this->EmailBericht,
						"EmailVanAdres" 						=> $this->EmailVanAdres,
						"EmailVanNaam" 							=> $this->EmailVanNaam,
						"AutomatischeIncasso" 					=> $this->AutomatischeIncasso,
						"IncassoIBAN" 							=> $this->IncassoIBAN,
						"IncassoMachtigingID" 					=> $this->IncassoMachtigingID,
						"IncassoMachtigingSoort" 				=> $this->IncassoMachtigingSoort,
						"IncassoMachtigingDatumOndertekening" 	=> $this->IncassoMachtigingDatumOndertekening,
						"IncassoMachtigingFirst" 				=> $this->IncassoMachtigingFirst,
						"IncassoRekeningNummer" 				=> $this->IncassoRekeningNummer,
						"IncassoTnv" 							=> utf8_encode($this->IncassoTnv),
						"IncassoPlaats" 						=> $this->IncassoPlaats,
						"IncassoOmschrijvingRegel1" 			=> $this->IncassoOmschrijvingRegel1,
						"IncassoOmschrijvingRegel2" 			=> $this->IncassoOmschrijvingRegel2,
						"IncassoOmschrijvingRegel3" 			=> $this->IncassoOmschrijvingRegel3,
						"InBoekhoudingPlaatsen" 				=> $this->InBoekhoudingPlaatsen,
						"BoekhoudmutatieOmschrijving" 			=> $this->BoekhoudmutatieOmschrijving,
						"Regels" 								=> array("cFactuurRegel" => $this->FactuurRegel)
					)
				)
			);

		}
		
		public function setFactuurnummer($oValue){
			$this->Factuurnummer = $oValue;	
		}
		
		public function setDatum($oValue){
			$this->Datum = $oValue;	
		}
		
		public function setAutomatischeIncasso($oValue){
			$this->AutomatischeIncasso = $oValue;	
		}
	
		public function setIncassoIBAN($oValue){
			$this->IncassoIBAN = $oValue;	
		}
		
		public function setIncassoMachtigingSoort($oValue){
			$this->IncassoMachtigingSoort = $oValue;	
		}
		
		public function setIncassoMachtigingID($oValue){
			$this->IncassoMachtigingID = $oValue;	
		}
		
		public function setIncassoMachtigingFirst($oValue){
			$this->IncassoMachtigingFirst = $oValue;	
		}
		
		public function setIncassoMachtigingRecurrent($oValue){
			$this->IncassoMachtigingRecurrent = $oValue;	
		}
		
		public function setIncassoMachtigingDatumOndertekening($oValue){
			$this->IncassoMachtigingDatumOndertekening = $oValue;	
		}
		
		public function setIncassoRekeningNummer($oValue){
			$this->IncassoRekeningNummer = $oValue;	
		}
		
		public function setIncassoTnv($oValue){
			$this->IncassoTnv = $oValue;	
		}
		
		public function setIncassoPlaats($oValue){
			$this->IncassoPlaats = $oValue;	
		}
		
		public function setIncassoOmschrijvingRegel1($oValue){
			$this->IncassoOmschrijvingRegel1 = $oValue;	
		}
		
		public function setIncassoOmschrijvingRegel2($oValue){
			$this->IncassoOmschrijvingRegel2 = $oValue;	
		}
		
		public function setIncassoOmschrijvingRegel3($oValue){
			$this->IncassoOmschrijvingRegel3 = $oValue;	
		}
	
		public function setInBoekhoudingPlaatsen($oValue){
			$this->InBoekhoudingPlaatsen = $oValue;	
		}
		
		public function getRelationData(){
			return $this->oRelations;	
		}
	
	}

?>