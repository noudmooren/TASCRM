<?

	class PostcodeAPI{
        
        private $API_URL = 'https://postcode-api.apiwise.nl/v2/addresses/';
        private $API_KEY;
        
        public function __construct($api_key){
            $this->API_KEY = $api_key;
        }
        
        public function getInfo($pc){
            return $this->request($pc);
        }
        
        public function getDistance($pc1, $pc2){
            $start  = $this->request($pc1);
            $end  = $this->request($pc2);
            
            if( false === $start ) return false;
            if( false === $end ) return false;
            
            return $this->getCoordDistance($start->latitude, $end->latitude, $start->longitude, $end->longitude);   
        }
        
        public function getCoordDistance($lat1, $lat2, $lon1, $lon2){
            $R    = 6371;
            $dLat   = deg2rad( $lat2-$lat1 );
            $dLon   = deg2rad( $lon2-$lon1 );
            $lat1   = deg2rad( $lat1 );
            $lat2   = deg2rad( $lat2 );
            
            $a      = sin($dLat/2) * sin($dLat/2) + sin($dLon/2) * sin($dLon/2) * cos($lat1) * cos($lat2); 
            $c      = 2 * atan2( sqrt($a) , sqrt(1-$a) ); 
            $distance   = $R * $c;
            
            return round($distance * 1000);
        }
    
        private function request( $pc ){
            $params = array();
            $pc_len = strlen( $pc );
			
			$params[] = 'postcode='.$pc;
			
            switch( $pc_len ){
                case 5:
                    $params[] = 'type=p5';
                break;
                
                case 4:
                    $params[] = 'type=p4';
                break;
                
                default:
                    $params[] = 'type=p6';
                break;
            }
        
            $url    = $this->API_URL . '?' . implode('&', $params);
            $ch     = curl_init();
            
            curl_setopt($ch, CURLOPT_URL,       $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'X-Api-Key: ' . $this->API_KEY
            ));
        
            $result = curl_exec( $ch );
        
            curl_close( $ch );
        
            $json = json_decode( $result );
			
            if($json->_embedded->addresses[0]){
				$Return =(object) array();
				$Data = $json->_embedded->addresses[0];
				
				$Return->town = $Data->city->label;
				$Return->postcode = $Data->postcode;
				$Return->street = $Data->street;
				$Return->province = $Data->label;
				$Return->latitude = $Data->geo->center->wgs84->coordinates[0];
				$Return->longitude = $Data->geo->center->wgs84->coordinates[1];
				
                return $Return;
            } else {
                return false;
            }
        }
    }
	
?>