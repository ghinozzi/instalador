<?php
namespace App\Generator;

class InstaladorFunctions
{
      /**
     * Gera os arquivos dentro do projeto
     *
     * @return boolean
     */
    public static function gerarArquivo($base,$destino,$replaces = null)
    {
        Try{
            $codigo = file_get_contents($base);

            if(!empty($replaces)){
                $codigo = $this->replaceContents($codigo,$replaces);
            }

            if(file_put_contents($destino, $codigo)){
                dd('ok');
                return true;
            }else{
                dd('ok2');
                throw new Exception('Falha ao criar arquivo');
            }
        }catch(\Exception $e){
            dd($e->getMessage());
            return $e->getMessage();
        }
    }
      /**
     * Substitui variaveis dentro dos arquivos gerados
     *
     * @return string
     */
    public function replaceContents($codigo,$replaces){
        foreach ($replaces as $search => $replace)
        {
            $codigo = str_replace('__'.$search.'__' , $replace, $codigo);
        }

        return $codigo;
    }
    /**
     * Copia pastas para determinado destino recursivamente
     *
     * @return string
     */
    static function  recursive_copy($src,$dst) {
        Try{
            $dir = opendir($src);
            @mkdir($dst);
            while(false !== ( $file = readdir($dir)) ) {
                if (( $file != '.' ) && ( $file != '..' )) {
                    if ( is_dir($src . '/' . $file) ) {
                        self::recursive_copy($src . '/' . $file,$dst . '/' . $file);
                    }
                    else {
                        copy($src . '/' . $file,$dst . '/' . $file);
                    }
                }
            }
            closedir($dir);
            return true;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
