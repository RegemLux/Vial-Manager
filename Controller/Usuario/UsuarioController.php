<?php 
    
    include_once '../Model/Usuario/UsuarioModel.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception; 
    require '../Web/assets/PHPMailer/Exception.php';
    require '../Web/assets/PHPMailer/PHPMailer.php';
    require '../Web/assets/PHPMailer/SMTP.php';            
    
    class UsuarioController{
        
    public function getCreate(){

    $obj = new UsuarioModel();

    include_once '../View/Usuario/registrar.php';
    }



        public function index(){
            echo "Esto es una Prueba";
        }

        public function postCreate(){

        }


        public function postEmail(){
        
            $obj = new UsuarioModel();
            $email1=$_POST['correo'];
        
            if (!$email1!="") {
              $_SESSION['errores']['correo']="Debe diligenciar el correo";

                 echo "<script type='text/javascript'>"
       
                 ."window.location.href='../web/Olvidaste.php'"

                 ."</script>";

             }else{             
    
            $sql="SELECT * FROM tblusuario WHERE Usu_correo = '".$email1."'"; 
            $usuario=$obj->consultar($sql);
        
            foreach ($usuario as $usu){
                $email2=$usu['Usu_correo'];
                $pass=$usu['Usu_contrasena'];
                $nickname=$usu['Nickname'];         
            }
    
            if (isset($email2)){
    
                $mail = new PHPMailer(true);
                
                 try {
                
                   $mail->SMTPOptions = array(
                    'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                    )
                  );
                           
                    $mail->SMTPDebug = 0;                      
                    $mail->isSMTP();                                            
                    $mail->Host       = 'smtp.gmail.com';                    
                    $mail->SMTPAuth   = true;                                  
                    $mail->Username   = 'pruebavialmanager123@gmail.com';                   
                    $mail->Password   = 'sena12345678';                               
                    $mail->SMTPSecure = 'tls';     
                    $mail->Port       = 587;                                 
                
                    $mail->setFrom('pruebavialmanager123@gmail.com', 'vialManager');
                    $mail->addAddress($email2, 'usuario');  

                    $mail->isHTML(true);                                  
                    $mail->Subject = 'Recuperar cuenta';
                
                    $mail->Body = '
                    <div style="margin:20px 50px;border:1px solid black;width:380px;font-family:verdana;">
                      <div style="text-align:center;background-color:black;"><br>
                      <label style="color:white;font-size:23px;text-align:center;">¡Hola Usuario!</label><br><br>
                      </div><br><div style="margin:auto 40px;text-align:justify;font-size:18px;">
                      <strong style="font-family:cursive;color:red;">Estas son tus credenciales de ingreso al sistema:</strong><br><br>
                        <strong>User: </strong><br><label>- '.$nickname.'</label><br><br><strong>Pass: '.$pass.'</strong></div><br><h3 style="text-align:center;">vialManager</h3><br></div>';            
                
                    $mail->send();
                    $c1=substr($email2,0,3);
                    $c2 = strstr($email2, '@');
                    $cor=$c1."******".$c2;

                   if ($usuario) {
                     $_SESSION['result']="Por favor revise el correo $cor en el encontrara la información de recuperación de cuenta.";
                   }

                   echo "<script type='text/javascript'>"
       
                   ."window.location.href='../web/login.php'"

                   ."</script>";
                   
                 } catch (Exception $e) {
                    echo "Mesaje no enviado. Mailer Error: {$mail->ErrorInfo}";
                 }
                
                }else{

                  $_SESSION['errores']['correo']="Correo invalido";              
                   
                    echo "<script type='text/javascript'>"
       
                    ."window.location.href='../web/Olvidaste.php'"

                    ."</script>";                  
                }       
            }
          }        


    }
?>