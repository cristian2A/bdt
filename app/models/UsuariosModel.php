<?php
namespace Model;
use Core\DBManager as DB;
use Core\Model as Model;
use Security as Security;

class UsuariosModel extends Model
{
    protected   $id; 
    protected   $usuario;
    private     $password;
    protected   $email;
    protected   $permisos;
    protected   $fecha_registro;
    protected   $ultimo_acceso ;
    protected   $token;
    protected   $estado;

    private $db;
    private $stmt;

    public function __construct()
    {
        //Instancio la conexion
        $this->db = new DB;     
    }
    
    public function set($propiedad, $valor)
    {
        $this->$propiedad = $valor;
        return $this->$propiedad;
    }
    public function get($propiedad)
    {
        return $this->$propiedad;
    }


    public function addUser()
    {    
        
        ///Validar y Sanear datos

        $registro = $this->validation->filterRegistro();
        try {   
            
            $sql = "INSERT INTO bdt_usuarios(
                                            usuario,
                                            passw,
                                            email,
                                            permisos,
                                            estado,
                                            token_session,
                                            fecha_registro,
                                            ultimo_acceso)
                    VALUES (?,?,?,?,NOW(),?,NOW(),?)";
        
            $resp = $this->db->prepare("$sql");
            $resp->bindParam(1, $this->usuario, \PDO::PARAM_STR);
            $resp->bindParam(2, $this->password, \PDO::PARAM_STR);
            $resp->bindParam(3, $this->email, \PDO::PARAM_STR);
            $resp->bindParam(4, $this->permisos, \PDO::PARAM_INT);
            $resp->bindParam(5, $this->token_session);
            $resp->bindParam(6, $this->estado);
            try {
                $resp->execute();
                $lid = $this->db->lastInsertId(); 

                        //cierro la conexion
                var_dump($this->db());
                        $this->db ='';
                echo "<br> cerrando conexion: ";
                parent::disconnect();
                var_dump($this->db());
                echo "<br>";
                echo $lid;
                return $lid;
            } catch(PDOExecption $e) { 
                echo "Error!: " . $e->getMessage() . "</br>"; 
            } 
        } catch( PDOExecption $e ) { 
            echo "Error!: " . $e->getMessage() . "</br>"; 
        } 

    }

    public function eliminarUsuario($id)
    {

    }
    
    public function modificarUsuario($id)
    {

    }
    
    public function modificarEstadoUsuario()
    {

    }
    
    public function listarUsuarios()
    {
        $sql = "SELECT usuario,email,estado FROM bdt_usuarios";
        $stmt = $this->db->preparar($sql);
        // Ejecutar la consulta
        $stmt->execute();
        // Recoje la información en forma de matriz.
        $result = $stmt->fetchAll();
        return $result;
    }

    
    function checkLogin($user, $pass)
    {
        $sql= " SELECT id, usuario, email, permisos, estado FROM bdt_usuarios 
                WHERE usuario = :usuario AND password =  :password";
        $this->db->query($sql);
        $this->db->bindP(':usuario', $user);
        $this->db->bindP(':password', $pass);
 
        $result = $this->db->resultSet();
       
        if($this->db->rowCount() > 0 )
        {	
            //seteo las variables de usuario
            $this->set("id_usuario", $result->id);
            $this->set("usuario", $result->usuario);
            $this->set("email", $result->email);
            $this->set("estado", $result->estado);
            $this->set("permisos", $result->permisos);

            //Creacion de las Sesiones de Usuario
            $_SESSION['USER']['USUARIO'] = $this->usuario;
            $_SESSION['USER']['ID_USUARIO'] = $this->id_usuario;
            $_SESSION['USER']['ESTADO']=$this->estado;
            $_SESSION['USER']['PERMISO']=$this->permisos;

            //Genero un token para controlar la sesion
            $this->token = parent::generateToken(30); //ha guardar en la db
            $salt_r = parent::generateToken(20);
            $salt_l = parent::generateToken(10);
            $t= $salt_l.$this->token.$salt_r;
            $_SESSION['USER']['TOKEN']=$t;
            
            //Actualiza base de datos con Fecha de acceso y token
            self::updateAccess();
            return true;
        }
        else
        {
            return false;
        }
        
    }

    public function validation()
    {
        $registro = $this->validation->filterRegistro();
    }


    
    public function updateAccess()
    {   
        $sql="UPDATE bdt_usuarios SET token_session=:token, ultimo_acceso =NOW() WHERE id=:id";
        $this->db->query($sql);
        $this->db->bindP(':token', $this->token);
        $this->db->bindP(':id', $this->id_usuario);
        try {
            $result = $this->db->execute();
            return true;    
        } catch(PDOExecption $e) { 
            echo "Error!: " . $e->getMessage() . "</br>"; 
        }   
    }

    public function clearToken($stoken)
    {
        $t = substr($stoken, 10,30);
        return $t;
    }

    private function encryptPass($pass, $hash='', $action=1)
    {
        //action 10 =>  encriptar
        if($action==1)
        {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            return $hash;
        }
        elseif($action ==2) //comparar
        {
            if (password_verify($pass , $hash)) {
                return true;
            } else {
                return false;
            }
        }
    }


}
?>