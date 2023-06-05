<?php
class Ramais
{
    public $ramais;
    public $filas;

    public function __construct() {
        $this->ramais = file('../lib/ramais');
        $this->filas = file('../lib/filas');
    }

    public function ramais() {
        $status_ramais = array();
        foreach($this->filas as $linhas){
            if(strstr($linhas,'SIP/')){
                if(strstr($linhas,'(Ring)')){
                    $linha = explode(' ', trim($linhas));
                    list($tech,$ramal) = explode('/',$linha[0]);
    
                    $status_ramais[$ramal] = array('status' => 'chamando','call' => end($linha));            
                }
                if(strstr($linhas,'(In use)')){            
                    $linha = explode(' ', trim($linhas));
                    list($tech,$ramal) = explode('/',$linha[0]);
                    $status_ramais[$ramal] = array('status' => 'ocupado','call' => end($linha));  
                }
                if(strstr($linhas,'(Not in use)')){
                    $linha = explode(' ', trim($linhas));
                    list($tech,$ramal)  = explode('/',$linha[0]);
                    $status_ramais[$ramal] = array('status' => 'pausado','call' => end($linha));   
                }
                if(strstr($linhas,'(Unavailable)')){
                    $linha = explode(' ', trim($linhas));
                    list($tech,$ramal)  = explode('/',$linha[0]);

                    $status_ramais[$ramal] = array('status' => 'indisponivel','call' => end($linha));  
                }
            }
        }
        $info_ramais = array();
        foreach($this->ramais as $linhas){
            $linha = array_filter(explode(' ',$linhas),function( $v ) { return !( is_null( $v) or '' === $v ); } );
            $arr = array_values($linha);
            if(trim($arr[1]) == '(Unspecified)' AND trim($arr[5]) == 'UNKNOWN'){        
                list($name,$username) = explode('/',$arr[0]); 
                    
                $info_ramais[$name] = array(
                    'nome' => $name,
                    'ramal' => $username,
                    'online' => false,
                    'ip' => ($arr[1] != '(Unspecified)' AND $arr[1] != 'Host' AND $arr[1] != 'sip') ? $arr[1] : 0,
                    'status' => $status_ramais[$username]['status'],
                    'call' => $status_ramais[$username]['call']
                );
            }
            if(trim($arr[5]) == 'OK'){        
                list($name,$username) = explode('/',$arr[0]);
                
                $info_ramais[$name] = array(
                    'nome' => $name,
                    'ramal' => $username,
                    'online' => true,
                    'ip' => ($arr[1] != '(Unspecified)' AND $arr[1] != 'Host' AND $arr[1] != 'sip') ? $arr[1] : 0,
                    'status' => $status_ramais[$username]['status'],
                    'call' => $status_ramais[$username]['call']
                );
            }
        }
        echo json_encode($info_ramais);
    }
}
?>