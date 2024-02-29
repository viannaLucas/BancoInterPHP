<?PHP

namespace viannaLucas\BancoInterPhp\Test\OAuth\TokenPersistence;

use Exception;
use PHPUnit\Framework\TestCase;
use viannaLucas\BancoInterPhp\OAuth\Token;
use viannaLucas\BancoInterPhp\OAuth\TokenPersistence\EncryptFileTokenPesistence;
use viannaLucas\BancoInterPhp\Test\DataProvider;



final class EncryptFileTokenPesistenceTest extends TestCase
{
    
    protected string $secretKey = 'mySecretKeyTest';
    protected string $pathFile = __DIR__."/../../../";
    protected string $nameFile = 'EncryptTokenPersistenceFile.obj';
    
    public function testCanSaveAndLoadFile(): void
    {
        
        if(is_file($this->pathFile.$this->nameFile)){
            unlink($this->pathFile.$this->nameFile);
        }
        if(!is_writable($this->pathFile)){
            throw new Exception('Folder isn\'t writable: '.realpath($this->pathFile));
        }
        $cryptFile = new EncryptFileTokenPesistence($this->pathFile.$this->nameFile, $this->secretKey);
        
        $expired = random_int(1, 2) == 1;
        $token = DataProvider::token($expired);
        $this->assertEquals(true, $cryptFile->saveToken($token), 'Error save file!');
        
        $tokenLoaded = $cryptFile->loadToken();
        $this->assertEquals(true, $tokenLoaded instanceof Token, 'Error loading file...');
        
        if(is_file($this->pathFile.$this->nameFile)){
            unlink($this->pathFile.$this->nameFile);
        }
    }
}